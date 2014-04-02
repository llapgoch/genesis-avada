<?php

add_action('wp', 'avada_child_setup');
add_filter('avada_after_header', 'header_messages');

function avada_child_setup(){
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
	wp_enqueue_script('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array(
		'jquery'
	));

	wp_enqueue_style('jquerycss', dirname(get_stylesheet_uri()) . "/jquery-ui-1.10.3.custom.min.css");

	add_filter('wp_nav_menu_items','extra_nav_menu_items', 10, 2);
	add_action("login_head", "login_head");
}
function extra_nav_menu_items( $items, $args ) {

	if(isset($args->menu) && $args->menu == '' && is_user_logged_in()){
		
		$items .= '<li id="menu-item-logout" class="menu-item menu-item-logout"><a href="'.wp_logout_url('/').'">'.__('Logout').'</a></li>';
	}
	return $items;
}

function login_head(){
	wp_enqueue_style("admin-login", dirname(get_stylesheet_uri()). "/style.css");
}

function header_messages(){
	// Get survey messages
	$surveyMessage = do_shortcode('[survey_completion_message]');
	
	if(!$surveyMessage || $surveyMessage == '[survey_completion_message]'){
		return '';
	}
	
	return "<div class='alert notice header-notice'>
				<div class='msg'>" . $surveyMessage . "</div>
			</div>";
	
}