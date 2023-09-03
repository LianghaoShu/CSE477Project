<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/26/2019
 * Time: 3:50 PM
 */

namespace Felis;


class DeleteCaseController
{
    public function __construct(Site $site, $post){
        $root = $site->getRoot();
        $cases = new Cases($site);
        if(isset($post['no'])){
            $this->redirect = $root . '/cases.php';
        }

        elseif (isset($post['yes'])){
            $cases->delete($post['id']);
            $this->redirect = $root . '/cases.php';
        }
    }

    private $redirect;

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }
}