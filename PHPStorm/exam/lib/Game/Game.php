<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 4/24/2019
 * Time: 11:09 AM
 */

namespace Game;

class Game
{
    // Puzzle location values
    const CLUE = [
    [0, 0, 0, 4, 0, 0, 0, 7],
    [0, 0, 0, 0, 2, 0, 0, 0],
    [0, 0, 0, 1, 0, 0, 0, 0],
    [0, 0, 4, 0, 0, 0, 0, 0],
    [0, 0, 0, 1, 0, 2, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 3, 0, 0, 0, 0, 0],
    [0, 3, 0, 0, 0, 0, 0, 2]
    ];

        // Puzzle solution
        // 2 = dotted
        // 1 = shaded
    const SOLUTION = [
    [2, 2, 2, 0, 1, 1, 1, 0],
    [1, 1, 1, 1, 0, 2, 1, 2],
    [1, 2, 1, 0, 1, 1, 1, 2],
    [1, 2, 0, 1, 1, 2, 1, 2],
    [1, 2, 1, 0, 1, 0, 1, 2],
    [1, 1, 1, 1, 1, 1, 2, 2],
    [2, 1, 0, 2, 2, 1, 1, 1],
    [2, 0, 1, 1, 1, 1, 2, 0]
    ];

    //the new game board
    const ORIGIN = [
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0]
    ];


    /**
     * Game constructor.
     */
    public function __construct()
    {
        // 1 = shaded, 2 = dotted
        $this->board = self::ORIGIN;

    }

    /** The game board
     * @return array game board
     */
    public function getBoard(){
        return $this->board;
    }

    /** change the cell value in the board
     * @param $row  row of the cell
     * @param $col  col of the cell
     */
    public function changeCell($row,$col){
        $value = $this->board[$row][$col] + 1;
        if($value===3){
            $value = 0;
        }

        $this->board[$row][$col] = $value;
    }

    /** if the check mode oon
     * @return bool status of check mode
     */
    public function isCheck(){
        return $this->check;
    }

    /**
     *  reset the game
     */
    public function reset(){
        $this->board = self::ORIGIN;
        $this->check = false;
    }

    /**
     * check mode on
     */
    public function checkOn(){
        $this->check = true;
    }

    /**
     * check mode off
     */
    public function checkOff(){
        $this->check = false;
    }

    /** If player has won
     * @return bool
     */
    public function isWon(){
        if($this->board===self::SOLUTION){
            return true;
        }
        return false;
    }

    /**
     * show players the solution
     */
    public function giveUp(){
        $this->board = self::SOLUTION;
    }

    /** if all the available square are filled
     * @return bool if all square are filled
     */
    public function isFull(){
        for($r = 0;$r<count(self::SOLUTION);$r++){
            $board_row = $this->board[$r];
            $clue_row = self::CLUE[$r];
            for($c=0;$c<count(self::SOLUTION);$c++){
                if($board_row[$c]===0 and $clue_row !==0 ){
                    return false;
                }
            }
        }
        return true;
    }




    private $board; // current state on the board
    private $check = false; // the check mode is on

}