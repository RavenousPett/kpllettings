<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('detail-post'); ?>>
    <?php if ( $post_format == 'gallery' ) {
        $gallery = apustheme_post_gallery( get_the_content(), array( 'size' => 'full' ) );
    ?>
        <div class="entry-thumb <?php echo  (empty($gallery) ? 'no-thumb' : ''); ?>">
            <?php echo trim($gallery); ?>
        </div>
    <?php } elseif( $post_format == 'link' ) {
            $apustheme_format = apustheme_post_format_link_helper( get_the_content(), get_the_title() );
            $apustheme_title = $apustheme_format['title'];
            $apustheme_link = apustheme_get_link_attributes( $apustheme_title );
            $thumb = apustheme_post_thumbnail('', $apustheme_link);
            echo trim($thumb);
        } else { ?>
    	<div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
    		<?php
                $thumb = apustheme_post_thumbnail();
                echo trim($thumb);
            ?>
    	</div>
    <?php } ?>
	<div class="entry-content">
        <div class="info-top clearfix">
            <div class="pull-left">
                <div class="media">
                    <div class="media-left">
                        <span class="date-wrapper"><?php the_time( 'd' ); ?><br /><?php the_time( 'M' ); ?>  </span>
                    </div>
                    <div class="media-body">
                        <?php if (get_the_title()) { ?>
                            <h4 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                        <?php } ?>
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
                </div>
            </div>
            <div class="pull-right">
               <?php if( apustheme_get_config('show_blog_social_share', true) ) {
                    get_template_part( 'page-templates/parts/sharebox' );
                } ?>         
            </div>
        </div>

    	<div class="single-info info-bottom">
    		<?php
                if ( $post_format == 'gallery' ) {
                    $gallery_filter = apustheme_gallery_from_content( get_the_content() );
                    echo trim($gallery_filter['filtered_content']);
                } else {
            ?>
                    <div class="entry-description"><?php the_content(); ?></div><!-- /entry-content -->
            <?php } ?>
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'preston' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'preston' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
    		<div class="tag-social">
                <div class="pull-left">
                    <?php apustheme_post_tags(); ?>
                </div>
    		</div>
    	</div>
    </div>
</article>