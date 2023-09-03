<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/24/2019
 * Time: 5:35 PM
 */

namespace Felis;


class CasesController
{
    public function __construct(Site $site, $post){
        $root = $site->getRoot();

        if(isset($post['add'])){
            $this->redirect = $root . '/newcase.php';
        }

        elseif (isset($post['delete']) && isset($post['user'])){
            $id = strip_tags($post['user']);
            $this->redirect = $root. "/deletecase.php?id=$id";
        }
        else{
            $this->redirect = $root . '/cases.php';
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