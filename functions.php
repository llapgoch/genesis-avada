<?php
wp_deregister_script('jquery');

wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
wp_enqueue_script('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array(
	'jquery'
));

wp_enqueue_style('jquerycss', dirname(get_stylesheet_uri()) . "/jquery-ui-1.10.3.custom.min.css");