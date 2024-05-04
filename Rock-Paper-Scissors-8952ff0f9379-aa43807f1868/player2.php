<?php

session_start();

if (isset($_POST["p2"])) {
    $p2 = $_POST["p2"];
    $_SESSION["p2"] = $p2;
    header('location: uitslag.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
</head>

<body>
    <h1>Steen Papier Schaar</h1>
    <?php $p1 = $_SESSION["p1"]; ?>
    <p>Player 1 heeft zijn keuze gemaakt</p>
    <h1>de beurt van player 2 </h1>
    <form method="post">
        <input type="radio" name="p2" value="steen">steen
        <input type="radio" name="p2" value="papier">papier
        <input type="radio" name="p2" value="schaar">schaar
        <input type="submit" value="send">
    </form>
</body>

</html>