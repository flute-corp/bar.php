<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\PushSubscription;
use Doctrine\DBAL\Exception\ConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as JMS;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class NotificationsController extends Controller
{

    public function getAperoAction() {
        $em = $this->getDoctrine()->getManager();
        $webPush = $this->get('minishlink_web_push');
        $aSubscription = $em->getRepository('ApiBundle:PushSubscription')->findAll();

        foreach ($aSubscription as $oSub) {
            $webPush->sendNotification(
                $oSub->getEndpoint(),
                '{}', // optional (defaults null)
                $oSub->getP256dh(), // optional (defaults null)
                $oSub->getAuth() // optional (defaults null)
            );
        }
        $webPush->flush();
        return true;
    }
    /**
     * @param PushSubscription $oSubscription
     * @param ConstraintViolationListInterface $validationErrors
     * @return PushSubscription
     *
     * @JMS\QueryParam(name="oSubscription")
     * @ParamConverter(
     *     "oSubscription",
     *     class="ApiBundle\Entity\PushSubscription",
     *     converter="fos_rest.request_body",
     *     options={"deserializationContext"={"groups"={"postSubscription"}}}
     * )
     * @JMS\View()
     */
    public function postSubscriptionAction(PushSubscription $oSubscription, ConstraintViolationListInterface $validationErrors = null) {
        $em = $this->getDoctrine()->getManager();

        try {
            $em->persist($oSubscription);
            $em->flush();
        } catch (ConstraintViolationException $exception) {
            return $em->getRepository('ApiBundle:PushSubscription')->findOneBy(array('endpoint' => $oSubscription->getEndpoint()));
        }

        return $oSubscription;
    }

    public function deleteSubscriptionAction(PushSubscription $id) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        return true;
    }

}
