<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/26/2019
 * Time: 4:51 PM
 */

namespace Felis;


class UsersController {
    public function __construct(Site $site, User $user, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/user.php";
        $userRole = $user->getRole();
        if ($userRole !== $user::ADMIN){
            $this->redirect = "$root/users.php";
            return;
        }
        if(isset($post['id']) and isset($post['edit'])){
            $this->redirect = "$root/user.php?i=".$post['id'];
            return;
        }

        if(isset($post['id'] ) and isset($post['delete'])){
            $users = new Users($site);
            $users->delete($post['id']);
            $this->redirect = "$root/users.php";
            return;

        }
    }

    /**
     * @return mixed
     */
    public function getRedirect() {
        return $this->redirect;
    }


    private $redirect;	///< Page we will redirect the user to.
}