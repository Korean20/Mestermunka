

    <?php
    // Adatbázis kapcsolódás
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forum";

    // Adatbázis kapcsolódás létrehozása
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Adatbázis kapcsolódás ellenőrzése
    if ($conn->connect_error) {
        die("Sikertelen kapcsolódás: " . $conn->connect_error);
    }

    // Hozzászólások lekérdezése és megjelenítése
    $sql = "SELECT id, felhasznalonev, hozzaszolas FROM hozzaszolasok";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Hozzászólások megjelenítése
        while($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<p><strong>Felhasználónév:</strong> " . $row["felhasznalonev"] . "</p>";
            echo "<p>" . $row["hozzaszolas"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "Nincsenek hozzászólások.";
    }
    $conn->close();
    ?>
    <!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Közösség</title>
    <link rel="stylesheet" type="text/css" href="Forum.css">
</head>
<body>
    <h1>Elfelejtett Chat</h1>
    <p>Tegyen nekünk ajánlást, írja le véleményét és beszélgessen másokkal!</p>
    <p>Minden véleményt szívesen fogadunk normálisan megfogalmazva!</p>

    <form action="V.php" method="post">
        <label for="felhasznalonev">Felhasználónév:</label><br>
        <input type="text" id="felhasznalonev" name="felhasznalonev" required><br>
        <label for="hozzaszolas">Hozzászólás:</label><br>
        <textarea id="hozzaszolas" name="hozzaszolas" required></textarea><br><br>
        <input type="submit" value="Küldés">
    </form>

    <script src="Kozosseg.js"></script>
</body>
</html>
