<?php

$atts  = array_merge( array(
	'columns'	=> 4,
	'layout_type' => 'grid',
	'style' => '',
), $atts);
extract( $atts );

$bcol = 12/$columns;
if ($columns == 5) {
	$bcol = 'cus-5';
}
if ( !empty($testimonials) && is_array($testimonials) ):
?>
	<div class="widget widget-testimonials <?php echo esc_attr($style); ?>">
	    <div class="widget-content">
    		<?php if ( $layout_type == 'carousel' ): ?>
    			<div class="owl-carousel products" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-pagination="true" data-nav="false" data-extrasmall="1">
		    		<?php foreach ($testimonials as $testimonial) { ?>
		    			
				        <div class="testimonials-body">
					   		<div class="description"><?php echo trim($testimonial->content); ?></div>
				         	<div class="testimonial-meta ">
					         	<div class="testimonial-avatar ">
						            <?php if (isset($testimonial->image) && $testimonial->image): ?>
										<?php $img = wp_get_attachment_image_src($testimonial->image, 'full'); ?>
										<?php if ( isset($img[0]) ) { ?>
											<?php apustheme_display_image($img); ?>
										<?php } ?>
									<?php endif; ?>
					         	</div>
				         	 	<div class="info">
					               	<h3 class="name-client"> <?php echo trim($testimonial->name); ?></h3>
					               	<span class="job"><?php echo trim($testimonial->job); ?></span>   
					            </div>

				         	</div>
						</div>

		    		<?php } ?>
	    		</div>
	    	<?php else: ?>
	    		<div class="row">
		    		<?php foreach ($testimonials as $testimonial) { ?>
		    			<div class="col-md-<?php echo esc_attr($bcol); ?>">
	                		<div class="testimonials-body">
						   		<div class="description"><?php echo trim($testimonial->content); ?></div>
					         	<div class="testimonial-meta ">
						         	<div class="testimonial-avatar ">
							            <?php if (isset($testimonial->image) && $testimonial->image): ?>
											<?php $img = wp_get_attachment_image_src($testimonial->image, 'full'); ?>
											<?php if ( isset($img[0]) ) { ?>
												<?php apustheme_display_image($img); ?>
											<?php } ?>
										<?php endif; ?>
						         	</div>
						         	<div class="info">
						               	<h3 class="name-client"> <?php echo trim($testimonial->name); ?></h3>
						               	<span class="job"><?php echo trim($testimonial->job); ?></span>   
						            </div>
					         	</div>
							</div>
				        </div>
		    		<?php } ?>
	    		</div>
	    	<?php endif; ?>
	    </div>
	</div>
<?php endif; ?>