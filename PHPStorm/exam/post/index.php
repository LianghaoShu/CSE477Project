<?php
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
require __DIR__ . '/../lib/game.inc.php';
$controller = new \Game\IndexController($_POST, $_SESSION);


header("location: " . $root.$controller->getRedirect());

