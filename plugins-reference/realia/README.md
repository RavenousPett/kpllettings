# Realia

Realia is full featured WordPress real estate plugin. It is completely covering needs of real estate agencies or portals. Plugin allows you to manage all your properties, agents and agencies.

* Official website at [wprealia.com](http://wprealia.com)
* Check the demo at [preview.wprealia.com/plugin/realia](http://preview.wprealia.com/plugin/realia)
* Documentation at [wprealia.com/documentation/index.html](http://wprealia.com/documentation/index.html)
* Free Bootstrap theme at [preview.wprealia.com/theme/bootstrap](http://preview.wprealia.com/theme/bootstrap) download from [GitHub](http://github.com/pragmaticmates/realia-bootstrap)
* Premium themes [Megareal](http://themeforest.net/item/megareal-real-estate-portal-theme/full_screen_preview/11965035?ref=aviators), [Realocation](http://themeforest.net/item/realocation-modern-real-estate-wordpress-theme/7605274?ref=aviators), [Realia](http://themeforest.net/item/realia-responsive-real-estate-wordpress-theme/4789838?ref=aviators)
* Mobile applications [Realia Browser for iOS](http://codecanyon.net/item/realia-browser-real-estate-ios-app/11827488)

### Front End Submission

Realia allows to add properties by your users. Create the property directory by few clicks. If you want you can review newly added properties before publishing. Of course it is possible to charge users for using your website. Plugins has builtin pay per post and package system.

### Property management

Manage properties from WordPress admin. Custom version of table display is containing all important information about properties like featured image, price and assigned taxonomy terms.

### WP REST API integration

Plugin offers option to search for properties via API. Plugin adds options to filter properties by custom fields. Realia extends default API output by new fields as well. Check an API request at [wprealia.com](http://preview.wprealia.com/plugin/realia/wp-json/posts?type=property&filter-beds=3) to see how easy is to filter by custom fields. It is possible to filter by same fields as plugin uses in front end widgets. So there are available more than 20+ fields.

### Price Formatting Options

Realia supports various price formatting options. You can define the currency where you are able to set currency sign and number formatting options like number of decimal places, decimal point and thousands separator.

For properties you can set another group of price settings. You are able to write alphanumeric text instead of price amount or add your custom prefix and suffix.

Are you developer and still not satisfied with price formatting? Don't worry. Everything is located in one method so it is pretty easy to change the functionality.

### Agencies & Agents

With Realia plugin you are able to assign agents to properties and create agencies grouping agents. Great for internal purposes or directory listings.

### Features

* Front end submission system
* Pay per post
* Package system
* Review before submission
* Pay for featured or sticky property
* Google map support
* Received transactions
* Advanced price formatting
* Agent contact form on property detail
* Custom measurement
* Plays nicely with Twenty Fifteen
* Easy for developers
* All settings are in customizer
* OOP architecture
* row/grid version of property archive
* reCAPTCHA support for enquire form
* Terms and conditions link from registration form

### Custom post types

* Property
* Agent
* Agency
* Package

### Custom taxonomies

* Locations
* Property types
* Statuses
* Amenities
* Materials

## Changelog

**1.3.0**

*Release Date - 23th April 2017*

* support for WP REST API v2
* new WP filter: realia_filter_params
* HTML5 validation of number inputs
* SSL user authentication fix
* post author permission in submission fix

**1.2.1**

*Release Date - 27th January 2017*

* only published subproperties are shown in parent listing detail

**1.2.0**

*Release Date - 17th January 2017*

* year built field in the frontend submission
* floor plans and video URL property fields in the WP admin
* WP filter realia_contract_options
* refactored property detail page using section template parts
* link to parent property in child property detail page
* pending properties count in WP admin menu
* transparent marker in single property map
* Realia_Post_Types::render_property_detail_sections() helper function
* Realia_Post_Types::is_featured_property() helper function
* Realia_Post_Types::is_reduced_property() helper function
* Realia_Post_Types::is_sticky_property() helper function
* Realia_Post_Types::is_child_property() helper function
* New WP filter: realia_property_detail_sections
* New WP filter: realia_before_property_detail
* New WP filter: realia_after_property_detail
* New WP filter: realia_before_property_detail_<section>
* New WP filter: realia_after_property_detail_<section>
* rebuilded .pot catalog

**1.1.0**

*Release Date - 17th October 2016*

* Open Graph support

**1.0.1**

*Release Date - 10th October 2016*

* property removal user confirmation
* fixed price currency
* fixed hiding property title filter field

**1.0.0**

*Release Date - 08th October 2016*

* option to set chained location filter field
* rebuilded .pot catalog
* realia_social_networks WP filter
* social networks in agent and agency profile
* fixed beds field in rent/sale filter
* option to pick random properties in widget
* Realia_Utilities::format_number() helper
* HTML5 validation of home area, lot area, price and year built filter fields
* more agent properties in property detail
* option to search properties by its title
* fixed notice index error
* option to link package with pricing table
* option to select by TOP attribute in the properties widget
* floor plans, video URL and valuation fields in the frontend submission

**0.9.3**

*Release Date - 01th August 2016*

* fixes of PHP notices

**0.9.2**

*Release Date - 26th July 2016*

* sanitized, validated and escaped values
* fixed loading Google Maps API twice at frontend
* fixed missing Google Maps API in backend
* subproperties are not shown in google map nor property archive / widget
* fixed ignored Grid size for Google map widget

**0.9.1**

*Release Date - 07th July 2016*

* escaped values from property filter

**0.9.0**

*Release Date - 04th July 2016*

* property title is required attribute
* support for multiple recaptchas on single page
* property area fix
* default map location changed from UK to whole world
* enquire form preserves values of inputs
* fixed white screen after property submission if my properties page is not set
* show pending listings visible to author
* enquire form email for admin fix
* support for custom Google Browser API key

**0.8.9**

*Release Date - 15th June 2016*

* agent contact form email fix
* new TGMPA plugin version
* fixed package info warning message

**0.8.8**

*Release Date - 5th June 2016*

* MapEscape fix
* new user registration notification

**0.8.7**

*Release Date - 30th May, 2016*

* lot area in Google marker infowindow
* fixed baths number in Google Map infowindow
* .pot file

**0.8.6**

*Release Date - 25th April, 2016*

* fixed enquire form which didn't send emails to property agent
* public facilites in the submission fields
* user phone field
* first name, last name, phone in registration form
* fixed missing some translation strings
* video in property detail
* phone in enquire form
* Google sensor warning fix
* improved Google map on mobile devices

**0.8.5**

*Release Date - 26th August, 2015*

* refactored admin menu
* admin notice
* new Realia admin icons
* updated TGM
* terms and conditions order register form fix
* agent email fix
* 3 new map styles
* shortcodes fix
* updated translation catalogue

**0.8.4**

*Release Date - 19th August, 2015*

* user registration fix
* property map geolocation support
* agent email fix

**0.8.3**

*Release Date - 30th July, 2015*

* agency backend fix

**0.8.2**

*Release Date - 21th July, 2015*

* after register custom redirect
* template adjustments
* template loader fix
* button naming convention

**0.8.1**

*Release Date - 13th July, 2015*

* forms template structure


**0.8.0**

*Release Date - 9th July, 2015*

* default display type for agents and properties widgets
* property row image size
* multiple tabs on one page fix
* latitude and longitude fields for map revealed
* breadcrumb fix
* template structure adjustments
* other minor tweaks and fixes


**0.7.0**

*Release Date - 27th June, 2015*

* wire transfer
* removed PayPal library
* added better paginations
* template loader fix
* property map position in detail
* minor CSS fixes

**0.6.0**

*Release Date - 24th June, 2015*

* user can be registered as agent
* breadcrumb update
* slovak translation
* agents and agencies admin table update
* custom public facilities and valuations
* property can have more assigned agents
* refactored property fields with 'attributes_' prefix
* realia_change_password, realia_change_profile, realia_change_agent_profile shortcodes
* some fixes

**0.5.0**

*Release Date - 16th June, 2015*

* WP API for agents
* WP API for agencies
* Added Rent/Sale search widget
* All search fields are orderable
* Added multiple search fields
* Refactored agents, agencies and properties templates
* Agent custom post type admin columns
* Location taxonomies are now hierarchical
* Breadcrumb now has better structure
* Other small improvements and fixes

**0.4.0**

*Release Date - 3nd June, 2015*

* WP API properties filter functionality
* PayPal libraries are loading after filling credentials
* Added material search filter
* Property sorting
* New archive pages actions
* CMB2 moved to TGM
* PayPal library cleanup

**0.3.0**

*Release Date - 2nd June, 2015*

* Added amenities, status, contract, rooms filters
* Options to select property layout in "Properties" widget
* Read more text for property boxes
* Call Realia_Template_Loader:locate() with plugin param
* New CMB2 version
* Templates cleanup
* Updated translation catalogue

**0.2.0**

*Release Date - 29th May, 2015*

* Material
* Rooms
* Home area & Lot size (dimensions + area)

**0.1.0**

*Release Date - 22th May, 2015*

* initial release
