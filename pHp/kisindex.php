<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-dUOaSRV3Uv5T+6Lbz4gPO9vL1zcs32ZKDEt/JIpGVBL2rsVlIiFe8PkYY7uL7+1u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Forum.css">
    <title>Közösség</title>
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
        <br>
        <hr>
    </form>

    <?php
    // Adatbázis kapcsolódás
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "elfelejtett";

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
            echo "<p><strong>Felhasználónév:</strong> " . $row["felhasznalonev"];
            echo " <a href='szerkeszt.php?id=" . $row["id"] . "'><i class='fas fa-edit'></i></a>";
            echo " <a href='torol.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt'></i></a></p>";
            echo "<p>" . $row["hozzaszolas"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "Nincsenek hozzászólások.";
    }
    $conn->close();
    ?>
    
    <script src="Kozosseg.js"></script>
</body>
</html>
