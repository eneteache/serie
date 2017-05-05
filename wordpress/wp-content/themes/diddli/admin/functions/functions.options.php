<?php

add_action('init','of_options');
if (!function_exists('of_options')){
	function of_options(){	
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, __('Choose category:', 'masthemes'));    
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, __('Select one page:', 'masthemes'));       
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("12" => "12","16" => "16","20" => "20");
		$estch = array("1" => __("Cover + Category + Tittle", 'masthemes'),"2" => __("Cover + Tittle", 'masthemes'));
		$estsg = array("1" => __('Style 1', 'masthemes'),"2" => __('Style 2', 'masthemes'), "3" => __('Style 3', 'masthemes'));
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		if ( is_dir($alt_stylesheet_path) ) {
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
		            if(stristr($alt_stylesheet_file, ".css") !== false){
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}
		$bg_images_path = get_stylesheet_directory(). '/images/bg/';
		$bg_images_url = get_template_directory_uri().'/images/bg/';
		$bg_images = array();
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); 		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		global $of_options;
		$of_options = array();
		$of_options[] = array( 	
			"name" => __('General options', 'masthemes'),
			"type" => "heading",
			"icon" => ADMIN_IMAGES . "icon-slider.png"
		);
		$of_options[] = array( 	
			"name" => __('Language', 'masthemes'),
			"desc" => __('Insert your languages', 'masthemes'),
			"id" => "language_a",
			"std" => __('en_EN', 'masthemes'),
			"type" => "text"
		);
		$of_options[] = array( 	
			"name" => __('API TMDb', 'masthemes'),
			"desc" => __('Insert your API of themoviedb to start generating content.', 'masthemes'),
			"id" => "api_tmdb",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 	
			"name" => __('Language of extraction', 'masthemes'),
			"desc" => __('Thanks to TMDB you can create movies so fast in the language you need.', 'masthemes'),
			"id" => "lang_tmdb",
			"std" => "es",
			"type" => "text"
		);
		$of_options[] = array(
			"name" 		=> __('Favicon', 'masthemes'),
			"desc" 		=> __('Favicon for the website.', 'masthemes'),
			"id" 		=> "favicon_upload",
			"std" 		=> "",
			"mod"		=> "min",
			"type" 		=> "media"
		);
		$of_options[] = array(
			"name" =>  __('Slider', 'masthemes'),
			'desc' =>  __('Select a category to show in the slider.', 'masthemes'),
			'id' => 'sliderhome',
			'type' => 'select',
			'options' => $of_categories
		);	
		$of_options[] = array(
			"name" => " ",
			'desc' =>  __('Select the number of movies to show in the slider.', 'masthemes'),
			'id' => 'canthome',
			'type' => 'radio',
			'options' => $of_options_radio
		);		
		$of_options[] = array( 	
			"name" => __('Design', 'masthemes'),
			"type" => "heading",
			"icon" => ADMIN_IMAGES . "icon-paint.png"
		);
		$of_options[] = array(
			"name" =>  __('Home', 'masthemes'),
			'desc' =>  __('Select the type of design that was used to show movies in the home.', 'masthemes'),
			'id' => 'estlpi',
			'type' => 'select',
			'options' => $estch
		);
		$of_options[] = array(
			"name" => __('Categories and archives', 'masthemes'),
			'desc' =>  __('Select the type of design that was used to show movies in categories and archives.', 'masthemes'),
			'id' => 'estlpc',
			'type' => 'select',
			'options' => $estch
		);
		$of_options[] = array(
			"name" => __('Style post', 'masthemes'),
			'desc' =>  __('Select the type of design that will be used by default to show their post . (Within each post may define whether you want to use another , if not defined by selected will be used here)', 'masthemes'),
			'id' => 'estsin',
			'type' => 'select',
			'options' => $estsg
		);
		$of_options[] = array( 	
			"name" => __('Banner and Advertising', 'masthemes'),
			"type" => "heading",
			"icon" => ADMIN_IMAGES . "icon-docs.png"
		);
		$of_options[] = array( 	
			"name" => "243x243",
			"desc" => __('Banner', 'masthemes'),
			"id" => "banner_1",
			"std" => "",
			"type" => "textarea"
		);
		$of_options[] = array( 	
			"name" => "728x90",
			"desc" => __('Banner', 'masthemes'),
			"id" => "banner_2",
			"std" => "",
			"type" => "textarea"
		);
		$of_options[] = array( 	
			"name" => __('Random affiliate URL 1', 'masthemes'),
			"desc" => __('Place your affiliate url to be placed on the fake player.', 'masthemes'),
			"id" => "repro_1",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 	
			"name" => __('Random affiliate URL 2', 'masthemes'),
			"desc" => __('Place your affiliate url to be placed on the fake player.', 'masthemes'),
			"id" => "repro_2",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 	
			"name" => __('Random affiliate URL 3', 'masthemes'),
			"desc" => __('Place your affiliate url to be placed on the fake player.', 'masthemes'),
			"id" => "repro_3",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 	
			"name" => __('Random affiliate URL 4', 'masthemes'),
			"desc" => __('Place your affiliate url to be placed on the fake player.', 'masthemes'),
			"id" => "repro_4",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 	
			"name" => __('Name for fake player', 'masthemes'),
			"desc" => "Add the name for the fake player.",
			"id" => "name_fake",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 	
			"name" => __('Aditional code', 'masthemes'),
			"type" => "heading",
			"icon" => ADMIN_IMAGES . "icon-settings.png"
		);
		$of_options[] = array( 	
			"name" => __('Tracking Code', 'masthemes'),
			"desc" => __('Place your Google Analytics code or some code that deses show before closing head tag.', 'masthemes'),
			"id" => "google_analytics",
			"std" => "",
			"type" => "textarea"
		);	
		$of_options[] = array( 	
			"name" => __('Aditional CSS', 'masthemes'),
			"desc" => __('Add aditional CSS in your theme. this will add in the head.', 'masthemes'),
			"id" => "css_adicional",
			"std" => "",
			"type" => "textarea"
		);		
		$of_options[] = array( 	
			"name" => __('Backup Options', 'masthemes'),
			"type" => "heading",
			"icon" => ADMIN_IMAGES . "icon-backup.png"
		);
		$of_options[] = array( 
			"name" => __('Backup and Restore Options', 'masthemes'),
			"id" => "of_backup",
			"std" => "",
			"type" => "backup",
			"desc" => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'masthemes'),
		);
		$of_options[] = array( 	
			"name" 		=>  __('Transfer Theme Options Data', 'masthemes'),
			"id" 		=> "of_transfer",
			"std" 		=> "",
			"type" 		=> "transfer",
			"desc" 		=>  __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'masthemes'),
		);		
}}	
?>