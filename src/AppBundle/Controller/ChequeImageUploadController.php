<?php
/**
 * Created by PhpStorm.
 * User: supun
 * Date: 21/01/17
 * Time: 22:50
 */

namespace AppBundle\Controller;



use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Transaction;
use AppBundle\Entity\Cheque;
class ChequeImageUploadController extends Controller

{
    /**
     * @Route(path="/upload/cheque/image", name="cheque_image")
     */
    public function chequeImageAction(){
        $logger = $this->get('logger');
        $logger->debug("ChequeImageUpload");
        $request =  $this->container->get('request_stack')->getCurrentRequest();
        $logger->debug($request);
        $logger->debug('--->'.$request->request->get('FRONT').'<---');
        $logger->debug($request->request->get('BACK'));
        $logger->debug($request->request->get('CHE_NO'));
        $logger->debug($request->request->get('REF_NO'));
        $refNo = $request->request->get('REF_NO');
        $chequeNo = $request->request->get('CHE_NO');
        $front = $request->request->get('FRONT');
        $back = $request->request->get('BACK');
        $em = $this->getDoctrine()->getManager();
        $chequeTransaction = $em->getRepository('AppBundle:Transaction')->findOneBy(["refNo"=>$refNo]);
        $logger->debug($chequeTransaction);
        $logger->debug("ffffffffffffffffff".$refNo);
        $cheque = $em->getRepository('AppBundle:Cheque')->findOneBy(["chequeTransaction"=>$chequeTransaction,"chequeNo" => $chequeNo]);
        $logger->debug($cheque->getChequeNo());
        $data = json_decode($request, true);

        //$image = base64_to_jpeg( $front, __DIR__.'/../../../web/cheque'.$chequeTransaction.'_'.$cheque.'_'.'front'.'.jpg' );
        //$logger->debug($data);
        $filefront = $this->get('kernel')->getRootDir().'/../web/cheque/'.$chequeTransaction.'_'.$cheque->getChequeNo().'_'.'front'.'.jpg';
        $fileback = $this->get('kernel')->getRootDir().'/../web/cheque/'.$chequeTransaction.'_'.$cheque->getChequeNo().'_'.'back'.'.jpg';

        $logger->debug($filefront);

        $cheque->setChequeFront($filefront);
        $cheque->setChequeBack($fileback);

        $em->persist($cheque);
        $em->flush();


        $imagefront =base64_decode( $front);
        $imageback =base64_decode( $back);

        file_put_contents($filefront, $imagefront);
        file_put_contents($fileback, $imageback);
//        $image = new Image();
//        $image->setImageFile($imagefront);
//        $em->persist($image);
//        $em->flush();
        return new JsonResponse("status:'404',massage:'success");
    }



}