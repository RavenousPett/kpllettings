<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="tabs-content-layout">
	<ul class="nav nav-tabs nav-table">
		<li class="active">
			<a href="#tab-content-description" data-toggle="tab">
                <?php echo esc_html__( 'Description', 'preston' ); ?>
            </a>
        </li>
		<li>
			<a href="#tab-content-detail" data-toggle="tab">
                <?php echo esc_html__( 'Detail', 'preston' ); ?>
            </a>
        </li>
        <li>
			<a href="#tab-content-amenities" data-toggle="tab">
                <?php echo esc_html__( 'Amenities', 'preston' ); ?>
            </a>
        </li>
        <li>
			<a href="#tab-content-video" data-toggle="tab">
                <?php echo esc_html__( 'Video', 'preston' ); ?>
            </a>
        </li>
        <li>
			<a href="#tab-content-valuation" data-toggle="tab">
                <?php echo esc_html__( 'Valuation', 'preston' ); ?>
            </a>
        </li>
        <li>
			<a href="#tab-content-facilities" data-toggle="tab">
                <?php echo esc_html__( 'Facilities', 'preston' ); ?>
            </a>
        </li>
	</ul>
	<div class="tab-content tab-content-descrip">
		<div id="tab-content-description" class="tab-pane active">
			<!-- Description -->
			<?php echo Realia_Template_Loader::load('single/description'); ?>
		</div>
		<div id="tab-content-detail" class="tab-pane">
			<!-- Overview | Detail -->
			<?php echo Realia_Template_Loader::load('single/overview'); ?>
		</div>
		<div id="tab-content-video" class="tab-pane">
			<!-- Overview | Detail -->
			<?php echo Realia_Template_Loader::load('single/video'); ?>
		</div>
		<div id="tab-content-valuation" class="tab-pane">
			<!-- Overview | Detail -->
			<?php echo Realia_Template_Loader::load('single/valuation'); ?>
		</div>
		<div id="tab-content-facilities" class="tab-pane">
			<!-- Overview | Detail -->
			<?php echo Realia_Template_Loader::load('single/facilities'); ?>
		</div>
	</div>
</div>