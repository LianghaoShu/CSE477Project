<?php
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

require '../lib/site.inc.php';

$controller = new Felis\UserController($site, $user, $_POST);
header("location: " . $controller->getRedirect());
/*$a = $controller->getRedirect();
echo "<a href=\"$a\"> $a </a>";*/