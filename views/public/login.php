<span>Pas de compte ? <a href="/register">Inscrivez-vous</a></span>
<br><br>
<form method="post">
    <input name="pseudo" placeholder="pseudo">
    <input type="password" name="password" placeholder="password"><br><br>
    <button type="submit" name="login">Connexion</button>
    <span class="error">&nbsp;&nbsp;<?= $error ?></span>
</form>