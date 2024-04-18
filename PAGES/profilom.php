<?php
if (!isset($_SESSION['id']) and $_SESSION['id'] < 1) {
    header('Location: index.php');
    exit();
}
$felhasznaloId = $_SESSION['id'];

if (isset($_GET['torles'])) {
    $sql = "DELETE FROM felhasznalok WHERE id = '$felhasznaloId'";
    $qry = mysqli_query($conn, $sql);
    header('Location: index.php?oldal=kijelentkezes');
    exit();
}

if (isset($_POST['adatokModositasa'])) {
    $sikeresKitoltes = true;
    $hibaUzenet = '';
    $sikerUzenet = '';
    $felhasznalonev = (isset($_POST['fNevSzerkesztes'])) ? htmlspecialchars($_POST['fNevSzerkesztes']) : '';
    $nev = (isset($_POST['nevSzerkesztes'])) ? htmlspecialchars($_POST['nevSzerkesztes']) : '';
    $email = (isset($_POST['emailSzerkesztes'])) ? htmlspecialchars($_POST['emailSzerkesztes']) : '';
    $jelszo = (isset($_POST['jelszoSzerkesztes'])) ? htmlspecialchars($_POST['jelszoSzerkesztes']) : '';
    $jelszoUjra = isset($_POST['jelszoUjraSzerkesztes']) ? htmlspecialchars($_POST['jelszoUjraSzerkesztes']) : '';
    $uj_fajlnev = '';

    if (strlen($nev) <= 5) {
        $hibaUzenet .= '<li>Figyelem! A Név mező kitöltése kötelező (mimimum 5 karakter)</li>';
        $sikeresKitoltes = false;
    }

    if (strlen($felhasznalonev) <= 5) {
        $hibaUzenet .= '<li>Figyelem! A felhasználónév mező kitöltése kötelező (mimimum 5 karakter)</li>';
        $sikeresKitoltes = false;
    }

    if (strlen($email) <= 7) {
        $hibaUzenet .= '<li>Figyelem! A email mező kitöltése kötelező (mimimum 7 karakter)</li>';
        $sikeresKitoltes = false;
    }
    if ($jelszo != '') {
        if (strlen($jelszo) <= 7) {
            $hibaUzenet .= '<li>Figyelem! A jelszó mező kitöltése kötelező (mimimum 7 karakter)</li>';
            $sikeresKitoltes = false;
        }
        if ($jelszo != $jelszoUjra) {
            $hibaUzenet .= '<li>Figyelem! A két jelszó nem egyezik!</li>';
            $sikeresKitoltes = false;
        }
    }


    if (isset($_FILES['fProfilkepSzerkesztes']) AND $_FILES['fProfilkepSzerkesztes']['name'] != '') {
        $fajlnev = $_FILES['fProfilkepSzerkesztes']['name'];
        $tempnev = $_FILES['fProfilkepSzerkesztes']['tmp_name'];

        $fajl_tipus = mime_content_type($tempnev);
        $engedelyezett_tipusok = array("image/jpeg", "image/png", "image/svg");
        if (!in_array($fajl_tipus, $engedelyezett_tipusok)) {
            $hibaUzenet .= "<li>Csak JPEG, PNG vagy SVG fájlok tölthetők fel!</li>";
            $sikeresKitoltes = false;
        }

        $uj_fajlnev = uniqid() . '_' . $fajlnev;
        $celut = './IMG/' . $uj_fajlnev;

        move_uploaded_file($tempnev, $celut);
    }

    $sql = "SELECT * FROM felhasznalok WHERE email='$email' AND id!='$felhasznaloId'";
    $qry = mysqli_query($conn, $sql);
    $sorok = mysqli_fetch_assoc($qry);
    if ($sorok > 0) {
        $hibaUzenet .= '<li>Figyelem! Ezen az email címen már regisztráltak!</li>';
        $sikeresKitoltes = false;
    }

    $sql = "SELECT * FROM felhasznalok WHERE felhasznalonev='$felhasznalonev' AND id!='$felhasznaloId'";
    $qry = mysqli_query($conn, $sql);
    $sorok = mysqli_fetch_assoc($qry);
    if ($sorok > 0) {
        $hibaUzenet .= '<li>Figyelem! A felhasználónév már foglalt!</li>';
        $sikeresKitoltes = false;
    }

    if ($sikeresKitoltes == true) {
        if ($jelszo == '') {
            $jelszo = md5($jelszo);
            $sql = "UPDATE felhasznalok SET email = '$email', felhasznalonev = '$felhasznalonev', nev = '$nev' WHERE id = '$felhasznaloId'";
        } else {
            $sql = "UPDATE felhasznalok SET email = '$email', felhasznalonev = '$felhasznalonev', jelszo = '$jelszo', nev = '$nev' WHERE id = '$felhasznaloId'";
        }
        $qry = mysqli_query($conn, $sql);

        if ($uj_fajlnev != '') {
            $sql = "UPDATE felhasznalok SET profilkep = '$uj_fajlnev' WHERE id = '$felhasznaloId'";
            $qry = mysqli_query($conn, $sql);
        }

        $sikerUzenet = 'Sikeres adatmódosítás!';
        $_SESSION['nev'] = $nev;
        $_SESSION['email'] = $email;
        $_SESSION['felhasznalonev'] = $felhasznalonev;
    }
}

$sql = "SELECT * FROM felhasznalok WHERE id='$felhasznaloId'";
$qry = mysqli_query($conn, $sql);
$felhasznaloAdat = mysqli_fetch_assoc($qry);

?>
<link rel="stylesheet" href="STYLE/CSS/profilom.css">
<section class="p-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="IMG/profilkep/<?= $felhasznaloAdat['profilkep'] ?>"
                         class="card-img-top profile-image mx-auto mt-3" alt="Profilkép">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $_SESSION['nev'] ?></h5>
                        <p><a href="index.php?oldal=kijelentkezes">Kijelentkezés</a></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#myInfo" class="nav-link" data-toggle="tab">Adataim</a>
                        </li>
                        <li class="list-group-item"><a href="#myComments" class="nav-link" data-toggle="tab">Megjegyzéseim</a>
                        </li>
                        <li class="list-group-item"><a href="#myFavoriteBooks" class="nav-link" data-toggle="tab">Kedvenc
                                könyveim</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content">
                    <div id="myInfo" class="tab-pane fade show active">
                        <?php if (isset($hibaUzenet) and $hibaUzenet != '') { ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Sikeretlen regisztráció!</h4>
                                <ul>
                                    <?= $hibaUzenet ?>
                                </ul>
                                <hr>
                                <p class="mb-0">Kérjük javítsa a kért paramétereket és próbálja meg újra.</p>
                            </div>
                        <?php } ?>
                        <?php if (isset($sikerUzenet) and $sikerUzenet != '') { ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Sikeres regisztráció!</h4>
                                <?= $sikerUzenet ?>
                            </div>
                        <?php } ?>
                        <form enctype="multipart/form-data"
                              action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>?oldal=profilom" method="POST">
                            <div class="row">
                                <div class="col-8">
                                    <h3>Adataim</h3>
                                </div>
                                <div class="col-4">
                                    <h3 class="text-right">
                                        <button type="submit" name="adatokModositasa" class="btn btn-sm btn-primary"><i
                                                    class="fa fa-save"></i> Adatok mentése
                                        </button>
                                    </h3>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="nevSzerkesztes" class="col-sm-8 col-form-label">Név:</label>
                                <div class="col-sm-4 mt-1">
                                    <input required class="form-control form-control-sm" type="text" id="nevSzerkesztes"
                                           name="nevSzerkesztes" value="<?= $felhasznaloAdat['nev'] ?>" minlength="5">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="emailSzerkesztes" class="col-sm-8 col-form-label">Email:</label>
                                <div class="col-sm-4 mt-1">
                                    <input required class="form-control form-control-sm" type="email"
                                           id="emailSzerkesztes" name="emailSzerkesztes"
                                           value="<?= $felhasznaloAdat['email'] ?>" minlength="8">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fNevSzerkesztes" class="col-sm-8 col-form-label">Felhasználónév:</label>
                                <div class="col-sm-4 mt-1">
                                    <input required class="form-control form-control-sm" type="text"
                                           id="fNevSzerkesztes" name="fNevSzerkesztes"
                                           value="<?= $felhasznaloAdat['felhasznalonev'] ?>" minlength="5">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jelszoSzerkesztes" class="col-sm-4 col-form-label">Jelszó:</label>
                                <div class="col-sm-4 mt-1">
                                    <input placeholder="Jelszó módosításhoz töltse ki"
                                           class="form-control form-control-sm" type="password" id="jelszoSzerkesztes"
                                           name="jelszoSzerkesztes" value="" minlength="8">
                                </div>
                                <div class="col-sm-4 mt-1">
                                    <input placeholder="Jelszó újra" class="form-control form-control-sm"
                                           type="password" id="jelszoUjraSzerkesztes" name="jelszoUjraSzerkesztes"
                                           value="" minlength="8">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fProfilkepSzerkesztes" class="col-sm-8 col-form-label">Profilkép
                                    csere:</label>
                                <div class="col-sm-4">
                                    <input class="form-control form-control-sm" type="file"
                                           accept="image/jpeg,image/png,image/svg" id="fProfilkepSzerkesztes"
                                           name="fProfilkepSzerkesztes">
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-6">
                                <p class="text-left">Regisztráció dátuma:</p>
                                <p class="text-left">Felhasználó azonosító:</p>
                            </div>
                            <div class="col-6">
                                <p class="text-right"><?= $felhasznaloAdat['regisztracioDatum'] ?></p>
                                <p class="text-right">#konyv-<?= $felhasznaloAdat['id'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <p class="text-left">Szeretné fiókját megszüntetni? <a
                                            href="index.php?oldal=profilom&torles=true"
                                            class="btn btn-sm btn-danger mx-2"><i class="fa fa-trash"></i> Fiók törlése</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="myComments" class="tab-pane fade">
                        <h3>Megjegyzéseim</h3>
                        <hr>
                        <?php
                        $sql = "
                            SELECT hozzaszolasok.*, felhasznalok.nev as fNev, felhasznalok.profilkep as fKep, konyvek.konyv_cim 
                            FROM hozzaszolasok 
                            JOIN felhasznalok ON hozzaszolasok.felhasznalo_id = felhasznalok.id 
                            JOIN konyvek ON hozzaszolasok.konyv_id = konyvek.id
                            WHERE felhasznalo_id='$felhasznaloId' 
                            ORDER BY hozzaszolasok.datum DESC";
                        $qry = mysqli_query($conn, $sql);
                        $sorok = mysqli_num_rows($qry);
                        if ($sorok > 0) {
                            while ($rs = mysqli_fetch_assoc($qry)) { ?>
                                <li class="list-group-item mt-2 mb-2">
                                    <div class="d-flex align-items-start">
                                        <img src="IMG/profilkep/<?= $rs['fKep'] ?>"
                                             class="profile-pic img-fluid rounded-circle mx-2"
                                             style="max-width: 43px; max-height: 43px;" alt="Profilkép">
                                        <div class="messagebox">
                                            <strong><?= $rs['fNev'] ?></strong>
                                            <br><small><a
                                                        href="index.php?oldal=konyv&konyv=<?= $rs['konyv_id'] ?>"><?= $rs['konyv_cim'] ?></a></small>
                                            <b>-</b> <small class="text-dark"><?= $rs['datum'] ?></small>
                                            <p class="text-left mb-0"><?= $rs['hozzaszolas'] ?></p>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                        } else { ?>
                            <li class="list-group-item mt-2 mb-2">
                                <p>Ebben a fülben jelennek meg az Ön által írt megjegyzéseket, amennyiben közzétesz.</p>
                            </li>
                            <?php
                        }
                        ?>

                    </div>
                    <div id="myFavoriteBooks" class="tab-pane fade">
                        <h3>Kedvenc könyveim</h3>
                        <hr>
                        <?php
                        $sql = "
                            SELECT kedvelesek.*, konyvek.konyv_cim 
                            FROM kedvelesek 
                            JOIN konyvek ON kedvelesek.konyv_id = konyvek.id
                            WHERE felhasznalo_id='$felhasznaloId'";
                        $qry = mysqli_query($conn, $sql);
                        $sorok = mysqli_num_rows($qry);
                        if ($sorok > 0) {
                            while ($rs = mysqli_fetch_assoc($qry)) { ?>
                                <li class="list-group-item mt-2 mb-2">
                                    <div class="d-flex align-items-start">
                                        <i style="font-size: 42px;" class="fa fa-heart text-danger mx-2"></i>
                                        <div class="messagebox">
                                            <strong class="text-secondary">Kedvelt könyv: </strong>
                                            <p class="text-left mb-0"><a
                                                        href="index.php?oldal=konyv&konyv=<?= $rs['konyv_id'] ?>"><?= $rs['konyv_cim'] ?></a>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                        } else { ?>
                            <li class="list-group-item mt-2 mb-2">
                                <p>Ebben a fülben jelennek meg a kedvenc könyvei amennyiben kedvel valamit.</p>
                            </li>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>