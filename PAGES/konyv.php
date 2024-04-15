<?php
if(isset($_POST['megjegyzesRogzites'])){
    if(!isset($_SESSION['id']) AND $_SESSION['id'] < 1){
        header('Location: index.php');
        exit();
    }

    $felhasznaloId = $_SESSION['id'];
    $uzenet = htmlentities($_POST['uzenet']);
    if($uzenet != ''){
        $sql = "INSERT INTO hozzaszolasok (felhasznalo_id, hozzaszolas, konyv_id) VALUES ('$felhasznaloId', '$uzenet', '$konyv')";
        $qry = mysqli_query($conn, $sql);
    }else{
        $error = 'Kérjük adjon meg üzenetet!';
    }
}

if(isset($_POST['dislikeKonyv'])){
    if(!isset($_SESSION['id']) AND $_SESSION['id'] < 1){
        header('Location: index.php');
        exit();
    }
    $felhasznaloId = $_SESSION['id'];
    mysqli_query($conn, "DELETE FROM kedvelesek WHERE konyv_id='$konyv' AND felhasznalo_id='$felhasznaloId'");
}

if(isset($_POST['likeKonyv'])){
    if(!isset($_SESSION['id']) AND $_SESSION['id'] < 1){
        header('Location: index.php');
        exit();
    }

    $felhasznaloId = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT * FROM kedvelesek WHERE konyv_id='$konyv' AND felhasznalo_id='$felhasznaloId'");
    if(mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO kedvelesek (felhasznalo_id, konyv_id) VALUES ('$felhasznaloId', '$konyv')";
        mysqli_query($conn, $sql);
    }
}

$sql = "SELECT hozzaszolasok.*, felhasznalok.nev as fNev, felhasznalok.profilkep as fKep FROM hozzaszolasok JOIN felhasznalok ON hozzaszolasok.felhasznalo_id = felhasznalok.id WHERE konyv_id='$konyv' ORDER BY hozzaszolasok.datum DESC";
$qry = mysqli_query($conn, $sql);
$sorok = mysqli_num_rows($qry);

$reakcioSql = "SELECT * FROM kedvelesek WHERE konyv_id='$konyv'";
$reackioQry = mysqli_query($conn, $reakcioSql);
$reakciok = mysqli_num_rows($reackioQry);

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0) {
    $felhasznaloId = $_SESSION['id'];
    $sajatReackioSql = "SELECT * FROM kedvelesek WHERE konyv_id='$konyv' AND felhasznalo_id='$felhasznaloId'";
    $sajatReackioQry = mysqli_query($conn, $sajatReackioSql);
    $sajatReakcio = mysqli_num_rows($sajatReackioQry);
}else{
    $sajatReakcio = 0;
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="STYLE/CSS/konyv.css">
<header>
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-8">
                <nav class="d-block">
                    <a class="btn btn-outline-secondary" href="index.php">Kezdőlap</a>
                    <a class="btn btn-outline-secondary" href="index.php?oldal=konyvKategoria&kategoria=Képergény">Vissza a kategóriákhoz</a>
                </nav>
            </div>
        </div>
    </div>
</header>
<?php if($konyvAdat['oldal_video'] != ''){ ?>
<section id="video-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <video width="100%" id="video-background" autoplay loop muted>
                    <source src="VIDEOS/<?= $konyvAdat['oldal_video'] ?>" type="video/mp4">
                    A böngésződ nem támogatja a video elemet.
                </video>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="book">
                <h2><?= $konyvAdat['konyv_cim'] ?></h2>
                <img class="kep" src="IMG/<?= $konyvAdat['konyv_kep'] ?>" alt="<?= $konyvAdat['konyv_cim'] ?>" title="<?= $konyvAdat['konyv_cim'] ?>">
                <p class="text-white"><strong>Író:</strong> <?= $konyvAdat['iro_nev'] ?> <strong>Kiadás:</strong> <?= $konyvAdat['konyv_kiadas'] ?></p>
                <p class="text-white"><?= $konyvAdat['konyv_leiras'] ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="book">
                <h2><?= $konyvAdat['iro_nev'] ?></h2>
                <img class="kep" src="IMG/<?= $konyvAdat['iro_kep'] ?>" alt="<?= $konyvAdat['iro_nev'] ?>" title="<?= $konyvAdat['iro_nev'] ?>">
                <p class="text-white"><strong>Foglalkozása:</strong> <?= $konyvAdat['iro_foglalkozas'] ?> <strong>Született:</strong> <?= $konyvAdat['iro_szuletett'] ?></p>
                <p class="text-white"><?= $konyvAdat['iro_leiras'] ?></p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="book mt-4 rounded">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-star"></i> Reakció
                    </div>
                    <?php if($sajatReakcio > 0){ ?>
                    <form action="" method="POST">
                        <button name="dislikeKonyv" style="max-width: 200px;" type="submit" class="btn btn-outline-danger mb-3 mx-2 mt-3">
                            <i class="fa fa-thumbs-down"></i> Mégse kedvelem
                            <span class="badge badge-danger badge-pill"><?= $reakciok ?></span>
                        </button>
                    </form>
                    <?php }else{ ?>
                            <form action="" method="POST">
                                <button <?= (isset($_SESSION['id'])) ? '': 'disabled title="Kérjük jelentkezzen be!"' ?> name="likeKonyv" style="max-width: 150px;" type="submit" class="btn btn-outline-primary mb-3 mx-2 mt-3">
                                    <i class="fa fa-thumbs-up"></i> Kedvelés
                                    <span class="badge badge-primary badge-pill"><?= $reakciok ?></span>
                                </button>
                                <?= (isset($_SESSION['id'])) ? '' : '<hr><small class="mx-2"><i class="fa fa-info-circle"></i> Kérjük jelentkezzen be, amennyiben szeretné kedvencek közé tenni.</small>' ?>
                            </form>
                    <?php } ?>

                </div>
            </div>
        </div>
        <hr>
        <div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-comment"></i> Megjegyzések (<?= $sorok ?>)
                        </div>
                        <div class="col-md-12" style="max-height: 350px; overflow: auto;">
                            <ul class="list-group list-group-flush">
                                <?php
                                if($sorok > 0){
                                    while($rs = mysqli_fetch_assoc($qry)) { ?>
                                <li class="list-group-item mt-2 mb-2">
                                    <div class="d-flex align-items-start">
                                        <img src="IMG/profilkep/<?= $rs['fKep'] ?>" class="profile-pic img-fluid rounded-circle mx-2" style="max-width: 40px; max-height: 40px;" alt="Profilkép">
                                        <div class="messagebox">
                                            <strong><?= $rs['fNev'] ?></strong> <small class="text-dark">(<?= $rs['datum'] ?>)</small>
                                            <p class="text-left mb-0"><?= $rs['hozzaszolas'] ?></p>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                    }
                                }else{ ?>
                                <li class="list-group-item mt-2 mb-2">
                                    <div class="alert alert-info mb-0">
                                        <p class="mb-0 text-center"><i class="fa fa-info-circle"></i> Ehhez a könyvhöz egyetlen hozzászólás sincs még.</p>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <form method="POST" action="">
                                <div class="col-md-12">
                                    <label>Megjegyzés írás:</label>
                                    <textarea <?= (isset($_SESSION['id'])) ?: 'disabled'; ?> name="uzenet" minlength="3" required rows="3" class="w-100 form-control"></textarea>
                                </div>
                                <div class="col-md-12 mt-2 <?= (isset($_SESSION['id'])) ?: 'd-none'; ?>">
                                    <button type="submit" name="megjegyzesRogzites" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Megjegyzés írása</button>
                                </div>
                                <div class="col-md-12 mt-2 <?= (isset($_SESSION['id'])) ? 'd-none' : ''; ?>">
                                    <div class="alert alert-warning mb-0">
                                        <p class="mb-0 text-center"><i class="fa fa-info-circle"></i> Amennyiben megjegyzést szeretne írni előbb  <a href="index.php?oldal=bejelentkezes">jelentkezzen be</a>!</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>