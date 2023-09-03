<?php
require 'lib/game.inc.php';
$view = new Wumpus\WumpusView($wumpus);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" type="text/css" rel="stylesheet" />
    <title>Stalking the Wumpus</title>
</head>
<body>
<header>
    <nav>
        <p><a href="welcome.php">New Game</a>
            <a href="game.php">Game</a>
            <a href="instructions.php">Instructions</a></p>
    </nav>
    <h1>Stalking the Wumpus</h1>
</header>
<div class="main">
<figure id="cave"><img src="cave.jpg" width="600" height="325" alt="cave picture"></figure>
    <div class="script">
        <?php
        echo $view->presentStatus();
        ?>
    </div>

    <div class="rooms">
        <?php
        echo $view->presentRoom(0);
        echo $view->presentRoom(1);
        echo $view->presentRoom(2);
        ?>
    </div>
    <div class="script">
        <?php
        echo $view->presentArrows();
        ?>
    </div>
</div>


</body>
</html>