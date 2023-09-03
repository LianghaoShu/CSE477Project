<?php
require '../lib/site.inc.php';
echo "<pre>";
print_r($_POST);
echo "</pre>";

$controller = new Felis\CaseController($site, $_POST);
header("location: " . $controller->getRedirect());