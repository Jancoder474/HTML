<?php
session_start();
$csrf_token = bin2hex(random_bytes(32));
$_SESSION["csrf_token"] = $csrf_token;
?>
<!DOCTYPE html>
<html lang="fi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="kotisivut.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Ota yhteyttä</title>
    </head>
    <body>
        <header class="nav-bar">
            <img src="Omakuva.jpg" alt="Kuva minusta.">
            <nav class="navcontent"> 
                <div class="navitem"><a href="./etusivu.html" class="navlink">Etusivu</a></div>
                <div class="navitem"><a href="./tietoa.html" class="navlink">Tietoa minusta</a></div>
                <div class="navitem"><a href="./yhteystiedot.php" class="navactive">Ota yhteyttä</a></div>
            </nav>
        </header>
        <div class="yhteysgrid">
            <div class="yhteyshead">
                <h1>Yhteydenotot</h1>
            </div>
            <div class="yhteysitem">
                <h2>Janne Tick</h2>
                <h3>Sähköposti</h3>
                <p><a class="sposti" href="mailto:jannek.tick@gmail.com">jannek.tick@gmail.com</a></p>
                <h3>Puhelin</h3>
                <p>045-866-66-96</p>
                <h3>Sijainti</h3>
                <p>Suonenjoki, Suomi</p>
            </div>
            <form class="yhteysitem" action="./tarkistus.php" method="post">
                <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
                <h2>Jätä yhteydenottopyyntö</h2>
                <label for="ynimi">Yritys</label><br>
                <input type="text" id="ynimi" name="ynimi" placeholder="Yritys"><br>
                <br>
                <label for="nimi">Nimi</label><br>
                <input type="text" id="nimi" name="nimi" placeholder="Nimi" required><br>
                <br>
                <label for="sposti">Sähköposti</label><br>
                <input type="email" id="sposti" name="sposti" placeholder="Sähköposti" required><br>
                <br>
                <label for="pnro">Puhelin</label><br>
                <input type="tel" id="pnro" name="pnro" placeholder="Puhelin" required><br>
                <br>
                <button class="yformbtn" type="submit">Lähetä</button>
            </form>
        </div>
        <footer class="footer">
            <p>&copy; Janne Tick</p>
        </footer>
    </body>
</html>