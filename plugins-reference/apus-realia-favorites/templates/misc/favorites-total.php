<div class="realia-favorites-total">
    <?php $favorite_users = ApusRealiaFavorites_Favorites::get_post_total_users( get_the_ID() ); ?>
    <?php $icon = $favorite_users <= 0 ? 'fa-heart-o' : 'fa-heart'; ?>
    <i class="fa <?php echo esc_attr($icon); ?>"></i>
    <?php echo sprintf( _n( '<strong>%d</strong> person loves it', '<strong>%d</strong> people love it', $favorite_users, 'apus-realia-favorites' ), $favorite_users ); ?>
</div>