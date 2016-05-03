<?php
/*
Template Name: Connexion
*/

// Si le formulaire a été posté
if (!empty($_POST)) {
    // see https://codex.wordpress.org/Function_Reference/wp_signon
    $user = wp_signon($_POST);

    if (is_wp_error($user)) {
        $error = $user->get_error_message();
    } else {
        header('location:profil');
    }
} else {
    // Si l'utilisateur est connecté, on le redirige vers son profil
    $user = wp_get_current_user();
    if ($user->ID != 0)
        header('location:profil');
}
?>

<?php get_header(); ?>
<?php
// Affiche un formulaire de connection sans avoir besoin de se prendre le chou
// see https://codex.wordpress.org/Function_Reference/wp_login_form
// wp_login_form(); ?>
<div class="single">
    <div class="post">
        <h1>Se connecter</h1>

        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <label for="user_login">Identifiant :</label>
            <input type="text" name="user_login" id="user_login">
            <label for="user_password">Mot de passe :</label>
            <input type="password" name="user_password" id="user_password">
            <input type="checkbox" name="remember" id="remember" value="1">
            <label for="remember">Se souvenir de moi</label><br>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</div>

<?php get_footer(); ?>
