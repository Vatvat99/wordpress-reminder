<?php
/*
Template Name: Profil
*/

// Si le formulaire a été posté
if (!empty($_POST)) {
    // On met à jour la meta âge
    update_user_meta(get_current_user_id(), 'user_age', $_POST['user_age']);
}

// On récupère les infos de l'utilisateur courant
$user = wp_get_current_user();

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connection
if ($user->ID == 0)
    header('location:login');
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
    <div class="post">
        <h1>Mes informations</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <label for="age">Age :</label>
            <input type="text" name="user_age" value="<?php echo get_user_meta(get_current_user_id(), 'user_age', true); ?>">
            <button type="submit">Modifier</button>
        </form>
    </div>
</div>

<?php get_footer(); ?>
