<?php
/**
 * Created by PhpStorm.
 * User: asela
 * Date: 9/17/16
 * Time: 4:41 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Account;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AppRegistrationController extends Controller
{
    /**
     * @Route("/registerApp", name="register_app")
     */
    public function registerAppAction()
    {
        $logger = $this->get('logger');

        $request =  $this->container->get('request_stack')->getCurrentRequest();
        $logger->debug($request);

        $requestData =$request->request->get('data');

        $data = json_decode($requestData, true);

        $username = $data['name'];
        $accountNo = $data['account_no'];
        $email = $data['email'];
        //create Account
        $account = new Account();
        $account->setAccountNo($accountNo);
        //create user
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword("1234");
        $user->setAccount($account);

        $em = $this->getDoctrine()->getManager();
        $em->persist($account);
        $em->persist($user);

        $em->flush();

        $response = array(
            'success' => true
        );

        return new JsonResponse($response);
    }
}
