<?php
session_start();

// Woordenlijst
$woorden = array(
    "time",
    "test",
    "balloon",
    "words",
    "behind",
    "missing",
    "unlucky",
    "studying",
    "gardening",
    "pulling",
    "strongest",
    "outlets",
    "trip",
    "beers",
    "fries",
    "cyclists",
    "blitzes",
    "tramble",
    "edge",
    "movies",
    "christmas",
    "markets",
    "milk",
    "peacock",
    "giraffe",
    "extraordinary",
    "inbetween",
    "aftermath",
    "incense",
    "plants",
    "printing",
    "books",
    "meat",
    "friction",
    "slippery",
    "narcotics",
    "overdue",
    "apologie",
    "admire",
    "inhabitant"
);

// Functie om een willekeurig woord te kiezen
function kiesWillekeurigWoord($woordenlijst)
{
    return $woordenlijst[array_rand($woordenlijst)];
}

// Start een nieuw spel
if (!isset($_SESSION['galgje'])) {
    $_SESSION['galgje'] = array(
        'woord' => '',
        'geradenLetters' => array(),
        'pogingenOver' => 7,
    );
}

// Verwerk ingediend woord
if (isset($_POST['startSpel'])) {
    if ($_POST['woordkeuze'] == 'eigen') {
        $_SESSION['galgje']['woord'] = strtolower($_POST['eigenWoord']);
    } else {
        $_SESSION['galgje']['woord'] = kiesWillekeurigWoord($woorden);
    }
}

// Functie om het galgje-woord te tonen met geraden letters
function toonGalgjeWoord($woord, $geradenLetters)
{
    $weergave = '';
    foreach (str_split($woord) as $letter) {
        if (in_array($letter, $geradenLetters)) {
            $weergave .= $letter . ' ';
        } else {
            $weergave .= '_ ';
        }
    }
    return $weergave;
}

// Verwerk ingediende letter
if (isset($_POST['letter']) && ctype_alpha($_POST['letter'])) {
    $geradenLetter = strtolower($_POST['letter']);
    if (!in_array($geradenLetter, $_SESSION['galgje']['geradenLetters'])) {
        $_SESSION['galgje']['geradenLetters'][] = $geradenLetter;
        if (!str_contains($_SESSION['galgje']['woord'], $geradenLetter)) {
            $_SESSION['galgje']['pogingenOver']--;
        }
    }
}

// Controleer of het spel voorbij is
$gameOver = ($_SESSION['galgje']['pogingenOver'] == 0) ||
    (count(array_intersect(str_split($_SESSION['galgje']['woord']), $_SESSION['galgje']['geradenLetters'])) == strlen($_SESSION['galgje']['woord']));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Galgje</title>
    <style>
        button {
            font-size: 20px;
            padding: 10px;
            margin: 5px;
        }

        .selected {
            font-size: 24px;
        }
        body{
            background-color: cadetblue;
        }
    </style>
</head>

<body>
    <h1>Galgje</h1>
    <?php if (empty($_SESSION['galgje']['woord'])) : ?>
        <form method="post">
            <p>Kies een woord:</p>
            <p>Let op: De  willekeurige woorden zijn in het engels!</p>
            <input type="radio" name="woordkeuze" value="eigen" checked> Eigen woord
            <input type="text" name="eigenWoord">
            <br>
            <input type="radio" name="woordkeuze" value="willekeurig"> Willekeurig woord
            <br><br>
            <button type="submit" name="startSpel">Start spel</button>
        </form>
    <?php else : ?>
        <p><?php echo toonGalgjeWoord($_SESSION['galgje']['woord'], $_SESSION['galgje']['geradenLetters']); ?></p>
        <p>Geselecteerde letters: <?php echo implode(', ', $_SESSION['galgje']['geradenLetters']); ?></p>
        <p>Pogingen over: <?php echo $_SESSION['galgje']['pogingenOver']; ?></p>
        <img src="galg<?php echo (7 - $_SESSION['galgje']['pogingenOver']); ?>.png" alt="Galgje" width="200">
        <form method="post">
            <?php foreach (range('a', 'z') as $letter) : ?>
                <button type="submit" name="letter" value="<?php echo $letter; ?>"
                <?php echo (in_array($letter, $_SESSION['galgje']['geradenLetters']) || $gameOver) ? 'disabled' : ''; ?>><?php echo $letter; ?></button>
            <?php endforeach; ?>
        </form>
        <?php if ($gameOver) : ?>
            <p>Het woord was: <?php echo $_SESSION['galgje']['woord']; ?></p>
            <form method="post">
                <button type="submit" name="nieuwSpel">Nieuw spel</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>

<?php
// Start een nieuw spel
if (isset($_POST['nieuwSpel'])) {
    unset($_SESSION['galgje']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>