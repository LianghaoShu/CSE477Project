<?php
require 'lib/site.inc.php';
$view = new \Felis\DeleteCaseView($site, $_GET);
if(!$view->protect($site, $user)) {
    header("location: " . $view->getProtectRedirect());
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $view->head();?>
</head>

<body>
<div class="case">
<!--<nav>
	<ul class="left">
		<li><a href="./">The Felis Agency</a></li>
	</ul>
	<ul class="right">
		<li><a href="staff.php">Staff</a></li>
		<li><a href="cases.php">Cases</a></li>
		<li><a href="./">Log out</a></li>
	</ul>
</nav>

<header class="main">
	<h1><img src="images/comfortable.png" alt="Felis Mascot"> Felis Delete? <img src="images/comfortable.png" alt="Felis Mascot"></h1>
</header>-->
    <?php echo $view->header();?>

<!--<form>
        <fieldset>
            <legend>Delete?</legend>
            <p>Are you sure absolutely certain beyond a shadow of
                a doubt that you want to delete case 15-1234?</p>

            <p>Speak now or forever hold your peace.</p>

            <p><input type="submit" value="Yes"> <input type="submit" value="No"></p>

        </fieldset>
</form>-->
    <?php echo $view->present();?>


<!--<footer>
	<p>Copyright © 2019 Felis Investigations, Inc. All rights reserved.</p>
</footer>-->
    <?php echo $view->footer();?>

</div>

</body>
</html>
