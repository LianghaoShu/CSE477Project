<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 4/24/2019
 * Time: 10:47 AM
 */

namespace Game;

class IndexView
{
    /** present the welcome page
     * @return string welcome page
     */
    public function present(){
        $html=<<<HTML
<form id="signin" method="post" action="post/index.php">
    <fieldset>
        <p><img src="img/banner.png" width="521" height="346" alt="Super Nurikabe Banner"></p>
        <p>Welcome to Super Nurikabe</p>
        <p><label for="name">Your Name: </label>
            <input type="text" name="name" id="name"></p>
        <p><input type="submit" value="Start Game"></p>
    </fieldset>
</form>
HTML;
        return $html;
    }


}