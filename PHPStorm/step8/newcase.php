<?php
require 'lib/site.inc.php';
$view = new Felis\NewCaseView($site);
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
	<h1><img src="images/comfortable.png" alt="Felis Mascot"> Felis New Case <img src="images/comfortable.png" alt="Felis Mascot"></h1>
</header>-->
    <?php echo $view->header();?>

<!--<form>
	<fieldset>
		<legend>New Case</legend>
		<p>Client:
			<select>
				<option>Helm, Levon</option>
				<option>Astor, Mary</option>
			</select>
		</p>

		<p>
			<label for="number">Case Number: </label>
			<input type="text" id="number" name="number" placeholder="Case Number">
		</p>

		<p><input type="submit" value="OK"> <input type="submit" value="Cancel"></p>

	</fieldset>
</form>-->

    <?php echo $view->present(); ?>

<!--
<footer>
	<p>Copyright © 2019 Felis Investigations, Inc. All rights reserved.</p>
</footer>-->

    <?php echo $view->footer();?>

</div>

</body>
</html>
