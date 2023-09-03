<?php
/**
 * @file
 * A file loaded for all pages on the site.
 */
require __DIR__ . "/../vendor/autoload.php";

define("LOGIN_SESSION", "ajaxnoir_login");
define("LOGIN_COOKIE", "ajaxnoir_cookie");

// Start the session system
session_start();

// Create and localize the Site object
$site = new Noir\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
	$localize($site);
}

/*
 * Login functionality
 */
if(!isset($open)) {
    // This is a page other than the login pages
    if (!isset($_SESSION[LOGIN_SESSION])) {
        $root = $site->getRoot();
        $cookie = $_COOKIE[LOGIN_COOKIE];
        //if cookie exits and is not empty
        if($cookie){
            $cooki = json_decode($cookie,true);

            if($cooki){
                $user = $cooki['user'];
                $token = $cooki['token'];
                $_SESSION[LOGIN_SESSION] = array("user" => $user);
                $cookies = new \Noir\Cookies($site);
                //if cookie is valid
                if(!$cookies->validate($user, $token)){
                    header("location: $root/login.php");
                    exit;
                }

                //delete hash from database
                $hash = hash("sha256", $token);
                $cookies->delete($hash);

                //new token
                $newtoken = $cookies->create($user);
                $expire = time() + (86400 * 365); // 86400 = 1 day
                $cookie = array("user" => $user, "token" => $token);
                setcookie(LOGIN_COOKIE, json_encode($cookie), $expire, "/");
                return;
            }
            else{
                header("location: $root/login.php");
                exit;
            }


        }



        // If not logged in, force to the login page

        header("location: $root/login.php");
        exit;
    } else {
        // We are logged in.
        $user = $_SESSION[LOGIN_SESSION]['user'];
    }
}

