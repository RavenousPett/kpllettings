<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article <?php post_class( 'agent-row' ); ?>>
    <div class="agent-row-content style-list">
        <div class="agent-row-content-inner">
            <div class="agent-row-main">
	            <?php if ( has_post_thumbnail() ) :   ?>
		            <div class="agent-thumbnail">
			            <?php if ( has_post_thumbnail() ) : ?>
				            <a href="<?php the_permalink() ?>">
					            <?php the_post_thumbnail( 'full' ); ?>
				            </a>
			            <?php endif; ?>
		            </div>
	            <?php endif; ?>

	            <div class="agent-row-body">
		            <?php $properties_count = Realia_Query::get_agent_properties()->post_count; ?>
		            <?php if ( $properties_count > 0 ) : ?>
			            <div class="agent-row-properties hidden">
				            <?php if ( ! empty( $properties_count ) ) : ?>
					            <div class="agent-row-subtitle">
						            <?php echo esc_attr( $properties_count ); ?> <?php echo esc_html__( 'properties', 'preston' ); ?>
					            </div><!-- /.agent-row-subtitle -->
				            <?php endif; ?>
			            </div><!-- /.agent-row-properties -->
					<?php endif; ?>

		            <h2 class="agent-row-title entry-title">
			            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		            </h2>
		            <div class="agencies">
		            	Agencies
		            </div>
		            <div class="description">
						<?php echo apustheme_substring( get_the_excerpt(), 18, '...' ); ?>
					</div>
                    <a href="<?php the_permalink() ?>" class="view-more">
                        <?php esc_html_e( 'CONTACT NOW', 'preston' ); ?>
                    </a>
	            </div><!-- /.agent-row-body -->

            </div><!-- /.agent-row-main -->
        </div><!-- /.agent-row-content-inner -->
    </div><!-- /.agent-row-content -->
</article>
