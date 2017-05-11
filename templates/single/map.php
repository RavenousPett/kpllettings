<!-- MAP LOCATION -->
<?php $map_location = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'map_location', true ); ?>

<?php if ( ! empty( $map_location ) && 2 == count( $map_location ) ) : ?>
    <!-- MAP -->
    <?php $price = Realia_Price::get_property_price(); ?>
	
    <div class="property-map-position">
        <ul class="nav nav-tabs pull-right fill-map" role="tablist">
            <li class="active" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Map View', 'preston'); ?>">
                <a class="tab-google-map" aria-expanded="false" href="#tab-google-map" role="tab" data-toggle="tab"><i class="fa fa-map"></i></a>
            </li>
            <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Street View', 'preston'); ?>">
                <a class="tab-google-street-view-map" aria-expanded="false" href="#tab-google-street-view-map" role="tab" data-toggle="tab"><i class="fa fa-street-view"></i></a>
            </li>
        </ul>
        <div class="tab-content" >
            <div id="tab-google-map" class="tab-pane fade out active in single-property-map-wrap">
                <div id="single-property-map"
                     data-latitude="<?php echo esc_attr( $map_location['latitude'] ); ?>"
                     data-longitude="<?php echo esc_attr( $map_location['longitude'] ); ?>"
                     data-zoom="15">
                </div><!-- /.map -->
                <div id="property-search-places">
                    <div class="places-wrap">
                        <div class="place-container">
                            <div class="place-btn" data-type="transportations" data-icon="<?php echo get_template_directory_uri(); ?>/images/map/transportation.png">
                                <i class="fa fa-subway" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Transportation', 'preston');?></span>
                            </div>
                            <div class="place-btn" data-type="supermarkets" data-icon="<?php echo get_template_directory_uri(); ?>/images/map/supermarket.png">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Supermarket', 'preston');?></span>
                            </div>
                            <div class="place-btn" data-type="schools" data-icon="<?php echo get_template_directory_uri(); ?>/images/map/school.png">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Schools', 'preston');?></span>
                            </div>
                            <div class="place-btn" data-type="libraries" data-icon="<?php echo get_template_directory_uri(); ?>/images/map/libraries.png">
                                <i class="fa fa-bank" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Library', 'preston');?></span>
                            </div>
                            <div class="place-btn" data-type="pharmacies" data-icon="<?php echo get_template_directory_uri(); ?>/images/map/pharmacy.png">
                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Pharmacy', 'preston');?></span>
                            </div>
                            <div class="place-btn" data-type="hospitals" data-icon="<?php echo get_template_directory_uri(); ?>/images/map/hospital.png">
                                <i class="fa fa-hospital-o" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Hospital', 'preston');?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-google-street-view-map" class="tab-pane fade out">
                <div id="single-property-street-view-map" style="height: 400px"></div>
            </div>
        </div>
    </div><!-- /.map-position -->
<?php endif; ?>