<?php
namespace YunkunBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; /* 路由 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller; /* 基类 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse; /* Json别忘了声明 */
use YunkunBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Doctrine\UserManager;


/**
 * User controller.
 *
 * @Route("/User")
 */

class UserController extends Controller
{
    /**
     * @Route("/{user_id}", name="userpage", requirements={"user_id": "\d+"})
     */
    public function indexAction($user_id=-1)
    {
        if ( $user_id < 0) {
            return $this->render(
                'portal/error.html.twig'
            );
        }

        return $this->render(
            // 'user/index.html.twig'
        );
    }

    /**
     * @Route("/admin/CreateNewUser", name="createUser")
     */
    public function createUserAction ()
    {
        date_default_timezone_set("Europe/Paris");
        $register_date = date_create(date('Y-m-d H:i:s'));

        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();

        $user->setUsername('Pig');
        $user->setEmail('kun@yunkun.org');
        $user->setPlainPassword('wycjdhr1991621');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setFirstname('Kun');
        $user->setLastname('XU');
        $user->setSex('F');
        $user->setPhone('(+33) 06 50 37 72 88');
        $user->setRegisterDate($register_date);

        $userManager->updateUser($user);

        return new Response('Saved new product with id '.$user->getId());
    }

    /**
     * @Route("/admin/UpdateUser", name="updateUser")
     */
    public function updateUserAction ()
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->findUserByUsername('Pig');

        $this->get('fos_user.user_manager')->updateUser($user, false);

        $user->setEmail();
        
        $this->getDoctrine()->getManager()->flush();

        return new Response('Saved new product with id '.$user->getId());
    }


}
