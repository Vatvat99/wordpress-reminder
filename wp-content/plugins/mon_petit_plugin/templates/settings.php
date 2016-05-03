<div class="wrap">
    <h2>Mon petit plugin</h2>
    <form method="post" action="options.php">
        <?php
        // see https://codex.wordpress.org/Function_Reference/settings_fields
        @settings_fields('mon_petit_plugin_settings_group');
        // see http://codex.wordpress.org/Function_Reference/do_settings_fields
        @do_settings_fields('mon_petit_plugin_settings_group');
        ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="setting_a">Setting A</label></th>
                <td><input type="text" name="setting_a" id="setting_a" value="<?php echo get_option('setting_a'); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="setting_b">Setting B</label></th>
                <td>
                    <select name="setting_b" id="setting_b">
                        <?php for ($i=0; $i < 10; $i++) { ?>
                            <?php $selected = ($i == get_option('setting_b')) ? 'selected="selected"' : ''; ?>
                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
        </table>

        <?php
        // see https://codex.wordpress.org/Function_Reference/submit_button
        @submit_button();
        ?>
    </form>
</div>
