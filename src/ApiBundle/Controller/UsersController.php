<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as JMS;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UsersController extends Controller
{
    /**
     * @JMS\View(serializerGroups={"getUsers"})
     * @return \ApiBundle\Entity\User[]
     */
    public function getUsersAction()
    {
        return $this->getDoctrine()->getRepository('ApiBundle:User')->findAll();
    }

    /**
     * @param User $oUser
     * @return User
     *
     * @JMS\View(serializerGroups={"getUsers"})
     */
    public function getUserAction(User $oUser) {
        return $oUser;
    }

    protected function _logHas(User $oUser) {
        $oToken = new UsernamePasswordToken($oUser, null, "main", $oUser->getRoles());
        $this->get('security.token_storage')->setToken($oToken);
    }

    /**
     * @param User $oUser
     * @return User
     *
     * @JMS\QueryParam(name="oUser")
     * @ParamConverter(
     *     "oUser",
     *     class="ApiBundle\Entity\User",
     *     converter="fos_rest.request_body",
     *     options={"deserializationContext"={"groups"={"postUsers"}}}
     * )
     * @JMS\View(serializerGroups={"getUsers"})
     */
    public function postUserAction(User $oUser) {
        $em = $this->getDoctrine()->getManager();
        if ($oUser->getId()) {
            $oLoggedUser = $this->get('security.token_storage')->getToken()->getUser();
            if ($oLoggedUser != $oUser) {
                throw new AccessDeniedHttpException('Vous ne pouvez modifier que votre profil');
            }
        } else {
            $this->_logHas($oUser);
        }
        if ($oUser->getLabel() === null) {
            $oUser->setLabel($oUser->getUsername());
        }
        $em->persist($oUser);
        $em->flush();

        return $oUser;
    }

    /**
     * @return bool|mixed
     *
     * @JMS\View(serializerGroups={"getUsers"})
     */
    public function getLoginAction() {
        if ($this->isGranted('ROLE_USER')) {
            return $this->get('security.token_storage')->getToken()->getUser();
        }
        return false;
    }

    /**
     * @param Request $request
     * @return User|null|object
     *
     * @JMS\View(serializerGroups={"getUsers"})
     */
    public function postLoginAction(Request $request) {
        $param = $request->request->all();

        if (isset($param['username']) && isset($param['password'])) {
            $repUser = $this->getDoctrine()->getRepository('ApiBundle:User');
            $oUser = $repUser->findOneBy(array('username' => $param['username']));
            if ($oUser) {
                $srvEncoder = $this->get('security.password_encoder');
                if ($srvEncoder->isPasswordValid($oUser, $param['password'])) {
                    $this->_logHas($oUser);
                    return $oUser;
                }
            }
        }

        throw new AccessDeniedHttpException('Combinaison user / password incorrecte');
    }


}
