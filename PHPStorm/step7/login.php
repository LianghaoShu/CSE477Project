<?php
$open = true;
require 'lib/site.inc.php';
$view = new Felis\LoginView($_SESSION, $_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <?php echo $view->head(); ?>
</head>

<body>
<div class="login">
    <?php echo $view->header(); ?>
    <?php echo $view->presentForm()?>
    <?php echo $view->footer(); ?>
</div>

</body>
</html>
