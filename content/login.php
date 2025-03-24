<?php
//Traitements toujours au dessus

if(isset($_POST['login_submit']))
{
    extract($_POST, EXTR_OVERWRITE);
    $adm = new adminDAO($cnx);
    $admin = $adm->getAdmin($login, $password);
    $_SESSION["admin"] = $admin;
    header('Location: admin/index_.php?page=accueil_admin.php');
    print "<br>Bonjour admin : ".$admin;
}
?>

<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="mb-3">
        <label for="login" class="form-label">Email address</label>
        <input type="text" class="form-control" id="login" name="login">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login_submit">Connexion</button>
</form>