<?php
if(isset($_SESSION['id']) AND $_SESSION['id'] > 0){
    header('Location: index.php');
    exit();
}
if(isset($_POST['regisztracioKuldes'])){
    $sikeresKitoltes = true;
    $hibaUzenet = '';
    $sikerUzenet = '';
    $felhasznalonev = (isset($_POST['felhasznaloNev'])) ? htmlspecialchars($_POST['felhasznaloNev']) : '';
    $nev = (isset($_POST['nev'])) ? htmlspecialchars($_POST['nev']) : '';
    $email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
    $jelszo = (isset($_POST['jelszo'])) ? htmlspecialchars($_POST['jelszo']) : '';
    $jelszoUjra = isset($_POST['jelszoUjra']) ? htmlspecialchars($_POST['jelszoUjra']) : '';

    if(strlen($nev) <= 5){
        $hibaUzenet .= '<li>Figyelem! A Név mező kitöltése kötelező (mimimum 5 karakter)</li>';
        $sikeresKitoltes = false;
    }

    if(strlen($felhasznalonev) <= 5){
        $hibaUzenet .= '<li>Figyelem! A felhasználónév mező kitöltése kötelező (mimimum 5 karakter)</li>';
        $sikeresKitoltes = false;
    }

    if(strlen($email) <= 7){
        $hibaUzenet .= '<li>Figyelem! A email mező kitöltése kötelező (mimimum 7 karakter)</li>';
        $sikeresKitoltes = false;
    }

    if(strlen($jelszo) <= 7){
        $hibaUzenet .= '<li>Figyelem! A jelszó mező kitöltése kötelező (mimimum 7 karakter)</li>';
        $sikeresKitoltes = false;
    }

    if($jelszo != $jelszoUjra){
        $hibaUzenet .= '<li>Figyelem! A két jelszó nem egyezik!</li>';
        $sikeresKitoltes = false;
    }

    $sql = "SELECT * FROM felhasznalok WHERE email='$email'";
    $qry = mysqli_query($conn, $sql);
    $sorok = mysqli_fetch_assoc($qry);
    if($sorok > 0){
        $hibaUzenet .= '<li>Figyelem! Ezen az email címen már regisztráltak!</li>';
        $sikeresKitoltes = false;
    }

    $sql = "SELECT * FROM felhasznalok WHERE felhasznalonev='$felhasznalonev'";
    $qry = mysqli_query($conn, $sql);
    $sorok = mysqli_fetch_assoc($qry);
    if($sorok > 0){
        $hibaUzenet .= '<li>Figyelem! A felhasználónév már foglalt!</li>';
        $sikeresKitoltes = false;
    }

    if($sikeresKitoltes == true){
        $jelszo = md5($jelszo);
        $sql = "INSERT INTO felhasznalok (nev, email, felhasznalonev, jelszo) VALUES ('$nev', '$email', '$felhasznalonev','$jelszo')";
        $qry = mysqli_query($conn, $sql);
        $sikerUzenet = 'Sikeres regisztráció! Mostmár tagja vagy az elfeljetett könyvek könyvtárának!';
    }
}
?>
<section>
    <div class="container-fluid p-0">
        <div class="jumbotron text-center banner">
            <h1 class="display-4">Regisztráció</h1>
            <p class="lead">Az Elfelejtett Könyvtár</p>
        </div>
    </div>
    <div class="container p-3">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-6">
                <?php if(isset($hibaUzenet) and $hibaUzenet != ''){ ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Sikeretlen regisztráció!</h4>
                            <ul>
                                <?= $hibaUzenet ?>
                            </ul>
                        <hr>
                        <p class="mb-0">Kérjük javítsa a kért paramétereket és próbálja meg újra.</p>
                    </div>
                <?php } ?>
                <?php if(isset($sikerUzenet) and $sikerUzenet != ''){ ?>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Sikeres regisztráció!</h4>
                        <?= $sikerUzenet ?>
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header p-3">
                        Regisztráció
                    </div>
                    <div class="card-body mb-2 mt-2">
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>?oldal=regisztracio" method="POST">
                            <div class="form-group">
                                <label class="text-start" for="nev">Név</label>
                                <input min="5"  name="nev" type="text" class="form-control" id="nev" placeholder="Írd be a teljes nevét..." required>
                            </div>
                            <div class="form-group">
                                <label class="text-start" for="felhasznaloNev">Felhasználó név</label>
                                <input min="5" name="felhasznaloNev" type="text" class="form-control" id="felhasznaloNev" placeholder="Írd be a felhasználó nevét..." required>
                            </div>
                            <div class="form-group">
                                <label class="text-start" for="email">Email cím</label>
                                <input min="7" name="email" type="email" class="form-control" id="email" placeholder="Írd be az email címed..." required>
                            </div>
                            <div class="form-group">
                                <label for="jelszo">Jelszó</label>
                                <input min="8" name="jelszo" type="password" class="form-control" id="jelszo" placeholder="Írd be a jelszavad..." required>
                            </div>
                            <div class="form-group">
                                <label for="jelszoUjra">Jelszó újra</label>
                                <input min="8" name="jelszoUjra" type="password" class="form-control" id="jelszoUjra" placeholder="Írja be újra jelszavát..." required>
                            </div>
                            <hr>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="aszf" required>
                                <label style="font-size: 15px;" class="form-check-label mb-3" for="aszf">Elfogadom az "Elfeletett könytár" adatvédelmi tájékozatóját és az ÁSZF-ét</label>
                            </div>
                            <button name="regisztracioKuldes" type="submit" class="btn btn-primary btn-block mt-4"><i class="fas fa-user-plus"></i> Regisztráció</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-start">Van már fiókja? <a href="index.php?oldal=bejelentkezes">Kattintson ide és jelentkezzen be!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>