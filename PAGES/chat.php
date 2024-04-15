<?php
if(!isset($_SESSION['id']) AND $_SESSION['id'] < 1){
    header('Location: index.php');
    exit();
}
$felhasznaloId = $_SESSION['id'];
if(isset($_POST['uzenetKuldes'])){
    $uzenet = htmlentities($_POST['uzenet']);
    if($uzenet != ''){
        $sql = "INSERT INTO chat (felhasznalo_id, uzenet) VALUES ('$felhasznaloId', '$uzenet')";
        $qry = mysqli_query($conn, $sql);
    }else{
        $error = 'Kérjük adjon meg üzenetet!';
    }
}
?>
<link rel="stylesheet" href="STYLE/CSS/chat.css">
<section>
    <div class="container-fluid p-0">
        <div class="jumbotron text-center banner">
            <h1 class="display-4">Beszélgetés - Chat</h1>
            <p class="lead">Az Elfelejtett Könyvtár</p>
        </div>
    </div>
    <div class="container p-3">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Beszélgető</h5>
                    </div>
                    <div class="card-body">
                        <div class="overflow-auto">
                            <!-- Chat üzenetek -->
                            <?php
                            $sql = "SELECT chat.*, felhasznalok.nev as fNev, felhasznalok.profilkep as fKep FROM chat JOIN felhasznalok ON chat.felhasznalo_id = felhasznalok.id ORDER BY chat.datum DESC";
                            $qry = mysqli_query($conn, $sql);
                            while($rs = mysqli_fetch_assoc($qry)) { ?>
                                <div class="row">
                                    <div class="col-md-12 mt-2 mb-2">
                                        <div class="message-card">
                                            <div class="d-flex align-items-end">
                                                <img src="IMG/profilkep/<?= $rs['fKep'] ?>" class="profile-pic img-fluid rounded-circle mx-2" style="max-width: 40px; max-height: 40px;" alt="Profilkép">
                                                <div class="messagebox bg-primary">
                                                    <strong><?= $rs['fNev'] ?></strong>
                                                    <p class="text-left mb-0"><?= $rs['uzenet'] ?></p>
                                                    <small style="font-size: 11px;" class="text-dark">Írta: <?= $rs['datum'] ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- New message form -->
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>?oldal=chat" method="POST">
                            <div class="form-group">
                                <label for="uzenet">Üzenet:</label>
                                <textarea required class="form-control" id="uzenet" name="uzenet" rows="3"></textarea>
                            </div>
                            <button name="uzenetKuldes" type="submit" class="btn btn-primary">Küldés</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>