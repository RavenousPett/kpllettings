<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('detail-agency'); ?>>

    <div class="entry-content">
        <div class="info-top">
            <div class="agency-header">
                <div class="agency-thumbnail">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                    <?php endif; ?>
                </div>

                <div class="agency-overview">
                    
                    <ul class="agent-social">
                        <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
                        <?php if ( ! empty( $email ) ) : ?>
                            <li><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo esc_attr( $email ); ?></li>
                        <?php endif; ?>

                        <?php $web = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'web', true ); ?>
                        <?php if ( ! empty( $web ) ) : ?>
                            <li><i class="fa fa-globe" aria-hidden="true"></i><?php echo esc_attr( $web ); ?></li>
                        <?php endif; ?>

                        <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
                        <?php if ( ! empty( $phone ) ) : ?>
                            <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo esc_attr( $phone ); ?></li>
                        <?php endif; ?>

                        <?php $address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>
                        <?php if ( ! empty( $address ) ) : ?>
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo wp_kses( nl2br( $address ), wp_kses_allowed_html( 'post' ) ); ?></li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.agency-overview -->

                <div class="agency-social-networks">
                    <?php $social_networks = apply_filters( 'realia_social_networks', array() ); ?>
                    <?php foreach( $social_networks as $key => $title ): ?>
                        <?php $network = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'social_' . $key, true ); ?>
                        <?php if ( ! empty( $network ) ) : ?>
                            <a href="<?php echo esc_attr( $network ); ?>" class="agency-social-network fa fa-<?php echo esc_attr($key); ?>" target="_blank"></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div><!-- /.agent-social-networks -->
            </div><!-- /.agency-header -->
            <div class="description">
                <?php
                    if ( is_single() ) :
                        the_title( '<h1 class="entry-title">', '</h1>' );
                    else :
                        the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                    endif;
                ?>
                <?php the_content( sprintf( esc_html__( 'Continue reading %s', 'preston' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) ); ?>
            </div>
        </div>
        <?php if ( is_single() ) : ?>
            <!-- Agency's location -->
            <?php $location = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'location', true ); ?>

            <?php if ( ! empty( $location ) && 2 == count( $location ) ) : ?>
               
                <!-- MAP -->
                <div class="map-position">
                    <div id="single-property-map"
                         data-latitude="<?php echo esc_attr( $location['latitude'] ); ?>"
                         data-longitude="<?php echo esc_attr( $location['longitude'] ); ?>">
                    </div><!-- /#map-property -->
                </div><!-- /.map-property -->
            <?php endif; ?>

            <!-- Agency's agents -->
            <?php Realia_Query::loop_agency_agents(); ?>

            <?php if ( have_posts() ) : ?>
                

                <div class="agency-agents type-box item-per-row-3">
	                <div class="agents-row row">
		                <?php $index = 0; ?>
	                    <?php while ( have_posts() ) : the_post(); ?>
	                        <div class="agent-container col-md-4 col-xs-12">
		                        <?php echo Realia_Template_Loader::load('agents/box'); ?>
	                        </div>

			                <?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
		                        </div><div class="agents-row">
			                <?php endif; ?>

			                <?php $index++; ?>
	                    <?php endwhile; ?>
	                </div><!-- /.agents-row -->
                </div><!-- /.agency-agents -->
            <?php endif;?>

            <?php wp_reset_query(); ?>
        <?php endif; ?>

        <?php wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'preston' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'preston' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) ); ?>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <div class="box"><?php comments_template( '', true ); ?></div>
        <?php endif; ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->