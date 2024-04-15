<?php
session_start();
include_once 'INCLUDES/head.php';
switch ($oldal){
    case 'bejelentkezes':
        include_once 'PAGES/bejelentkezes.php';
        break;
    case 'regisztracio':
        include_once 'PAGES/regisztracio.php';
        break;
    case 'kezdolap':
        include_once 'PAGES/kezdolap.php';
        break;
    case 'chat':
        include_once 'PAGES/chat.php';
        break;
    case 'profilom':
        include_once 'PAGES/profilom.php';
        break;
    case 'konyvKategoria':
        include_once 'PAGES/konyvKategoira.php';
        break;
    case 'konyv':
        include_once 'PAGES/konyv.php';
        break;
    case 'kijelentkezes':
        unset($_SESSION['id']);
        session_destroy();
        header('Location: index.php');
        break;
    default:
        include_once 'PAGES/404.php';
        break;
}

include_once 'INCLUDES/footer.php';
?>