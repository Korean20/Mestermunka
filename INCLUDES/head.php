<?php
include_once 'dbConnection.php';
// Az aktuális oldal URL-je
$current_page_url = $_SERVER['PHP_SELF'];

if(isset($_GET['oldal'])){
    $oldal = htmlentities($_GET['oldal']);
}else{
    $oldal = 'kezdolap';
}

if($oldal == 'konyv'){
    $konyv = isset($_GET['konyv']) ? (int)$_GET['konyv'] : 0;
    if($konyv == 0){
        header('Location: index.php');
        exit();
    }
    $sql = "SELECT * FROM konyvek WHERE id='$konyv'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        $konyvAdat = mysqli_fetch_assoc($query);
    }else{
        header('Location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($oldal != 'konyvKategoria' AND $oldal != 'konyv'){ ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="STYLE/CSS/kezdolap.css">
    <?php }else{ ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <?php } ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <?php
    switch ($oldal){
        case 'bejelentkezes':
            echo '<title>Bejelentkezés - Az Elfelejtett Könyvtár</title>';
            break;
        case 'regisztracio':
            echo '<title>Regisztráció - Az Elfelejtett Könyvtár</title>';
            break;
        case 'kezdolap':
            echo '<title>Kezdőlap - Az Elfelejtett Könyvtár</title>';
            break;
        case 'chat':
            echo '<title>Chat - Az Elfelejtett Könyvtár</title>';
            break;
        case 'profilom':
            echo '<title>Profilom - Az Elfelejtett Könyvtár</title>';
            break;
        case 'konyvKategoria':
            $kategoria = (isset($_GET['kategoria'])) ? $_GET['kategoria'] : 'Ismeretlen';
            echo '<title>'.$kategoria.' - Az Elfelejtett Könyvtár</title>';
            break;
        case 'kijelentkezes':
            echo '<title>Kijelentkezás - Az Elfelejtett Könyvtár</title>';
            break;
        case 'konyv':
            echo '<title>'.$konyvAdat['oldal_title'].'</title>';
            break;
        default:
            echo '<title>Az Elfelejtett Könyvtár</title>';
            break;
    }
    ?>
</head>
<header>
</header>
<body>
<?php if($oldal != 'konyvKategoria' AND $oldal != 'konyv'){ ?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Az Elfelejtett Könyvtár</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item <?= ($oldal == 'kezdolap') ? 'active' : '' ?>">
                    <a class="nav-link btn btn-outline-secondary" href="index.php"><i class="fas fa-home"></i> Kezdőlap <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-secondary" href="#miert_erdemes"><i class="fas fa-question"></i> Miért érdemes?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-secondary" href="index.php?oldal=konyvKategoria&kategoria=Képergény"><i class="fas fa-book"></i> Könyvtár</a>
                </li>
            </ul>
            <ul class="navbar-nav right-side">
                <?php if(isset($_SESSION['id']) AND $_SESSION['id'] > 0){ ?>
                    <li class="nav-item <?= ($oldal == 'chat') ? 'active' : '' ?>">
                        <a class="nav-link btn btn-outline-secondary" href="index.php?oldal=chat"><i class="fa fa-comment"></i> Chat</a>
                    </li>
                    <li class="nav-item <?= ($oldal == 'profilom') ? 'active' : '' ?>">
                        <a class="nav-link btn btn-outline-secondary" href="index.php?oldal=profilom"><i class="fas fa-user"></i> <?=$_SESSION['nev'] ?></a>
                    </li>
                <?php }else{ ?>
                    <li class="nav-item <?= ($oldal == 'bejelentkezes') ? 'active' : '' ?>">
                        <a class="nav-link btn btn-outline-secondary" href="index.php?oldal=bejelentkezes"><i class="fas fa-sign-in-alt"></i> Bejelentkezés</a>
                    </li>
                    <li class="nav-item <?= ($oldal == 'regisztracio') ? 'active' : '' ?>">
                        <a class="nav-link btn btn-outline-secondary" href="index.php?oldal=regisztracio"><i class="fas fa-user-plus"></i> Regisztráció</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>
<?php } ?>
