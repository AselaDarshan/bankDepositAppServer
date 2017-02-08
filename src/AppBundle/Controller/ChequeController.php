<?php
/**
 * Created by PhpStorm.
 * User: asela
 * Date: 9/15/16
 * Time: 10:53 PM
 */
namespace AppBundle\Controller;
use AppBundle\Entity\Account;
use AppBundle\Entity\Cheque;
use AppBundle\Entity\ChequeTransaction;
use AppBundle\Entity\Transaction;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class ChequeController extends Controller
{
    /**
     * @Route("/deposit/cheque", name="cheque_deposit")
     */
    public function chequeDepositAction()
    {
        $logger = $this->get('logger');
        $responses = Array();
        $request =  $this->container->get('request_stack')->getCurrentRequest();
        $logger->debug("In ChequeController");
        $logger->debug($request);
        $username = $request->request->get('user');
        $requestData =$request->request->get('data');
        $data = json_decode($requestData, true);
        $accountNo = $data['account_no'];
        $bankCode = $data['bank_code'];

        $mobile = $data['mobile'];
        $refNo = $data['ref_no'];
        $nic = $data['nic'];
        $numOfCheques= $data['num_cheques'];
        $amount = $data['amount'];
        $narr = $data['narr'];
        //$amount = $data[0]['amount'];

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(["username" => $username]);
        if (!is_null($user)) {
            $operatorAccount = $user->getAccount();
            $account = $em->getRepository('AppBundle:Account')->findOneBy(["accountNo" => $accountNo]);
            //start atomic transaction
            $em->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if (is_null($account)) {
                    $account = new Account();
                    $account->setAccountNo($accountNo);
                }
                $chequeTransaction = new ChequeTransaction();
                $chequeTransaction->setAccount($account);

                $chequeTransaction->setCollector($user);
                $chequeTransaction->setMobile($mobile);
                $chequeTransaction->setRefNo($refNo);
                $chequeTransaction->setNic($nic);
                $chequeTransaction->setCheques($numOfCheques);
                $chequeTransaction->setAmount($amount);
                $chequeTransaction->setNarr($narr);
                $chequeTransaction->setBankCode($bankCode);
                $em->persist($account);
                // tells Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($chequeTransaction);
                // actually executes the queries (i.e. the INSERT query)
                $em->flush();
                $em->getConnection()->commit();
                $logger->debug("cheque transaction successful");
            } catch (Exception $e) {
                //if failed rollback
                $logger->debug("Exception when inserting cheque transaction");
                $em->getConnection()->rollBack();
                throw $e;
            }
            $response = array(
                'success' => true,
            );
            return new JsonResponse($response);
        }
        $response = array(
            'success' => false,
        );
        return new JsonResponse($response);
    }
}