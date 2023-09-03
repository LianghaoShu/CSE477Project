<?php
require 'lib/site.inc.php';
$view = new Felis\CaseView($site, $_GET );
if(!$view->protect($site, $user)) {
    header("location: " . $view->getProtectRedirect());
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--<meta charset="utf-8">
<title>Felis Investigations Case</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/felis.css">-->
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
	<h1><img src="images/comfortable.png" alt="Felis Mascot"> Felis Case <img src="images/comfortable.png" alt="Felis Mascot"></h1>
</header>-->
    <?php echo $view->header();?>


    <?php echo $view->present();?>


<?php echo $view->footer();?>

</div>

</body>
</html>
