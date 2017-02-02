<?php

namespace PaymentBundle\Controller;

use PaymentBundle\Entity\Payment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class PaymentController extends Controller
{
    /**
     * @param Payment $payment
     * @ParamConverter("payment", class="PaymentBundle:Payment")
     * @return Response
     */
    public function getAction(Payment $payment)
    {
        // nice var_dump from symfony
       // dump($id);

        //getting database (can be removed with using ParamConverter
        //$paymentRepository = $this->getDoctrine()->getRepository('PaymentBundle:Payment');
        //$payment = $paymentRepository->find($id);

        dump($payment);

        $payment1 = clone $payment;

        dump($payment1);

        return new Response($payment1->getName());
    }

}