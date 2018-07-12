<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Doctrine\UserManager;

/**
 * Userpage controller.
 *
 * @Route("/Userpage")
 */

class UserpageController extends Controller
{
    /**
     * @Route("/", name="userpage")
     */
    public function index(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        $user = array();
        foreach ($users as $value) {
            array_push($user, array(
                'username' => $value->getUsername(),
                'firstname' => $value->getFirstname(),
                'lastname' => $value->getLastname(),
                'sex' => $value->getSex(),
                'email' => $value->getEmail(),
                'enable' => $value->isEnabled(),
                'lastlogin' => $value->getLastLogin(),
                'role' => $value->getRoles(),
                'phone' => $value->getPhone(),
                'regsterdate' => $value->getRegisterDate()
            ));
        }
        $users_paginate = $this->get('knp_paginator')->paginate($user, $request->query->get('page',1),3);
        return $this->render('userpage/index.html.twig', [
            'users_paginate' =>$users_paginate
        ]);
    }

    /**
     * @Route("/create", name="adduserpage")
     */
    public function create()
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();

        $firstname = "Test1";
        $lastname = "";
        $username = "test1";
        $sex = "F";
        $email = "test1@yopmail.com";
        $plainPassword = "wycjdhr1991621";
        $phone = "";
        $role = array("ROLE_RECRUITER");

        date_default_timezone_set("Europe/Paris");
        $register_date = date_create(date('Y-m-d H:i:s'));

        $user->setFirstname($firstname);
        // $user->setLastname($lastname);
        $user->setUsername($username);
        $user->setSex($sex);
        $user->setEmail($email);
        $user->setPlainPassword($plainPassword);
        // $user->setPhone($phone);
        $user->setRoles($role);
        $user->setRegisterDate($register_date);
        $user->setEnabled(true);

        $userManager->updateUser($user);
        return $this->redirectToRoute('userpage');
    }

    /**
     * @Route("/preupdate/{username}", name="preupdateuserpage")
     */
    public function preupdate(Request $request, $username=-1)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($username);
        /*
         $user->setUsername('test2');
        $user->setEnabled(true);

        $userManager->updateUser($user); */
        return $this->render('userpage/edit.html.twig', [
            'username' => $user->getUsername(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'sex' => $user->getSex(),
            'email' => $user->getEmail(),
            'enable' => $user->isEnabled(),
            'role' => $user->getRoles(),
            'phone' => $user->getPhone() 
        ]);
    }

    /**
     * @Route("/update/{username}", name="updateuserpage")
     */
    public function update(Request $request, $username=-1)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($username);

        $username = $_POST['user_edit_username'];
        $firstname = $_POST['user_edit_firstname'];
        $lastname = $_POST['user_edit_lastname'];
        $sex = $_POST['user_edit_sex'];
        $email = $_POST['user_edit_email'];
        $phone = $_POST['user_edit_phone'];
        $roles = array($_POST['user_edit_roles']);
        $enable = $_POST['user_edit_enable'];

        $user->setUsername($username);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setSex($sex);
        $user->setEmail($email);
        $user->setPhone($phone);
        $user->setRoles($roles);
        $user->setEnabled($enable);

        $userManager->updateUser($user);

        return $this->redirectToRoute('userpage');

    }

    /**
     * @Route("/remove/{username}", name="removeuserpage")
     */
    public function remove(Request $request, $username=-1)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($username);
        $userManager->deleteUser($user);
        return $this->redirectToRoute('userpage');
    }
}
