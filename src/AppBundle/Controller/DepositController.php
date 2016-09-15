<?php
/**
 * Created by PhpStorm.
 * User: asela
 * Date: 9/15/16
 * Time: 10:53 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Deposit;
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

        $requestData =$request->request->get('Data');

        $data = json_decode($requestData, true);


        $accountNo = $data['account_no'];
        $amount = $data['amount'];
        $mobile=$data['mobile'];

        $deposit = new Deposit($amount);

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($deposit);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        $response = array(
            'success' => true,
            'ref_no' =>$deposit->getRefNo()
        );

        return new JsonResponse($response);
    }
}