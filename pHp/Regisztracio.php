<?php
// Adatbázis kapcsolódás
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elfelejtett";

// Űrlap adatok ellenőrzése és mentése az adatbázisba
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizze a felhasználó által megadott adatokat
    $nev = $_POST["nev"];
    $email = $_POST["email"];
    $felhasznalonev = $_POST["felhasznalonev"];
    $jelszo = password_hash($_POST["jelszo"], PASSWORD_DEFAULT); // Titkosított jelszó

    // Adatbázis kapcsolat létrehozása és ellenőrzése
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Sikertelen kapcsolódás: " . $conn->connect_error);
    }

    // SQL lekérdezés az adatok beszúrására az adatbázisba
    $sql = "INSERT INTO felhasznalok (nev, email, felhasznalonev, jelszo)
            VALUES ('$nev', '$email', '$felhasznalonev', '$jelszo')";

    if ($conn->query($sql) === TRUE) {
        header("Location: /index.php");
        exit;
    } else {
        echo "Hiba történt a regisztráció során: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" type="text/css" href="css/Regisztracio.css">
</head>
<body>
    <div class="container">
        <h1>Regisztráció</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nev">Név:</label>
            <input type="text" id="nev" name="nev" placeholder="Név" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <label for="felhasznalonev">Felhasználónév:</label>
            <input type="text" id="felhasznalonev" name="felhasznalonev"placeholder="Felhasználónév" required>

            <label for="jelszo">Jelszó:</label>
            <input type="password" id="jelszo" name="jelszo" placeholder="Jelszó" required>

            <input type="submit" value="Regisztráció">
        </form>
    </div>
</body>
</html>
