<?php
require __DIR__ . "/../vendor/autoload.php";

session_start();

define("USER_SESSION", 'game');
define("USER_NAME",'username');

if(!isset($_SESSION[USER_SESSION])) {
    $_SESSION[USER_SESSION] = new Game\Game();
}

$game = $_SESSION[USER_SESSION];
$root = '/~shulian1/exam/';