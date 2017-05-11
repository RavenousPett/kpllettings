<?php
    $thumbsize = isset($thumbsize) ? $thumbsize : apustheme_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 22;
    $post_format = get_post_format();
?>

<article <?php post_class('post post-grid'); ?>>
    <div class="clearfix info-top <?php echo (($post_format == 'gallery') || (has_post_thumbnail() && $post_format != 'audio' && $post_format != 'video' && $post_format != 'link') )?'has-img':''; ?>">
        <?php
        $thumb = apustheme_display_post_thumb($thumbsize);
        echo trim($thumb);
        ?>
        <span class="date-wrapper"><?php the_time( 'd' ); ?><br /><?php the_time( 'M' ); ?>  </span>
        <div class="meta-info">
            <span class="author">
                <?php
                    printf( '<span class="post-author">%1$s<a href="%2$s">%3$s</a></span>',
                        _x( '<i class="fa fa-user"></i>', 'Used before post author name.', 'preston' ),
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        get_the_author()
                    );
                ?>
            </span>
            <span class="category">
                <i class="fa fa-folder-open"></i><?php apustheme_post_categories($post); ?>
            </span>
        </div>
    </div>
    <div class="entry-content <?php echo !empty($thumb) ? '' : 'no-thumb'; ?>">
        <div class="entry-meta">
            <div class="info">
                
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>
                
            </div>
        </div>
        <div class="info-bottom">
            <?php if (! has_excerpt()) { ?>
                <div class="entry-description"><?php echo apustheme_substring( get_the_content(), $nb_word, '.' ); ?></div>
            <?php } else { ?>
                <div class="entry-description"><?php echo apustheme_substring( get_the_excerpt(), $nb_word, '.' ); ?></div>
            <?php } ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php esc_html_e('Read More','preston') ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
    </div>
</article>