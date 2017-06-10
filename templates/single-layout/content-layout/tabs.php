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
			<a href="#tab-content-floor-plan" data-toggle="tab">
                <?php echo esc_html__( 'Floor plan', 'preston' ); ?>
            </a>
        </li>
        <li>
			<a href="#tab-content-epc" data-toggle="tab">
                <?php echo esc_html__( 'EPC', 'preston' ); ?>
            </a>
        </li>
        <li>
			<a href="#tab-content-key-features" data-toggle="tab">
                <?php echo esc_html__( 'Key features', 'preston' ); ?>
            </a>
        </li>
	</ul>
	<div class="tab-content tab-content-descrip">
		<div id="tab-content-description" class="tab-pane active">
			<!-- Description -->
			<?php echo Realia_Template_Loader::load('single/description'); ?>
		</div>
        <div id="tab-content-floor-plan" class="tab-pane">
			<!-- Floor plan -->
            <?php echo Realia_Template_Loader::load('single/floor'); ?>
		</div>
        <div id="tab-content-epc" class="tab-pane">
            <!-- EPC -->
            <?php echo Realia_Template_Loader::load('single/epc'); ?>
        </div>
		<div id="tab-content-key-features" class="tab-pane">
			<!-- Key features -->
			<?php echo Realia_Template_Loader::load('single/key-features'); ?>
		</div>
	</div>
</div>
