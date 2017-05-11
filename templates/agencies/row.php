<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article <?php post_class( 'agency-row' ); ?>>
    <div class="agency-row-content">
        <div class="agency-row-content-inner">
            <div class="agency-row-main clearfix">
                <?php if ( has_post_thumbnail() ) : ?>
		            <div class="agency-row-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                        </a>
		            </div><!-- /.agency-row-thumbnail -->
                <?php endif; ?>

                <div class="agency-row-body">
                	<h2 class="agency-row-title entry-title">
		                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                </h2>
	                <?php $agents_count = Realia_Query::get_agency_agents()->post_count; ?>

	                <?php if ( $agents_count > 0 ) : ?>
		                <div class="agency-row-agents">
			                <?php if ( ! empty( $agents_count ) ) : ?>
				                <div class="agency-row-subtitle">
					                <?php echo esc_attr( $agents_count ); ?> <?php echo esc_html__( 'agents', 'preston' ); ?>
				                </div><!-- /.agency-row-subtitle -->
			                <?php endif; ?>
		                </div><!-- /.agency-row-agents -->
	                <?php endif; ?>

	                <?php echo apustheme_substring( get_the_excerpt(), 25, '...' ); ?>
                </div><!-- /.agency-row-body -->

	            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
	            <?php $web = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'web', true ); ?>
	            <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
	            <?php $address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>

	            <?php if ( ! empty( $email ) || ! empty( $web ) || ! empty( $phone ) || ! empty( $address ) ) : ?>
		            <div class="agency-row-overview">
		                <h2 class="agency-row-overview-title">
			                <?php echo esc_html__( 'Contact Information', 'preston' ); ?>
		                </h2><!-- /.agency-row-overview -->

	                    <ul class="agent-social">
	                        <?php if ( ! empty( $email ) ) : ?>
		                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i>
			                        <a href="mailto:<?php echo esc_attr( $email ); ?>">
			                            <?php echo esc_attr( $email ); ?>
			                        </a>
		                        </li>
	                        <?php endif; ?>

	                        <?php if ( ! empty( $web ) ) : ?>
		                        <li><i class="fa fa-globe" aria-hidden="true"></i>
			                        <a href="<?php echo esc_attr( $web ); ?>">
			                            <?php echo esc_attr( $web ); ?>
			                        </a>
		                        </li>
	                        <?php endif; ?>

	                        <?php if ( ! empty( $phone ) ) : ?>
	                            <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo esc_attr( $phone ); ?></li>
	                        <?php endif; ?>

	                        <?php if ( ! empty( $address ) ) : ?>
	                            <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo wp_kses( nl2br( $address ), wp_kses_allowed_html( 'post' ) ); ?></li>
	                        <?php endif; ?>
	                    </ul>
	                </div><!-- /.agency-row-overview -->
	            <?php endif; ?>
            </div><!-- /.agency-row-main -->
        </div><!-- /.agency-row-content-inner -->
    </div><!-- /.agency-row-content -->
</article>