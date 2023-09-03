<?php
require 'format.inc.php';
require 'wumpus.inc.php';
$room = 1; // The room we are in.
$birds = 7;  // Room with the birds
$cave = cave_array(); // Get the cave
$pits = array(3, 10, 13);    // Rooms with a bottomless pit
$wumpus = 16; // Room with the Wumpus
if(isset($_GET['r']) && isset($cave[$_GET['r']])) {
    // We have been passed a room number
    $room = $_GET['r'];

}
if ($room == $birds){
    $room = 10;
}
if (in_array($room, $pits) || $room == $wumpus){
    header("Location: lose.php");
    exit;
}

if(isset($_GET['a']) && isset($cave[$_GET['a']])){
    if($wumpus == $_GET['a']){
        header("Location: win.php");
        exit;
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" type="text/css" rel="stylesheet" />
    <title>Stalking the Wumpus</title>
</head>
<body>
<?php echo present_header("Stalking the Wumpus"); ?>
<div class="main">
<figure id="cave"><img src="cave.jpg" width="600" height="325" alt="cave picture"></figure>
    <div class="script">
        <?php
        echo '<p>' . date("g:ia l, F j, Y") . '</p>';
        ?>
        <p id="first">You are in room <?php echo $room; ?></p>
        <?php

        $html = '<p id = \"second\">';
        if ($cave[$room][0] == $birds || $cave[$room][1] == $birds || $cave[$room][2] == $birds){
            $html.= 'You hear birds!';
        }
        else{
            $html.= '&nbsp;';
        }

        $html.= '</p>';
        echo "$html";
        $draft = '<p id=\"third\">';
        if(in_array($cave[$room][0], $pits) || in_array($cave[$room][1], $pits) || in_array($cave[$room][2], $pits)){
            $draft.= 'You feel a draft!';
        }
        else{
            $draft.= '&nbsp;';
        }
        $draft.= '</p>';
        echo "$draft";

        $result = '<p id=\"fourth\">';
        $firstcave = $cave[$cave[$room][0]];
        $secondcave = $cave[$cave[$room][1]];
        $thirdcave = $cave[$cave[$room][2]];
        if(in_array($wumpus, $cave[$room]) || in_array($wumpus, $firstcave)|| in_array($wumpus,$secondcave) ||
            in_array($wumpus, $thirdcave)){
            $result.='You smell a wumpus!';
        }
        else{
            $result.=  '&nbsp;';
        }

        $result.='</p>';
        echo "$result";

        ?>
    </div>

    <div class="rooms">
        <div class="room"><figure><img src="cave2.jpg" width="180" height="135" alt="first cave">
                <a href="game.php?r=<?php echo $cave[$room][0]; ?>">
                    <p class="number"><?php echo $cave[$room][0]; ?></p></a>
                <a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][0]; ?>">
                        <p>Shoot Arrow</p></a>
            </figure>
        </div><div class="room"><figure><img src="cave2.jpg" width="180" height="135" alt="second cave">
                <a href="game.php?r=<?php echo $cave[$room][1]; ?>"><p class="number"><?php echo $cave[$room][1]; ?></p>
                </a><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][1]; ?>"><p>Shoot Arrow</p>
                </a></figure>
    </div><div class="room"><figure><img src="cave2.jpg" width="180" height="135" alt="third cave">
        <a href="game.php?r=<?php echo $cave[$room][2]; ?>">
            <p class="number"><?php echo $cave[$room][2]; ?></p></a>
                <a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][2]; ?>"><p>Shoot Arrow</p></a>
            </figure>
    </div>
    </div>
    <div class="script">
    <p id="fifth">You have 3 arrows remaining.</p>
    </div>
</div>


</body>
</html>