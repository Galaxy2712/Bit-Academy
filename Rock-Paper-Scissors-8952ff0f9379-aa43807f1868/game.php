<?php

session_start();
if (isset($_POST["p1"])) {
    $p1 = $_POST["p1"];
    $_SESSION["p1"] = $p1;
    header('location: player2.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>rps</title>
    <script src="script.js"></script>
</head>

<body>
    <h1>Steen Papier Schaar</h1>
    <h1>Player 1:</h1>
    <form method="post">
        <input type="radio" name="p1" value="steen">steen
        <input type="radio" name="p1" value="papier">papier
        <input type="radio" name="p1" value="schaar">schaar
        <input type="submit" value="send">
    </form>
</body>

</html>