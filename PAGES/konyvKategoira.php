<?php
if(!isset($_GET['kategoria'])){
    header('Location: index.php');
    exit();
}
$kategoira = htmlspecialchars($_GET['kategoria']);
$sql = "SELECT * FROM konyvKategoria WHERE nev='$kategoira'";
$qry = mysqli_query($conn, $sql);
$sorok = mysqli_num_rows($qry);
$rs = mysqli_fetch_assoc($qry);
$kategoriaId = $rs['id'];
if($sorok < 1){
    header('Location: index.php');
    exit();
}

if(isset($_POST['uzenetKuldes']) AND isset($_SESSION['id']) AND  $_SESSION['id'] > 0){
    $felhasznaloId = $_SESSION['id'];
    $uzenet = htmlentities($_POST['uzenet']);
    if($uzenet != ''){
        $sql = "INSERT INTO chat (felhasznalo_id, uzenet, kategoria_id) VALUES ('$felhasznaloId', '$uzenet', '$kategoriaId')";
        $qry = mysqli_query($conn, $sql);
    }else{
        $error = 'Kérjük adjon meg üzenetet!';
    }
}
?>
<link rel="stylesheet" href="STYLE/CSS/Konyv.css">
<link rel="stylesheet" href="STYLE/CSS/chat.css">
<style>
    .kep{
        width: 250px;
    }
    p, small{
        color: white;
    }
    .card{
        background: linear-gradient(135deg, #faea0f, #1001d8);
        border-radius: 20px;
    }
</style>
<header>
    <nav class="col-sm-8">
        <a class="btn btn-outline-secondary" href="index.php">Kezdőlap</a>
        <?php
        $sql = "SELECT * FROM konyvKategoria";
        $qry = mysqli_query($conn, $sql);
        while ($rs = mysqli_fetch_assoc($qry)){
        ?>
        <a class="btn btn-outline-secondary" href="index.php?oldal=konyvKategoria&kategoria=<?= $rs['nev'] ?>"><?= $rs['nev'] ?></a>
        <?php
        }
        ?>
    </nav>
</header>
<section>
    <h1><?= $kategoira ?></h1>
    <?php
    $sql = "SELECT * FROM konyvek WHERE kategoria_id='$kategoriaId'";
    $qry = mysqli_query($conn, $sql);
    while ($rs = mysqli_fetch_assoc($qry)){
        ?>
        <a href="index.php?oldal=konyv&konyv=<?= $rs['id'] ?>"><img class="kep" src="IMG/<?= $rs['konyv_kep'] ?>"></a>
        <?php
    }
    ?>
</section>
<section>
    <div class="container-fluid p-3" style="margin-left: 40px;">
        <div class="row mt-5 mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Beszélgessünk a kategóriáról!</h5>
                    </div>
                    <?php if(isset($_SESSION['id']) and  $_SESSION['id'] > 0){ ?>
                    <div class="card-body">
                        <div class="overflow-auto">
                            <!-- Chat üzenetek -->
                            <?php
                            $sql = "SELECT chat.*, felhasznalok.nev as fNev, felhasznalok.profilkep as fKep FROM chat JOIN felhasznalok ON chat.felhasznalo_id = felhasznalok.id WHERE chat.kategoria_id='$kategoriaId' ORDER BY chat.datum DESC";
                            $qry = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($qry) > 0){
                                while($rs = mysqli_fetch_assoc($qry)) { ?>
                                <div class="row">
                                    <div class="col-md-12 mt-2 mb-2">
                                        <div class="message-card">
                                            <div class="d-flex align-items-end">
                                                <img src="IMG/profilkep/<?= $rs['fKep'] ?>" class="profile-pic img-fluid rounded-circle mx-2" style="max-width: 40px; max-height: 40px;" alt="Profilkép">
                                                <div class="messagebox bg-primary">
                                                    <strong><?= $rs['fNev'] ?></strong>
                                                    <p class="text-left mb-0"><?= $rs['uzenet'] ?></p>
                                                    <small style="font-size: 11px;" class="text-light">Írta: <?= $rs['datum'] ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php  }
                                }else{ ?>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2">
                                        <div class="alert alert-info">
                                            <p style="text-align: center" class="text-dark mt-3"><i class="fa fa-info-circle"></i> Ebben a kategóriában még senki nem kezdett üzenetekbe!</p>
                                        </div>
                                    </div>
                                </div>
                           <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- New message form -->
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="uzenet">Üzenet:</label>
                                <textarea required class="form-control" id="uzenet" name="uzenet" rows="3"></textarea>
                            </div>
                            <button name="uzenetKuldes" type="submit" class="btn btn-primary">Küldés</button>
                        </form>
                    </div>
                    <?php }else{ ?>
                        <div class="row">
                            <div class="col-md-6 mt-2 mb-2 mx-2">
                                <div class="alert alert-info">
                                    <p style="text-align: center" class="text-dark mt-3"><i class="fa fa-info-circle"></i> Kérlek a beszélgetéshez jelentkezz be!</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="JS/Konyv.js"></script>