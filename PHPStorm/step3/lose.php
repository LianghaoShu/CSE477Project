<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <meta charset="UTF-8">
    <title>The Wumpus Kiiled You</title>
</head>
<body>
<?php echo present_header("Stalking the Wumpus"); ?>
<div class="main">
    <figure id="cave"><img src="wumpus-wins.jpg" width="600" height="325" alt="cave picture"></figure>
    <p id="victory">You died and the Wumpus ate your brain!</p>
    <p class="action"><a href="welcome.php">New Game</a></p>
</div>

</body>
</html>