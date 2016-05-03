<div class="wrap">
    <h1>Réseaux sociaux</h1>
    <?php if (isset($success)) { ?>
        <div id="message" class="updated fade"><?php echo $success; ?></div>
    <?php } ?>

    <form action="" method="post">
        <div class="theme-options-group">
            <table cellspacing="0" class="widefat options-table">
                <thead>
                    <tr>
                        <th colspan="2">Mes réseaux sociaux</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="header">Header</label>
                        </th>
                        <td>
                            <img src="<?php echo get_option('header', ''); ?>" width="128">
                            <input type="text" id="header" name="options[header]" value="<?php echo get_option('header', ''); ?>" size="75">
                            <a href="#" class="media-uploader-add-button button">Choisir une image</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="panel_noncename" value="<?php echo wp_create_nonce('my-panel'); ?>">
        <p class="submit">
            <button type="submit" name="panel_update" class="button-primary autowidth">Sauvegarder</button>
        </p>
    </form>
</div>
