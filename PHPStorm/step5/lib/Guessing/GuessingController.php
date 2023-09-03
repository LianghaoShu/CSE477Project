<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 2/10/2019
 * Time: 11:18 PM
 */

namespace Guessing;


class GuessingController
{
    public function __construct(Guessing $guessing, $post){
        $this->guessing = $guessing;
        if(isset($post['clear'])) {
            $this->reset = true;
        }

        if (isset($post['value'])){
            $value = strip_tags($post['value']);
            $this->guessing->guess($value);
        }
    }

    public function isReset(){
        return $this->reset;
    }




    private $reset = false;
    private $guessing;
}