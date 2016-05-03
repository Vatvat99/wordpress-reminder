jQuery(document).ready( function() {

    // Au clic sur le bouton pour envoyer une image
    jQuery('.media-uploader-add-button').on('click', function(e) {
        e.preventDefault();

        var element = jQuery(this).parent();
        // wp est une variable globale js fournie par wordpress
        // see https://codex.wordpress.org/Javascript_Reference/wp
        // On ouvre une boîte "media" permettant d'uploader une image
        var uploader = wp.media({
            title: 'Envoyer une image',
            button: {
                text: 'Choisir un fichier'
            },
            multiple: false
        })
        .on('select', function() {
            // On récupère la sélection d'image qui a été faite
            var selection = uploader.state().get('selection');
            var attachment = selection.first().toJSON();
            // Et on met à jour l'input texte avec l'url de l'image
            jQuery('input', element).val(attachment.url);
            jQuery('img', element).attr('src', attachment.url);
        })
        .open();


    });

});
