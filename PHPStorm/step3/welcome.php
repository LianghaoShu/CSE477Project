<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <meta charset="UTF-8">
    <title>Welcome to Stalking Wumpus</title>
</head>
<body>
<?php echo present_header("Stalking the Wumpus"); ?>

<div class="main">
    <figure id="cave"><img src="cave-evil-cat.png" width="600" height="325" alt="cave picture"></figure>
    <div class="welcomescript">
        <div class="inline">
            <p id="welcomefirst">Welcome to</p></div> <div class="inline"><p id="tile">Stalking the wumpus</p></div>
        <p class="operation"><a href="instructions.php">Instructions</a></p>
        <p class="operation"><a href="game.php">Start Game</a></p>
    </div>
</div>

</body>
</html>