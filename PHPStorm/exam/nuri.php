<?php
require __DIR__ . '/lib/game.inc.php';

if(!isset($_SESSION[USER_NAME])){
    header('location:'. $root);
    exit;
}

$view = new \Game\NuriView($_SESSION[USER_NAME],$game);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="nuri.css" type="text/css" rel="stylesheet" />
    <title>Super Nurikabe</title>
</head>

<body>

<?php echo $view->present();?>


</body>
</html>
