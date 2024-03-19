

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
</head>
<style>
    
body {
    font-family: Arial, sans-serif;
}
.container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
}
.post {
    border: 1px solid #ccc;
    margin-bottom: 20px;
    padding: 10px;
}
.post h2 {
    margin-top: 0;
}
.post p {
    margin-bottom: 10px;
}
#message-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
}
#post-button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}
#post-button:hover {
    background-color: #0056b3;
}

</style>
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
