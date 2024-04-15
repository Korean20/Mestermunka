<section>
    <div id="video-container">
        <video id="video-background" autoplay loop muted>
            <source src="VIDEOS/konyv.mp4" type="video/mp4">
            A böngésződ nem támogatja a video elemet.
        </video>
    </div>
    <div class="container text-center p-5">

        <h2>Üdvözöljük az "Az Elfelejtett Könyvtár" világában!</h2>
        <p>
            Ön most beléphet egy varázslatos könyves vidékre, ahol a történetek életre kelnek és az oldalak tele vannak rejtélyekkel. Fedezze fel ezt a káprázatos világot és hagyja, hogy az elvarázsolt könyvtár megérintse az olvasás iránti szenvedélyét.
        </p>

        <h3>Miről szól a oldal?</h3>
        <p>
            Rövid összefoglaló a könyvről, kitérve a főszereplőkre, a cselekményre és a világra, amelyet a könyv bemutat.
        </p>

        <h3 id="miert_erdemes">Miért érdemes böngészni?</h3>
        <p>
            Kiemelni a könyv egyediségét, izgalmas cselekményét, és azt, hogy milyen élményekre számíthat az olvasó.
        </p>

        <?php if(!isset($_SESSION['id'])){ ?>
            <h3>Belepés / Regisztráció / Chat</h3>
            <a class="btn btn-secondary" href="index.php?oldal=bejelentkezes">Belepés</a>
            <a class="btn btn-secondary" href="index.php?oldal=regisztracio">Regisztráció</a>
        <?php }else{ ?>
            <h3>Profilom / Chat</h3>
            <a class="btn btn-secondary" href="index.php?oldal=profilom">Profilom</a>
        <?php } ?>

        <a class="btn btn-secondary <?= (isset($_SESSION['id']) AND $_SESSION['id'] > 1) ? '' : 'disabled' ?>" href="index.php?oldal=chat">Chat</a>
        <br>
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