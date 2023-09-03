<?php
$open = true;
require '../lib/site.inc.php';

$controller = new Noir\LoginController($site, $_POST, $_SESSION);
header("location: " . $controller->getRedirect());
//echo $controller->linkRedirect();