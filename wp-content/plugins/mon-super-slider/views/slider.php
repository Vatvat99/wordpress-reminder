<div id="monSuperSlider">
    <?php while ($slides->have_posts()) { ?>
        <div>
            <?php $slides->the_post(); ?>
            <?php global $post; ?>
            <?php if (!empty(get_post_meta($post->ID, '_link', true))) { ?>
                <a href="<?php echo esc_attr(get_post_meta($post->ID, '_link', true)); ?>">
            <?php } ?>
                    <?php the_post_thumbnail('slide'); ?>
            <?php if (!empty(get_post_meta($post->ID, '_link', true))) { ?>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>
