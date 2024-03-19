<?php
// Ellenőrizze, hogy az űrlap elküldte-e az adatokat POST kérésben
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizze, hogy minden szükséges adat megvan-e
    if (isset($_POST["felhasznalonev"]) && isset($_POST["hozzaszolas"])) {
        // Adatok tisztítása és biztonságossá tétele
        $felhasznalonev = htmlspecialchars($_POST["felhasznalonev"]);
        $hozzaszolas = htmlspecialchars($_POST["hozzaszolas"]);


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "forum";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Sikertelen kapcsolódás: " . $conn->connect_error);
        }

        // Hozzászólás beszúrása az adatbázisba
        $sql = "INSERT INTO hozzaszolasok (felhasznalonev, hozzaszolas) VALUES ('$felhasznalonev', '$hozzaszolas')";
        if ($conn->query($sql) === TRUE) {
            echo "A hozzászólás sikeresen elküldve.";
        } else {
            echo "Hiba történt a hozzászólás elküldése közben: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Hiányzó adatok a hozzászólás elküldéséhez.";
    }
} else {
   
}
?>
