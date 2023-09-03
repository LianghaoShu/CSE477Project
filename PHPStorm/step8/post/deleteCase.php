<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";
require '../lib/site.inc.php';
$controller = new Felis\DeleteCaseController($site, $_POST);
header("location: " . $controller->getRedirect());