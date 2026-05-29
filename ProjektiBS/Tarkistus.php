<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lomake</title>
    </head>
    <body>
    </body>
    <?php
    function tarkistasyote($nimi, $sposti) {
        $nimi = htmlspecialchars(trim($nimi));
        $sposti = htmlspecialchars(trim($sposti));
        if (strlen($nimi) > 100) return "Nimi on liian pitkä!";
        if (!preg_match("/^[a-zA-ZäöåÄÖÅ\s-]+$/u", $nimi)) return "Virheellinen nimi!";
        if (!filter_var($sposti, FILTER_VALIDATE_EMAIL)) return "Virheellinen sähköposti!";
        if (strlen($sposti) > 255) return "Sähköposti on liian pitkä!";
        $domain = explode("@", $sposti)[1] ?? "";
        if (!checkdnsrr($domain, "MX")) return "Sähköpostin domain ei ole toimiva!";
        return [
            "nimi" => $nimi,
            "sposti" => $sposti
        ];
    }
    if (!isset($_POST["csrf_token"], $_SESSION["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
        die("CSRF-tunniste ei kelpaa!");
    }
    $tulos = tarkistasyote($_POST["nimi"], $_POST["sposti"]);
    if (is_array($tulos)) {
        $rivi = date("Y-m-d H:i:s") . " | Yritys : {$_POST["ynimi"]} | Nimi : {$tulos["nimi"]} | Sähköposti : {$tulos["sposti"]} | P. : {$_POST["pnro"]} " . PHP_EOL;
        $tiedosto = "tiedot.txt";
        if (file_put_contents($tiedosto, $rivi, FILE_APPEND | LOCK_EX)) {
            echo "Tiedot tallennettu tiedostoon!";
        } else {
            echo "Tiedoston kirjoittaminen epäonnistui!";
        }
    } else {
        echo "Virhe : $tulos";
    }
    ?>
</html>