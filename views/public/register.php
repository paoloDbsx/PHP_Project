<span>Vous possédez déjà un compte ? <a href="/login">Connectez-vous</a></span>
<br><br>
<form method="post">
    <input name="pseudo" placeholder="pseudo">
    <input type="password" name="password" placeholder="password"><br><br>
    <button type="submit" name="register">Inscription</button>
    <span class="error">&nbsp;&nbsp;<?= $error ?></span>
</form>