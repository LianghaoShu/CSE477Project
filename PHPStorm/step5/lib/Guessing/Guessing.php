<?php
/**
 * Created by PhpStorm.
 * User: Lianghao Shu
 * Date: 2/10/2019
 * Time: 4:54 PM
 */

namespace Guessing;


use MongoDB\BSON\MaxKey;

class Guessing
{
    const MIN = 1;
    const MAX = 100;

    const INVALID = 0;
    const CORRECT = 1;
    const TOOHIGH = 2;
    const TOOLOW = 3;
    const NewGame = 4;


    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
    }

    /**
     * Get the right number
     * @return right number
     */
    public function getNumber(){
        return $this->number;
    }

    /**
     * Get the number user guessed
     * @return number user guessed
     */
    public function getNumGuesses(){
        return $this->count;
    }

    /**
     * @param $input the thing user guessed
     */
    public function guess($input){
        $this->guess = $input;
        $this->new = 0;
        if($this->guess>=self::MIN && $this->guess<=self::MAX && is_numeric($this->guess)){
            $this->count++;
        }
    }

    /**
     * If input user value is valid
     * @return int if the user guess value is valid
     */
    public function check(){
        if($this->new == 0) {
            if (!(is_numeric($this->guess)) || $this->guess < self::MIN || $this->guess > self::MAX) {
                return self::INVALID;
            }

            if ($this->guess < $this->number) {
                return self::TOOLOW;
            }

            if ($this->guess > $this->number) {
                return self::TOOHIGH;
            }

            if ($this->guess == $this->number) {
                return self::CORRECT;
            }
        }

        else{
            return self::NewGame;
        }

    }

    /**
     * Get user guessed value
     * @return user guessed value
     */
    public function getGuess(){
        return $this->guess;
    }




    private $number;
    private $guess;
    private $count = 0;
    private $new = 1;
}