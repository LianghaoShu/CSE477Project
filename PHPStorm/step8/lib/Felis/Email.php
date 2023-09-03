<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/26/2019
 * Time: 5:26 PM
 */

namespace Felis;


/**
 * Email adapter class
 */
class Email {
    public function mail($to, $subject, $message, $headers) {
        mail($to, $subject, $message, $headers);
    }
}