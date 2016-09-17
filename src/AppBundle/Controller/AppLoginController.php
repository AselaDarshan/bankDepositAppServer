<?php
/**
 * Created by PhpStorm.
 * User: asela
 * Date: 9/17/16
 * Time: 10:46 PM
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
     * @Route("/loginApp", name="login_app")
     */
    public function loginAppAction()
    {
        $logger = $this->get('logger');

        $request =  $this->container->get('request_stack')->getCurrentRequest();
        $logger->debug($request);

        $requestData =$request->request->get('data');

        $data = json_decode($requestData, true);

        $username = $data['name'];
        $password = $data['password'];
    }
}