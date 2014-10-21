<?php

add_action('wp', 'avada_child_setup');
add_filter('avada_after_header', 'header_messages');

add_action('tml_template', 'adapt_tml_filter_paths', 10, 3);
add_filter('hide-header-notice', 'avada_check_hide_header_notice');
add_action('login_enqueue_scripts', 'avada_enqueue_login_scripts');
add_action( 'admin_enqueue_scripts', 'load_admin_style' );


// Remove the styling of the login page which theme-my-login adds by default

if(class_exists('Theme_My_Login')){
remove_filter('site_url', array(Theme_My_Login::get_object(), 'site_url'), 10);
}

function avada_child_setup(){
	//wp_deregister_script('jquery');

	wp_enqueue_script('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array(
		'jquery'
	));

	wp_enqueue_style('jquerycss', dirname(get_stylesheet_uri()) . "/jquery-ui-1.10.3.custom.min.css");

	add_filter('wp_nav_menu_items','extra_nav_menu_items', 10, 2);
}

function avada_enqueue_login_scripts(){
    ?>
    <link rel="stylesheet" href='<?php echo get_stylesheet_uri();?>' media='all' />
    <?php
}

function load_admin_style() {
    wp_enqueue_style( 'admin_css', get_stylesheet_directory_uri() . '/admin-style.css', false, '1.0.0' );
}

function avada_check_hide_header_notice(){
    $parts = parse_url($_SERVER['REQUEST_URI']);
    $page = trim($parts['path'], '/');

    if($page == 'your-profile'){
        return true;
    }
}

// Use the profile form in our theme rather than this one (in TML)
function adapt_tml_filter_paths($path, $locations){
    if(in_array('profile-form.php', $locations)){
        return get_stylesheet_directory() . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "profile-form.php";
    }
}

function extra_nav_menu_items( $items, $args ) {

	if(isset($args->menu) && $args->menu == '' && is_user_logged_in()){
		
		$items .= '<li id="menu-item-logout" class="menu-item menu-item-logout"><a href="'.wp_logout_url('/').'">'.__('Logout').'</a></li>';
	}
	return $items;
}
	


function header_messages(){
	// Get survey messages
	$surveyMessage = do_shortcode('[survey_completion_message]');
	
	if(!$surveyMessage || $surveyMessage == '[survey_completion_message]'){
		return '';
	}
	
	return "<div class='fusion-alert alert notice alert-warning alert-shadow header-notice'>
				<div class='msg'>" . $surveyMessage . "</div>
			</div>";
	
}