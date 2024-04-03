<?php


// Az aktuális oldal URL-je
$current_page_url = $_SERVER['PHP_SELF'];

// Az átirányítás az Ifijusagi.html oldalra
if ($current_page_url == "/kezdooldal.php") {
    header("Location: Ifijusagi.html");
    exit;
}

// Az átirányítás a Bejelentkezes.html oldalra
if ($current_page_url == "/Regisztracio.php") {
    header("Location: Bejelentkezes.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/kezdolap.css">
    <title>Az Elfelejtett Könyvtár</title>
</head>
<header>
</header>
<body>
    <header>
        <h1>Az Elfelejtett Könyvtár</h1>
        <nav class="col-sm-8 mx-auto">
            <a href="#Miért érdemes?">Miért érdemes?</a>
        </nav>
        <div id="back-to-home">
            <a href="Ifijusagi.html"><button>Főoldalra</button></a>
        </div>
    </header>

    <section>
        <div id="video-container">    
            <video id="video-background" autoplay loop muted>      
                <source src="videofajl.mp4.mp4" type="video/mp4">      
                A böngésződ nem támogatja a video elemet.    
            </video>

            <h2>Üdvözöljük az "Az Elfelejtett Könyvtár" világában!</h2>
            <p>
                Ön most beléphet egy varázslatos könyves vidékre, ahol a történetek életre kelnek és az oldalak tele vannak rejtélyekkel. Fedezze fel ezt a káprázatos világot és hagyja, hogy az elvarázsolt könyvtár megérintse az olvasás iránti szenvedélyét.
            </p>

            <h3>Miről szól a oldal?</h3>
            <p>
                Rövid összefoglaló a könyvről, kitérve a főszereplőkre, a cselekményre és a világra, amelyet a könyv bemutat.
            </p>

            <h3 id="Miért érdemes?">Miért érdemes böngészni?</h3>
            <p>
                Kiemelni a könyv egyediségét, izgalmas cselekményét, és azt, hogy milyen élményekre számíthat az olvasó.
            </p>

            <h3>Belepés / Regisztráció / Chat</h3>
            <a href="pHp/Bejelentkezes.php"><button>Belepés</button></a>
            <a href="pHp/Regisztracio.php"><button>Regisztráció</button></a>
            <a href="pHp/kisindex.php"><Button>Chat</Button></a>

            <h3>Csatlakozzon Hozzánk!</h3>
            <p>
                Ha regisztrál, írjon néhány sort az előnyökről, például egyedi tartalmakhoz való hozzáférés, ajánlások és közösségi események.  
            </p>
            <p>Amennyiben nem regisztrál nem láthatja a véleményeket és nem is szólhat hozzá.</p>

            <h3>Vegyen részt a Könyvtárban!</h3>
            <p>
                A könyves videó háttérben mozgóképet sugall, ami megteremti azt az érzést, mintha az olvasó valóban egy könyves környezetbe lépne.
            </p>
        </div>
    </section>
</body>
</html>
