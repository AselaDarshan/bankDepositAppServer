<?php
/**
 * Created by PhpStorm.
 * User: asela
 * Date: 9/15/16
 * Time: 10:53 PM
 */

namespace AppBundle\Controller;

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
        $response = array(
            'success' => true,
            'ref_no' =>"12345678"
        );

        return new JsonResponse($response);
    }
}