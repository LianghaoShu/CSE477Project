<?php
$open = true;
require 'lib/site.inc.php';
$view = new Felis\PasswordValidateView($site, $_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="password">

    <?php
    echo $view->header();
    ?>

   <!-- <form method="post" action="post/password-validate.php">
        <fieldset>
            <legend>Change Password</legend>
            <p>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" placeholder="Email">
            </p>
            <p>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" placeholder="Password">
            </p>
            <p>
                <label for="password">Password(again)</label><br>
                <input type="password" id="password" name="password" placeholder="Password">
            </p>
            <p>
                <input type="submit" value="Ok"> <input type="submit" value="Cancel">
            </p>
        </fieldset>
    </form>-->
<?php echo $view->present();?>
    <?php
    echo $view->footer();
    ?>

</div>

</body>
</html>