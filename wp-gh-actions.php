<?php
/*
Plugin Name: Deploy plugin
Description: A deploy plugin to rerun github actions
Author: Christina Hastenrath
Version: 1.0
*/
add_action('admin_menu', 'test_plugin_setup_menu');
 
function test_plugin_setup_menu(){
        add_menu_page( 'Deploy Plugin Page', 'Deploy Plugin', 'manage_options', 'deploy-plugin', 'test_init' );
}
 
function test_init(){
?>
	<h1>ReRun the Blog</h1>
	<h2>Publish to Beta</h2>
	<form method="post">
		<input type="submit" class="button" name="button1" value="Beta"/>
	</form>

	<h2>Publish to Production</h2>
	<form method="post">
		<input type="submit" class="button" name="button2" value="Production"/>
	</form>
	<p>You can check the status of the publishing here <span><a href="https://github.com/<user name>/<repo>/actions">Github Actions</a></span></p>

<?php
}

if(isset($_POST['button1'])) {
	echo "............................................The Beta Site is now rerunning and should be updated within a few minutes";
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
	echo "............................................The Production Site is now rerunning and should     be updated within a few minutes";
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
