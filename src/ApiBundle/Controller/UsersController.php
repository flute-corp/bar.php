<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\User;
use ApiBundle\Mixin\ConstraintViolationValidable;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as JMS;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UsersController extends Controller
{

    use ConstraintViolationValidable;

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
     *
     * @return User
     *
     * @JMS\QueryParam(name="oUser")
     * @ParamConverter(
     *     "oUser",
     *     class="ApiBundle\Entity\User",
     *     converter="fos_rest.request_body",
     *     options={"deserializationContext"={"groups"={"postUsers"}}}
     * )
     * @JMS\View(serializerGroups={"getUsers","getLogin"})
     */
    public function postUserAction(User $oUser, ConstraintViolationListInterface $validationErrors = null) {
        if ($validationErrors) $this->checkErrors($validationErrors);
        $em = $this->getDoctrine()->getManager();
        $id = $oUser->getId();

        $oLoggedUser = $this->get('security.token_storage')->getToken()->getUser();
        if ($id) {
            if ($oLoggedUser != $oUser) {
                throw new AccessDeniedHttpException('Vous ne pouvez modifier que votre profil');
            }
        }
        if ($oUser->getLabel() === null) {
            $oUser->setLabel($oUser->getUsername());
        }
        $em->persist($oUser);
        try {
            $em->flush();
        } catch (\Exception $e) {
            if ($e instanceof UniqueConstraintViolationException) {
                throw new ConflictHttpException('Cet utilisateur est déjà utilisé');
            }
            throw new ServiceUnavailableHttpException('L\'enregistrement de l\'utilisateur à échouée...');
        }

        return $oUser;
    }

    /**
     * @return bool|mixed
     *
     * @JMS\View(serializerGroups={"getUsers","getLogin"})
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
     * @JMS\View(serializerGroups={"getUsers","getLogin"})
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
    /**
     * @param User $oUser
     *
     * @return User
     *
     * @JMS\QueryParam(name="oUser")
     * @ParamConverter(
     *     "oUser",
     *     class="ApiBundle\Entity\User",
     *     converter="fos_rest.request_body",
     *     options={"deserializationContext"={"groups"={"postUsers"}}}
     * )
     * @JMS\View(serializerGroups={"getUsers","getLogin"})
     */
    public function postRegisterAction(User $oUser, ConstraintViolationListInterface $validationErrors = null) {
        $this->postUserAction($oUser, $validationErrors);

        $this->_logHas($oUser);

        return $oUser;
    }

}
