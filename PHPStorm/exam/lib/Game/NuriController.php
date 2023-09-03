<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 4/24/2019
 * Time: 4:52 PM
 */

namespace Game;


class NuriController
{

    public function __construct($post, $game)
    {
        if(isset($post['newgame'])){
            $this->redirect ='';
            $game->reset();
        }

        if(isset($post['check'])){
            if($post['check']==='Check'){
                $game->checkOn();
            }

            if($post['check']==='Uncheck'){
                $game->checkOff();
            }
        }

        if(isset($post['giveup'])){
            $game->giveUp();
        }

        if(isset($post['cell'])){
            $split = explode(',', strip_tags($post['cell']));
            $game->changeCell(+$split[0]-1,+$split[1]-1);
            $game->checkOff();
        }



        $this->redirect = 'nuri.php';
    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect;
}