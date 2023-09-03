<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 1/31/2019
 * Time: 6:10 PM
 */

namespace Wumpus;


class WumpusController
{
    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     * @param array $get The $_GET array
     */
    public function __construct(Wumpus $wumpus, $get) {
        $this->wumpus = $wumpus;

        if(isset($get['m'])) {
            $this->move($get['m']);
        } else if(isset($get['s'])) {
            $this->shoot($get['s']);
        } else if(isset($get['n'])) {
            // New game!
            $this->reset = true;
        } else if(isset($get['c'])){
            $this->cheat = true;
        }

    }
    /**
     * Get next page's url
     * @return next page url
     */
    public function getPage(){
        return $this->page;
    }

    /**
     * get the status if we need to reset game
     * @return if we need to reset the game
     */
    public function isReset(){
        return $this->reset;
    }

    public function ischeat(){
        return $this->cheat;
    }

    /**
     * Move request
     * @param int $ndx Index for room to move to
     */
    private function move($ndx) {
        // Simple error check
        if(!is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS) {
            return;
        }

        switch($this->wumpus->move($ndx)) {
            case Wumpus::HAPPY:
                break;

            case Wumpus::EATEN:
            case Wumpus::FELL:
                $this->reset = true;
                $this->page = 'lose.php';
                break;
        }
    }

    /**
     * Shoot request
     * @param int $ndx Index for room to shoot into
     */
    private function shoot($ndx) {
        // Simple error check
        if(!is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS) {
            return;
        }

        if($this->wumpus->shoot($ndx)){
            $this->reset=true;
            $this->page='win.php';
        }


    }
    private $wumpus;                // The Wumpus object we are controlling
    private $page = 'game.php';     // The next page we will go to
    private $reset = false;         // True if we need to reset the game
    private $cheat = false;       // True if the cheat mode is on

}