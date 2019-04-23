<!doctype>
<html>
<head>
    <meta charset="utf-8">
    <title>Guess my number</title>

    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="middle won">
        <h1>Guess my number</h1>
        <h2 class="win"> <?= $game->makeGuess($guess) ?> </h2>
        <h2> You Win!</h2>
    </div>
</body>
</html>
