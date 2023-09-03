<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/18/2019
 * Time: 3:05 PM
 */
require '../lib/site.inc.php';
unset($_SESSION['user']);
header('location:'.$site->getRoot());