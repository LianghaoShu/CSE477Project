<?php
require '../lib/site.inc.php';

$controller = new Felis\UsersController($site, $user, $_POST);
header("location: " . $controller->getRedirect());
/*$a = $controller->getRedirect();
echo "<a href=\"$a\"> $a </a>>";*/