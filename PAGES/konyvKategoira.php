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
?>
<link rel="stylesheet" href="STYLE/CSS/Konyv.css">
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
<script src="JS/Konyv.js"></script>