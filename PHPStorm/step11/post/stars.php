<?php
$open = false;
require '../lib/site.inc.php';

$controller = new Noir\StarController($site,$_SESSION[LOGIN_SESSION]['user'] , $_POST);
echo $controller->getResult();