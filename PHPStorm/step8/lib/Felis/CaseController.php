<?php
/**
 * Created by PhpStorm.
 * User: cqshu
 * Date: 3/25/2019
 * Time: 5:52 PM
 */

namespace Felis;


class CaseController
{
    public function __construct(Site $site, $post){
        $root = $site->getRoot();
        $id = strip_tags($post['id']);
        $row = array(
            'id'=>strip_tags($post['id']),
            'agent'=>strip_tags($post['agent']),
            'number'=>strip_tags($post['number']),
            'status'=>strip_tags($post['status']),
            'summary'=>strip_tags($post['summary'])
        );
        $cases = new Cases($site);
        if(!$cases->update($row)){
            $this->redirect = $root."/case.php?id=$id";
        }
        else{
            $this->redirect = $root."/cases.php";
        }





    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }


    private $redirect;
}