<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<header class="entry-header">
	<div class="container">
		<!-- label here -->
		<?php echo Realia_Template_Loader::load('single/gallery'); ?>
		<header class="entry-header">
			<div class="top-detail clearfix main-content-top">
				<div class="pull-left">
					<?php apustheme_property_breadcrumbs(); ?>
				</div>
				<div class="apus-property-detail-actions pull-right">
					<?php do_action( 'preston_property_actions', get_the_ID() ); ?>
				</div><!-- /.property-detail-actions -->
			</div>
			<?php echo Realia_Template_Loader::load('single/content-header'); ?>
		</header>
	</div>
</header>
<div class="container">
	<div class="entry-content">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<div class="property-content">
					<?php 
					$content_layout = apustheme_get_config('property_single_content_layout', 'default');
					if (empty($content_layout)) {
						$content_layout = 'default';
					}
					?>
					<?php echo Realia_Template_Loader::load('single-layout/content-layout/'.$content_layout); ?>
					
					<div class="property-position">
						<h3> <?php echo esc_html__( 'Position', 'preston' ); ?></h3>
						<?php echo Realia_Template_Loader::load('single/map'); ?>
					</div>
					<?php echo Realia_Template_Loader::load('single/floor'); ?>
					<!-- SUBPROPERTIES -->
					<?php echo Realia_Template_Loader::load('single/subproperties'); ?>
					
			        <!-- SIMILAR PROPERTIES -->
			        <?php echo Realia_Template_Loader::load('single/similar'); ?>

			        <?php wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'preston' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'preston' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
					?>

			        <?php if ( comments_open() || get_comments_number() ) : ?>
			            <?php comments_template( '', true ); ?>
			        <?php endif; ?>
				</div>
			</div>
			<div class="sidebar-detail col-xs-12 col-md-3 col-sm-4">
				<!-- sidebar -->
				<?php if ( is_active_sidebar( 'single-property-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'single-property-sidebar' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>