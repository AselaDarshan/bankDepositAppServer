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

class AppLoginController extends Controller
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

        $username = $data['username'];
        $password = $data['password'];

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(["username"=>$username]);
        if(!is_null($user)){
            if($user->getPassword()==$password) {
                $success = true;
            }
            else{
//                ToDo:check password
                $success=true;
            }

        }
        else{

            $success=false;

        }

        $response = array(
            'success' => $success
        );
        return new JsonResponse($response);
    }
}