<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/18/2019
 * Time: 2:31 PM
 */

namespace Felis;


class LoginController
{
    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param array $session $_SESSION
     * @param array $post $_POST
     */
    public function __construct(Site $site, array &$session, array $post) {
        // Create a Users object to access the table
        $users = new Users($site);

        $email = strip_tags($post['email']);
        $password = strip_tags($post['password']);
        $user = $users->login($email, $password);
        $session[User::SESSION_NAME] = $user;


        $root = $site->getRoot();
        if($user === null) {
            // Login failed
            $this->redirect = "$root/login.php?e";
            $session["CredentialError"] = "Invalid login credentials";
        } else {
            if($user->isStaff()) {
                $this->redirect = "$root/staff.php";
            } else {
                $this->redirect = "$root/client.php";
            }
        }
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }	// Page we will redirect the user to.


    private $redirect;
}