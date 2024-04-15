<?php
if(isset($_SESSION['id']) AND $_SESSION['id'] > 0){
    header('Location: index.php');
    exit();
}
if(isset($_POST['bejelentkezesKuldes'])){
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $jelszo = isset($_POST['jelszo']) ? md5(htmlspecialchars($_POST['jelszo'])) : '';

    $sql = "SELECT * FROM felhasznalok WHERE email='$email' AND jelszo='$jelszo'";
    $qry = mysqli_query($conn, $sql);
    $sorok = mysqli_num_rows($qry);
    if($sorok == 1){
        $felhasznaloAdat = mysqli_fetch_assoc($qry);
        $_SESSION['id'] = $felhasznaloAdat['id'];
        $_SESSION['nev'] = $felhasznaloAdat['nev'];
        $_SESSION['email'] = $felhasznaloAdat['email'];
        $_SESSION['felhasznalonev'] = $felhasznaloAdat['felhasznalonev'];
        header('Location: index.php');
        exit();
    }else{
        $hibasBelepes = true;
    }
}
?>
<section>
    <div class="container-fluid p-0">
        <div class="jumbotron text-center banner">
            <h1 class="display-4">Bejelentkezés</h1>
            <p class="lead">Az Elfelejtett Könyvtár</p>
        </div>
    </div>
    <div class="container p-3">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-6">
                <?php if(isset($hibasBelepes) and $hibasBelepes == true){ ?>
                    <div class="alert alert-danger" role="alert">
                        <b>Hibás bejelentkezés!</b> Hibás felhasználónév vagy jelszó!
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header p-3">
                        Bejelentkezés
                    </div>
                    <div class="card-body mb-5">
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>?oldal=bejelentkezes" method="POST">
                            <div class="form-group">
                                <label class="text-start" for="email">Email cím</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="Írd be az email címed">
                            </div>
                            <div class="form-group">
                                <label for="jelszo">Jelszó</label>
                                <input name="jelszo" type="password" class="form-control" id="jelszo" placeholder="Írd be a jelszavad">
                            </div>
                            <button name="bejelentkezesKuldes" type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Bejelentkezés</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-start">Nincs még fiókja? <a href="index.php?oldal=regisztracio">Kattintson ide és regisztráljon</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>