<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/18/2019
 * Time: 3:14 PM
 */

namespace Felis;


class LoginView extends View
{
    public function __construct($session, $get)
    {
        $this->setTitle("Felis Investigations");
        if(isset($get['e'])){
            $this->message = $session['CredentialError'];
        }
    }

    public function presentForm() {
        $html = <<<HTML
<form method="post" action="post/login.php">
    <fieldset>
        <legend>Login</legend>
        <p>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password">
        </p>
        <p>
            <input type="submit" value="Log in"> <a href="">Lost Password</a>
        </p>
        <p><a href="./">Felis Agency Home</a></p>
HTML;

        if($this->message){
            $html.=<<<HTML
            <p class="msg">$this->message</p>
HTML;
        }

        $html.=<<<HTML
    </fieldset>
</form>
HTML;

        return $html;
    }

    private $message; //Error message


}