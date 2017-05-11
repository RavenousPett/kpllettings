<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

<div class="agent-box">
    <?php if ( has_post_thumbnail() ) : ?>
		<div class="agent-box-image <?php if ( ! has_post_thumbnail() ) { echo 'without-image'; } ?>">
	        <a href="<?php the_permalink(); ?>" class="agent-box-image-inner <?php if ( ! empty( $agent ) ) : ?>has-agent<?php endif; ?>">
                <?php the_post_thumbnail( 'medium' ); ?>
	        </a>
		</div><!-- /.agent-box-image -->
    <?php endif; ?>

    <div class="agent-box-content">
        <h3 class="agent-box-title">
            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
        </h3><!-- /.agent-box-title -->
        <?php $properties_count = Realia_Query::get_agent_properties()->post_count; ?>
        <?php if ( $properties_count > 0 ) : ?>
            <div class="agent-row-properties ">
                <?php if ( ! empty( $properties_count ) ) : ?>
                    <div class="agent-row-subtitle">
                        <?php echo esc_attr( $properties_count ); ?> <?php echo esc_html__( 'properties', 'preston' ); ?>
                    </div><!-- /.agent-row-subtitle -->
                <?php endif; ?>
            </div><!-- /.agent-row-properties -->
        <?php endif; ?>

        <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
        <?php if ( ! empty( $email ) ) : ?>
            <div class="agent-box-email">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
	            <a href="mailto:<?php echo esc_attr( $email ); ?>">
                    <?php echo esc_attr( $email ); ?>
	            </a>
            </div><!-- /.agent-box-email -->
        <?php endif; ?>

        <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
        <?php if ( ! empty( $phone ) ) : ?>
            <div class="agent-box-phone">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <?php echo esc_attr( $phone ); ?>
            </div><!-- /.agent-box-phone -->
        <?php endif; ?>

	    <?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>
	    <?php if ( ! empty( $web ) ) : ?>
		    <div class="agent-box-web">
                <i class="fa fa-globe" aria-hidden="true"></i>
			    <a href="<?php echo esc_attr( $web ); ?>">
			        <?php echo esc_attr( $web ); ?>
			    </a>
		    </div><!-- /.agent-box-web -->
	    <?php endif; ?>

        <div class="agent-social-networks">
            <?php $social_networks = apply_filters( 'realia_social_networks', array() ); ?>
            <?php foreach( $social_networks as $key => $title ): ?>
                <?php $network = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'social_' . $key, true ); ?>
                <?php if ( ! empty( $network ) ) : ?>
                    <a href="<?php echo esc_attr( $network ); ?>" class="agent-social-network fa fa-<?php echo esc_attr($key); ?>" target="_blank"></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div><!-- /.agent-social-networks -->
    </div><!-- /.agent-box-content -->
</div><!-- /.agent-box-->