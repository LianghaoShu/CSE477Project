<?php
require __DIR__ . '/lib/game.inc.php';
$game->reset();
$view = new \Game\IndexView();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Super Nurikabe Signin</title>
    <link href="nuri.css" type="text/css" rel="stylesheet" />

</head>
<body>
<!--<form id="signin" method="post" action="">
    <fieldset>
        <p><img src="img/banner.png" width="521" height="346" alt="Super Nurikabe Banner"></p>
        <p>Welcome to Super Nurikabe</p>
        <p><label for="name">Your Name: </label>
            <input type="text" name="name" id="name"></p>
        <p><input type="submit" value="Start Game"></p>
    </fieldset>
</form>-->
<?php echo $view->present();?>

</body>
</html>