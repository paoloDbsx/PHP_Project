<a href="/">Retour à l'accueil</a>
<h1>Création d'un article</h1>
<form method="post">
    <label for="title">Titre</label>
    <br><br>
    <textarea name="title" id="title" rows="2"></textarea>
    <br><br>
    <label for="title">Contenu de l'article</label>
    <br><br>
    <textarea name="content" id="content" rows="10"></textarea>
    <br><br>
    <button type="submit" name="post">Poster l'article</button>
    <span class="error">&nbsp;&nbsp;<?= $error ?></span>
</form>