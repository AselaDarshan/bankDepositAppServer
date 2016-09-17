<?php
/**
 * Created by PhpStorm.
 * User: asela
 * Date: 9/17/16
 * Time: 4:41 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

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

        $requestData =$request->request->get('Data');

        $data = json_decode($requestData, true);


        $accountNo = $data['account_no'];

        $response = array(
            'success' => true
        );

        return new JsonResponse($response);
    }
}
