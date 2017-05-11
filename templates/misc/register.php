<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( get_option( 'users_can_register' ) ) : ?>
	<form method="post" action="<?php the_permalink(); ?>" class="register-form">
		<div class="form-group">
			<label for="register-form-name"><?php echo esc_html__( 'Username', 'preston' ); ?></label>
			<input id="register-form-name" type="text" name="name" class="form-control" required="required">
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-email"><?php echo esc_html__( 'E-mail', 'preston' ); ?></label>
			<input id="register-form-email" type="email" name="email" class="form-control" required="required">
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-first-name"><?php echo esc_html__( 'First name', 'preston' ); ?></label>
			<input id="register-form-first-name" type="text" name="first_name" class="form-control">
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-last-name"><?php echo esc_html__( 'Last name', 'preston' ); ?></label>
			<input id="register-form-last-name" type="text" name="last_name" class="form-control">
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-phone"><?php echo esc_html__( 'Phone', 'preston' ); ?></label>
			<input id="register-form-phone" type="text" name="phone" class="form-control">
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-password"><?php echo esc_html__( 'Password', 'preston' ); ?></label>
			<input id="register-form-password" type="password" name="password" class="form-control" required="required">
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-retype"><?php echo esc_html__( 'Retype Password', 'preston' ); ?></label>
			<input id="register-form-retype" type="password" name="password_retype" class="form-control" required="required">
		</div><!-- /.form-group -->

		<?php $terms = get_theme_mod( 'realia_submission_terms' ); ?>

		<?php if ( ! empty( $terms ) ) : ?>
			<div class="checkbox terms-conditions-input">
				<input id="register-form-conditions" type="checkbox" name="agree_terms">

				<label for="register-form-conditions">
					<?php echo sprintf( __( 'I agree with <a href="%s">terms & conditions</a>', 'preston' ), get_permalink( $terms ) ); ?>
				</label>
			</div><!-- /.form-group -->
		<?php endif; ?>
		<div class="space-top-20">
			<button type="submit" class="button btn btn-theme" name="register_form"><?php echo esc_html__( 'Sign Up', 'preston' ); ?></button>
		</div>
	</form>
<?php else: ?>
	<div class="alert alert-warning">
		<?php echo esc_html__( 'Registrations are not allowed.', 'preston' ); ?>
	</div><!-- /.alert -->
<?php endif; ?>
