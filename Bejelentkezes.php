<?php
// Ellenőrizzük, hogy a form elküldése megtörtént-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Az űrlapból érkező adatok feldolgozása
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    // Itt lehet folytatni a bejelentkezési logika implementálását
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Regisztracio.css">
</head>
<body>
    <div class="container">
        <h1>Bejelentkezés</h1>
        <form id="registrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Felhasználónév vagy email:</label>
            <input type="text" id="name" name="name" placeholder="Név" required>

            <label for="password">Jelszó:</label>
            <input type="password" id="password" name="password"  placeholder="Jelszó">

            <button type="submit">Bejelentkezés</button>
        </form>
    </div>
    <a href="Regisztracio.php"><button type="submit" class="szin">Regisztráció</button></a>
</body>
</html>
