<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 4/24/2019
 * Time: 11:52 AM
 */

namespace Game;


class NuriView
{
    /**
     * NuriView constructor.
     * @param $player player name
     * @param $game game objects
     */
    public function __construct($player,$game)
    {
        $this->player = $player;
        $this->game = $game;
    }

    /**
     * The function to show the whole game board
     * return html to show the game board
     */
    public function present(){
        $html =<<<HTML
<form id="gameform" method="post" action="post/nuri.php">
<fieldset>
<p>$this->player's Super Nurikabe</p>
HTML;

        //the clue board
        $clue = Game::CLUE;
        //the solution board
        $solution = Game::SOLUTION;
        //current state board
        $board = $this->game->getBoard();
        //if the check mode is on
        $check = $this->game->isCheck();
        //if the player has won
        $won = $this->game->isWon();
        //if all the available square  is filled
        $full = $this->game->isFull();
        $html .= '<table>';

        for($r=0;  $r<count($board);  $r++) {
            $html .= '<tr>';
            $row_board = $board[$r];
            $row_clue = $clue[$r];
            $row_solution = $solution[$r];
            for($c=0; $c<count($row_board);  $c++) {
                // the square is wall
                // 1 is shaded
                // 2 is dot
                $row_num = $r+1;
                $col_num = $c+1;

                //if this square is only for dot shade or empty
                if($row_board[$c]!==0 && $row_clue[$c]===0){
                    //if the check mode off
                    if(!$check) {
                        //shaded
                        if ($row_board[$c] === 1) {
                            $html .= '<td class="shaded">';
                            $html .= <<<HTML
<button name="cell" value="$row_num,$col_num"></button>
HTML;

                        }
                        //dotted
                        if ($row_board[$c] === 2) {
                            $html .= '<td class="dotted">';
                            $html .= <<<HTML
<button name="cell" value="$row_num,$col_num">•</button>
HTML;

                        }
                    }
                    else{
                        //shaded
                        if ($row_board[$c] === 1) {
                            // both shaded
                            if($row_board[$c]===$row_solution[$c]) {
                                $html .= '<td class="shaded">';
                                $html .= <<<HTML
<button name="cell" value="$row_num,$col_num"></button>
HTML;
                            }
                            //correct is not shaded
                            else{
                                $html .= '<td class="shaded wrong">';
                                $html .= <<<HTML
<button name="cell" value="$row_num,$col_num"></button>
HTML;
                            }

                        }
                        //check dot
                        if ($row_board[$c] === 2) {
                            //both dotted
                            if ($row_board[$c] === $row_solution[$c]) {
                                $html .= '<td class="dotted">';
                                $html .= <<<HTML
<button name="cell" value="$row_num,$col_num">•</button>
HTML;

                            }
                            //correct is not dotted
                            else{
                                $html .= '<td class="dotted wrong">';
                                $html .= <<<HTML
<button name="cell" value="$row_num,$col_num">•</button>
HTML;
                            }
                        }
                    }
                    $html.='</td>';
                }

                //the square belongs to clue
                if($row_board[$c]===0 && $row_clue[$c]!==0){
                    $html .= '<td>';
                    $html .= $row_clue[$c];
                    $html .= '</td>';
                }
                //the square is empty
                if($row_board[$c]===0 && $row_clue[$c]===0){
                        $html.='<td>';
                        $html.=<<<HTML
<button name="cell" value="$row_num,$col_num"></button>
HTML;
                }


            }


            $html .= '</tr>';
        }
        //the value in check button
        $check_button = $this->game->isCheck()? "Uncheck":"Check";
        $html .= '</table>';

        //if the all the squares are filled and player does not win
        if($full and !$won){
            $html.=<<<HTML
<p>Solution is incorrect!</p>
HTML;

        }
        //player does not win
        if(!$won) {
            $html .= <<<HTML
<p><input type="submit" name="check" value=$check_button></p>
<p><input type="submit" name="giveup" value="Give Up"></p>
HTML;
        }
        //player wins
        if($won){
            $html.=<<<HTML
<p>Solution is correct!</p>
HTML;
        }
        $html.=<<<HTML
<p><input type="submit" name="newgame" value="New Game"></p>
<p><a href="./">Goodbye!</a></p>

</fieldset>
</form>

HTML;

        return $html;

    }


    private $player;//name of player
    private $game; // the game object
}