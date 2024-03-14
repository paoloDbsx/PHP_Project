<div class="header">
    <span><?= (isset($_SESSION["user"]) ? "Connecté en tant que : <i><b>" . $_SESSION["user"]["pseudo"] . "</i></b><br><br>" : "Déconnecté<br><br>"); ?></span>
    <form method="post">
        <button type="submit" name="logout">Déconnexion</button>
    </form>
</div>
<h1>Accueil</h1>
<a href="/post">Créer un article</a>
<br><br><br>
<?php foreach ($posts as $post) : ?>
    <div class="post">
        <?php if ($post->getUser()->getId() === $_SESSION["user"]["id"]) : ?>
            <div class="buttons">
                <a href="/update/<?= $post->getId() ?>"><button>&#9998;</button></a>
                <form method="post">
                    <input type="hidden" name="id" value=<?= $post->getId() ?>>
                    <button type="submit" name="delete">&#128465;</button>
                </form>
            </div>
        <?php endif ?>
        <h2><?= $post->getTitle() ?></h2>
        <p><?= $post->getContent() ?></p>
        <br>
        <p class="user">Ecrit par : <i><b><?= $post->getUser()->getPseudo() ?></i></b></p>
    </div>
    <br>
<?php endforeach ?>