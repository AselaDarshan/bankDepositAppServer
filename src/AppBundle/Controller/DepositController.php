<?php
/**
 * Created by PhpStorm.
 * User: asela
 * Date: 9/15/16
 * Time: 10:53 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Account;

use AppBundle\Entity\Transaction;
use AppBundle\Entity\CashTransaction;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DepositController extends Controller
{
    /**
     * @Route("/deposit/cash", name="cash_deposit")
     */
    public function cashDepositAction()
    {
        $logger = $this->get('logger');

        $request =  $this->container->get('request_stack')->getCurrentRequest();
        $logger->debug($request);

        $username = $request->request->get('user');
        $requestData =$request->request->get('data');

        $data = json_decode($requestData, true);


        $accountNo = $data['account_no'];
        //$bankCode = $data['bank_code'];

        $amount = $data['amount'];
        $mobile=$data['mobile'];
        $logger->debug($mobile."gggggggggggggggggggggg");
        $refNo = $data['ref_no'];
        $nic = $data['nic'];
        $narr = $data['narr'];
        $logger->debug("amoung : " .$amount);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(["username"=>$username]);
        if(!is_null($user)) {

            $operatorAccount = $user->getAccount();

            $account = $em->getRepository('AppBundle:Account')->findOneBy(["accountNo" => $accountNo]);

            //start atomic transaction
            $em->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if (is_null($account)) {
                    $account = new Account();
                    $account->setAccountNo($accountNo);
                }

                //withdraw from operator's account
                $withdraw = new CashTransaction(($amount*-1));

                $withdraw->setAccount($operatorAccount);
                $operatorAccount->withdraw($amount);
                $withdraw->setCollector($user);
                $withdraw->setRefNo($operatorAccount.$refNo);

                $withdraw->setMobile($user->getMobile());
                //$withdraw->setBankCode($bankCode);

                //deposit amount to user's account
                $deposit = new CashTransaction($amount);
                $deposit->setAccount($account);
                $deposit->setCollector($user);
                $deposit->setRefNo($refNo);
                $deposit->setMobile($mobile);
                $deposit->setNic($nic);
                $deposit->setNarr($narr);
                //$deposit->setBankCode($bankCode);
                $account->deposit($amount);


                $em->persist($account);
                // tells Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($deposit);
                $em->persist($withdraw);

                // actually executes the queries (i.e. the INSERT query)
                $em->flush();
                $em->getConnection()->commit();
            } catch (Exception $e) {
                //if failed rollback
                $em->getConnection()->rollBack();
                throw $e;
            }


            $response = array(
                'success' => true,
                'ref_no' => $deposit->getRefNo()
            );

            return new JsonResponse($response);
        }
        $response = array(
            'success' => false,
        );

        return new JsonResponse($response);
    }
}