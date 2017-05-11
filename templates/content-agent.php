<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <div class="agent-detail">
        <div class="row row-50">
            <div class="col-md-7">
                <div class="agent-header">
                    <div class="agent-thumbnail">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large' ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="content-info">
                        <?php
                            if ( is_single() ) :
                                the_title( '<h1 class="agent-row-title entry-title">', '</h1>' );
                            else :
                                the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                            endif;
                        ?>
                        <div class="agencies">
                            <?php
                            $agent_agencies = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'agencies', true );
                            if ($agent_agencies) {
                                $count = 1;
                                foreach ($agent_agencies as $id) {
                                    $post = get_post($id);
                                    ?>
                                    <a href="<?php echo esc_url(get_permalink($post)); ?>" title="<?php echo esc_attr($post->post_title); ?>"><?php echo trim($post->post_title); ?></a><?php echo (count($agent_agencies) > $count ? ', ' : ''); ?>
                                    <?php
                                    $count++;
                                }
                            }
                            ?>
                        </div>    
                        <div class="agent-overview">
                            <ul class="agent-social">
                                <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
                                <?php if ( ! empty( $email ) ) : ?>
                                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo esc_attr( $email ); ?></li>
                                <?php endif; ?>

                                <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
                                <?php if ( ! empty( $phone ) ) : ?>
                                    <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo esc_attr( $phone ); ?></li>
                                <?php endif; ?>

                                <?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>
                                <?php if ( ! empty( $web ) ) : ?>
                                    <li><i class="fa fa-globe" aria-hidden="true"></i><?php echo esc_attr( $web ); ?></li>
                                <?php endif; ?>

                                <?php $address = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'address', true ); ?>
                                <?php if ( ! empty( $address ) ) : ?>
                                   <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo wp_kses( nl2br( $address ), wp_kses_allowed_html( 'post' ) ); ?></li>
                                <?php endif; ?>
                            </ul>
                        </div><!-- /.agent-overview -->

                    </div>
                    <div class="description">
                        <div class="agent-social-networks">
                            <?php $social_networks = apply_filters( 'realia_social_networks', array() ); ?>
                            <?php foreach( $social_networks as $key => $title ): ?>
                                <?php $network = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'social_' . $key, true ); ?>
                                <?php if ( ! empty( $network ) ) : ?>
                                    <a href="<?php echo esc_attr( $network ); ?>" class="agent-social-network fa fa-<?php echo esc_attr($key); ?>" target="_blank"></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div><!-- /.agent-social-networks -->
                        <?php the_content( sprintf( esc_html__( 'Continue reading %s', 'preston' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) ); ?>
                    </div>
                </div><!-- /.agent-header -->
            </div>
            <div class="col-md-5">
                <?php echo Realia_Template_Loader::load('agents/contact-form'); ?>
            </div>   
        </div>
        </div>
        <?php if ( is_single() ) : ?>
            <?php
                Realia_Query::loop_agent_properties();
                $bcol = 4;
                $class = 'col-md-'.esc_attr($bcol).' col-sm-6';
                if ( have_posts() ) : ?>
                <div class="agent-properties type-box">
                    <div class="widget-heading-title ">
                        <h3 class="title"><?php echo esc_html__('Agent Properties','preston') ?></h3>
                        <div class="desc"><?php echo esc_html__('Here are some of the properties listed by our related agents.','preston') ?></div>
                    </div>

                    <div class="row">
                        <?php
                            $count = 0;
                            while ( have_posts() ) : the_post(); ?>
                                <div class="<?php echo esc_attr($class); ?><?php echo ($count%3 == 0) ? ' col-md-clear':''; ?> <?php echo ($count%2 == 0) ? ' col-sm-clear' : ''; ?>">
                                    <?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
                                </div><!-- /.property-container -->
                        <?php $count++; ?>
                        <?php endwhile; ?>
                    </div><!-- /.properties-row -->
                </div><!-- /.agent-properties -->
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