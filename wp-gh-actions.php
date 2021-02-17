<?php
/*
Plugin Name: Deploy to GitHub Actions
Description: A plugin to push updates from WordPress CMS to a headless Frontend via GitHub Actions
Author: Christina Hastenrath
Author URI: https://github.com/ch264
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Version: 1.0
*/
add_action('admin_menu', 'test_plugin_setup_menu');
 
function test_plugin_setup_menu(){
        add_menu_page( 'Deploy Plugin Page', 'Deploy to GH Actions', 'manage_options', 'deploy-plugin', 'test_init' );
}
 
function test_init(){
?>
	<h1>Run GitHub Actions to deploy your Frontend</h1>

	<h2>Publish to Beta Branch</h2>
	<form method="post">
		<input type="submit" class="button" name="button1" value="Beta"/>
	</form>

	<h2>Publish to Production Branch</h2>
	<form method="post">
		<input type="submit" class="button" name="button2" value="Production"/>
	</form>
	<h3>You can check the GitHub Action status in your repo here <span><a href="https://github.com/<user name>/<repo>/actions">Github Actions</a></span></h3>

<?php
}

if(isset($_POST['button1'])) {
	$title=".......................................The Beta Site GitHub Action is now running and your Beta Branch should be updated soon"; 
	?><h2><?php echo $title; ?></h2><?php

	$endpoint = 'https://api.github.com/repos/<username>/<repo>/dispatches';

	$body = [
		'event_type' => 're-deploy',
	];

	$body = wp_json_encode( $body );

	$options = [
		'body'		=> $body,
		'headers'	=> [
			'Content-Type' => 'application/json',
			'Accept' => 'application/vnd.github.everest-preview+json',
			'Authorization' => 'Bearer <your Bearer Token>'
		],
		'httpversion' => '1.0',
        	'sslverify' => false,
		'data_format' => 'body',
	];
	
	wp_remote_post( $endpoint, $options );
}

if(isset($_POST['button2'])) {
	$title=".......................................The Production Site GitHub Action is now running and your Production Branch should be updated soon"; 
	?><h2><?php echo $title; ?></h2><?php

	$endpoint = 'https://api.github.com/repos/<username>/<repo>/dispatches';

	$body = [
					'event_type' => 're-prod-deploy',
	];

	$body = wp_json_encode( $body );

	$options = [
					'body'          => $body,
					'headers'       => [
									'Content-Type' => 'application/json',
									'Accept' => 'application/vnd.github.everest-preview+json',
									'Authorization' => 'Bearer <your Bearer Token>'
					],
					'httpversion' => '1.0',
					'sslverify' => false,
					'data_format' => 'body',
	];
  
	wp_remote_post( $endpoint, $options );
}

?>
