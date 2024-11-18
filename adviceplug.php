<?php

/*
Plugin Name: Wisdom Plug
Plugin URI: https://github.com/MicahelE/Wisdom-Plug
Description: Give insightful proverbs and wise sayings.
Author: Michael Etokakpan
License: GPLv2 or later
Version: 1.0
Author URI: http://michaeltech.xyz
*/

function get_advice() {
    $url = 'https://api.adviceslip.com/advice';
   $response = wp_remote_get($url);
   $responseObject = json_decode($response["body"]); 

//    var_dump($response["body"]);
$text= $responseObject->slip->advice;
// $text= esc_html($text);
printf(
		'<p id="advice"> %s </p>',
		esc_html($text)
	);
}
// it is called with the admin_notices function

add_action( 'admin_notices', 'get_advice' );
// style it properly
function advice_css() {
	echo "
	<style type='text/css'>
	#advice {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	
	.block-editor-page #advice {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#advice {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'advice_css' );