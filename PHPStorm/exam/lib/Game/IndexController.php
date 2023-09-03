<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 4/24/2019
 * Time: 10:47 AM
 */

namespace Game;

class IndexController
{
    /**
     * IndexController constructor.
     * @param $post the post
     * @param $session  the session
     */
    public function __construct($post, &$session)
    {
        if(isset($post['name'])){
            if(($post['name']))
            $this->redirect = 'nuri.php';
            $session[USER_NAME] = $post['name'];
        }

    }

    /** return redirect url
     * @return string redirect url
     */
    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect; // the page go to

}