<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/26/2019
 * Time: 6:29 PM
 */

namespace Felis;


class PasswordValidateView extends View
{
    static $EMAIL_DOES_NOT_MATCH = 'Email address does not match validator';
    static $INVALID_VALIDATOR = 'Invalid or unavailable validator';
    static $NOT_VALID_USER = 'Email address is not for a valid user';
    static $PASSWORD_TOO_SHORT = 'Password too short';
    static $PASSWORD_NOT_MATCH = 'Passwords did not match';
    public function __construct(Site $site, $get){
        $this->site = $site;
        $this->validator = strip_tags($get['v']);
        $this->setTitle('Felis Password Entry');
        if(isset($get['e'])){
            $this->message = strip_tags($get['e']);
        }
    }

    public function present(){
        $html=<<<HTML
    <form method="post" action="post/password-validate.php">
        <fieldset>
            <legend>Change Password</legend>
            <p>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" placeholder="Email">
            </p>
            <p>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" placeholder="Password">
            </p>
            <p>
                <label for="password">Password(again)</label><br>
                <input type="password" id="password" name="password2" placeholder="Password">
            </p>
            <p>
                <input type="submit" value="Ok"> <input type="submit" value="Cancel" name="cancel">
            </p>
            <input type="hidden" name="validator" value="$this->validator">
            
            
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

    private $site;
    private $validator;
    private $message;
}