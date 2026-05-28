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
        <title>Lomake</title>
    </head>
    <body>
        <form action="./Tarkistus.php" method="post">
            <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            <h1>Hieno lomake</h1>
            <label for="nimi">Nimi</label>
            <br>
            <input type="text" id="nimi" name="nimi" required>
            <br>
            <br>
            <label for="sposti">Sähköposti</label>
            <br>
            <input type="email" id="sposti" name="sposti" required>
            <br>
            <br>
            <label for="pnro">Puhelin</label>
            <br>
            <input type="number" id="pnro" name="pnro" required>
            <br>
            <br>
            <button type="submit">Lähetä</button>
        </form>
    </body>
</html>