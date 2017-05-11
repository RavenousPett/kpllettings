<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Preston
 * @since Preston 1.0
 */

$footer = apply_filters( 'apustheme_get_footer_layout', 'default' );

?>

	</div><!-- .site-content -->

	<footer id="apus-footer" class="apus-footer" role="contentinfo">
		<?php if ( !empty($footer) ): ?>
			<?php apustheme_display_footer_builder($footer); ?>
		<?php else: ?>
			
			<!--==============================powered=====================================-->
			
			<div class="apus-copyright">
				<div class="container">
					<div class="copyright-content">
						<?php
							$allowed_html_array = array('strong' => array(), 'a' => array('href' => array()));
							echo wp_kses( __('Copyright &copy; 2016 - Preston. All Rights Reserved. <br/> Powered by <a href="//apusthemes.com">ApusThemes</a>', 'preston'), $allowed_html_array);
						?>
					</div>
				</div>
			</div>
		
		<?php endif; ?>
		
	</footer><!-- .site-footer -->
	
	<?php if ( apustheme_get_config('back_to_top') ) { ?>
		<a href="#" id="back-to-top">
			<i class="fa fa-angle-up"></i>
		</a>
	<?php } ?>

</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>