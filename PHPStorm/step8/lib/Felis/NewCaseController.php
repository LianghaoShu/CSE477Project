<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/24/2019
 * Time: 11:20 PM
 */

namespace Felis;


class NewCaseController
{
    public function __construct(Site $site,$user, $post){
        $root = $site->getRoot();
        if(!isset($post['ok'])) {
            $this->redirect = "$root/cases.php";
            return;
        }

        $cases = new Cases($site);
        $id = $cases->insert(strip_tags($post['client']),
            $user->getId(),
            strip_tags($post['number']));

        if($id === null) {
            $this->redirect = "$root/newcase.php?e";
        } else {
            $this->redirect = "$root/case.php?id=$id";
        }

    }

    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    private $redirect;

}