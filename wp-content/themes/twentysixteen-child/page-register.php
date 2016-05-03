<?php
/*
Template Name: Inscription
*/

// Si le formulaire a été posté
if (!empty($_POST)) {
    // On vérifie qu'il n'y a pas d'erreurs
    if ($_POST['user_pass'] != $_POST['confirm_user_pass'])
        $error = 'Les mots de passe ne correspondent pas';
    elseif (!is_email($_POST['user_email']))
        $error = 'L\'adresse e-mail n\'est pas valide';
    // S'il n'y a pas d'erreurs
    else {
        // On enregistre le nouvel utilisateur
        // see https://codex.wordpress.org/Function_Reference/wp_insert_user
        $user = wp_insert_user(array(
            'user_login' => $_POST['user_login'],
            'user_pass' => $_POST['user_pass'],
            'user_email' => $_POST['user_email'],
            'user_registered' => date('Y-m-d H:i:s'),
        ));
        // Si il y a eu une erreur
        // see https://codex.wordpress.org/Function_Reference/is_wp_error
        if (is_wp_error($user)) {
            $error = $user->get_error_messages();
        }
        // L'utilisateur a bien été enregistré
        else {
            // On envoie un mail de confirmation
            // see https://developer.wordpress.org/reference/functions/wp_mail/
            $message = 'Votre inscription a bien été effectuée.';
            $headers = 'From : ' . get_option('admin_email') . '\r\n';
            wp_mail($_POST['user_email'], 'Inscription réussie', $message, $headers);
            // on connecte l'utilisateur
            wp_signon($_POST);
            // et on redirige vers le profil
            header('location:profil');
        }
    }
}
?>

<?php get_header(); ?>
<div class="single">
    <div class="post">
        <h1>Inscription</h1>

        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <label for="user_login">Identifiant :</label>
            <input type="text" name="user_login" id="user_login" value="<?php echo isset($_POST['user_login']) ? $_POST['user_login'] : ''; ?>">
            <label for="user_email">E-mail :</label>
            <input type="email" name="user_email" id="user_email" value="<?php echo isset($_POST['user_email']) ? $_POST['user_email'] : ''; ?>">
            <label for="user_pass">Mot de passe :</label>
            <input type="password" name="user_pass" id="user_pass" value="<?php echo isset($_POST['user_pass']) ? $_POST['user_pass'] : ''; ?>">
            <label for="confirm_user_pass">Confirmation mot de passe :</label>
            <input type="password" name="confirm_user_pass" id="confirm_user_pass" value="<?php echo isset($_POST['confirm_user_pass']) ? $_POST['confirm_user_pass'] : ''; ?>"><br><br>
            <button type="submit">S'inscrire</button>

            <?php // Pour ajouter des infos d'un utilisateur autres que celles supportées par wp_insert_user, utiliser les meta user (get user meta, add user meta).
            // see https://codex.wordpress.org/Function_Reference/wp_insert_user
            // see https://codex.wordpress.org/Function_Reference/get_user_meta
            // see https://codex.wordpress.org/Function_Reference/add_user_meta ?>

        </form>
    </div>
</div>
<?php get_footer(); ?>
