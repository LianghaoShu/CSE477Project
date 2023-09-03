<?php
require 'lib/game.inc.php';
$view = new Wumpus\WumpusView($wumpus);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <meta charset="UTF-8">
    <title>Welcome to Stalking Wumpus</title>
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
    <figure id="cave"><img src="cave-evil-cat.png" width="600" height="325" alt="cave picture"></figure>
    <div class="welcomescript">
        <div class="inline">
            <p id="welcomefirst">Welcome to</p></div> <div class="inline"><p id="tile">Stalking the wumpus</p></div>
        <p class="operation"><a href="instructions.php">Instructions</a></p>
        <p class="operation"><a href="game-post.php?n">Start Game</a></p>
    </div>
</div>

</body>
</html>