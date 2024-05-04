<?php

session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>uitslag</title>
</head>

<body>
    <h1>Steen Papier Schaar</h1>
    <?php
    $p1 = $_SESSION["p1"];
    $p2 = $_SESSION["p2"];

    if ($p1 == "steen") {
        if ($p2 == "schaar") {
            $winnaar = "Player 1";
        }
    }
    if ($p1 == "papier") {
        if ($p2 == "steen") {
            $winnaar = "player 1";
        }
    }
    if ($p1 == "schaar") {
        if ($p2 == "papier") {
            $winnaar = "player 1";
        }
    }
    if ($p2 == "steen") {
        if ($p1 == "schaar") {
            $winnaar = "player 2";
        }
    }
    if ($p2 == "papier") {
        if ($p1 == "steen") {
            $winnaar = "player 2";
        }
    }
    if ($p2 == "schaar") {
        if ($p1 == "papier") {
            $winnaar = "player 2";
        }
    }
    if ($p1 == "steen") {
        if ($p2 == "steen") {
            $winnaar = "player 1/player 2";
        }
    }
    if ($p1 == "papier") {
        if ($p2 == "papier") {
            $winnaar = "player 1/player 2";
        }
    }
    if ($p1 == "schaar") {
        if ($p2 == "schaar") {
            $winnaar = "player 1/player 2";
        }
    }
    ?>
    <h2>Player 1 heeft <?= $p1 ?> Gekozen</h2>
    <h2>Player 2 heeft <?= $p2 ?> Gekozen</h2>

    <br>
    <br>

    <h1>De winnaar is <?= $winnaar ?></h1>
</body>

</html>