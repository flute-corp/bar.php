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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'bar.nexk.fr/api/web/notifications/subscription');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

// If using JSON...
        $data = json_decode($response);

        if ($data) {
            $webPush = $this->get('minishlink_web_push');

            foreach ($data as $oSub) {
                $webPush->sendNotification(
                    $oSub->endpoint,
                    '{}', // optional (defaults null)
                    $oSub->p256dh, // optional (defaults null)
                    $oSub->auth // optional (defaults null)
                );
            }
            return $webPush->flush();
        }

        return 'nope.jpg';
    }

    /**
     * @return PushSubscription[]|array
     *
     * @JMS\View()
     */
    public function getSubscriptionAction() {
        $em = $this->getDoctrine()->getManager();
        $aSubscription = $em->getRepository('ApiBundle:PushSubscription')->findAll();
        return $aSubscription;
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
