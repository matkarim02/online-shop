<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Erros</title>
    <style>
        body {
            margin: auto;
            font-family: "Orbitron", sans-serif;
            background: linear-gradient(to top right, #000000 60%, #66ff66 100%);
            background-repeat: no-repeat;
            background-color: black;
        }

        .container {
            margin: auto;
            width: 90%;
            min-width: 320px;
            padding: 10px;
            color: #ffffff;
        }

        h1 {
            line-height: 0.5;
            font-size: 90px;
        }

        h2 {
            color: #66ff66;
            font-size: 30px;
        }

        p {
            line-height: 2;
            font-size: 20px;
        }

        .giphy-embed {
            opacity: 1;
            border-radius: 5px;
            border: 10px solid #ffffff;
            background-color: #000000;
        }

        .alien {
            position: fixed;
            z-index: -1;
            bottom: -10px;
            right: 0;
            opacity: 0.5;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container">
    <p>Oops, something has gone terribly wrong.</p>
    <iframe src="https://giphy.com/embed/qcngMWgXh4SiY" width="250px" height="185px" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
    <h1>500</h1>
    <h2>Internal Server Error</h2>
    <h2><?php echo $exception->getMessage()?></h2>
    <p>Don't fret. Our Ripley clone has been dispatched.</p>
</div>

<div class="alien">
    <img src="https://www.freepngimg.com/download/alien/35298-4-alien-transparent-picture.png" alt="Alien" width="70%" height="auto">
</div>
</body>
</html>
