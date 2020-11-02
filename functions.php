<?php

defined("ABSPATH") || exit();

function load_scripts_styles() {
	// Styles
	$parent_style = 'parent-style';
	wp_enqueue_style( $parent_style , get_stylesheet_directory_uri() . '/css/child-styles.css');
	wp_enqueue_style( 'toastnotify', get_stylesheet_directory_uri() . '/css/toastnotify.min.css', array( $parent_style ));
	wp_enqueue_style( $parent_style, get_stylesheet_directory_uri() . '/style.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );
	// Scripts
	wp_enqueue_script(
		'toastnotify',
		get_stylesheet_directory_uri() . '/js/toastnotify.min.js',
		array( 'jquery' )
	);
	wp_enqueue_script( 'script-name', get_stylesheet_directory_uri() . '/js/child-scripts.js', array('jquery'), '1.0.2', true );
	wp_localize_script( 'script-name', 'MyAjax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce( 'my-special-string' )
	));
}
add_action( 'wp_enqueue_scripts', 'load_scripts_styles');



function post_like_table_create() {
	global $wpdb;
	$table_name = $wpdb->prefix. "post_like_table";
	global $charset_collate;
	$charset_collate = $wpdb->get_charset_collate();
	global $db_version;

	if( $wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name)
	{ $create_sql = "CREATE TABLE " . $table_name . " (
	id INT(11) NOT NULL auto_increment,
	postid INT(11) NOT NULL ,
	userid VARCHAR(40) NOT NULL ,

	PRIMARY KEY (id))$charset_collate;";
		require_once(ABSPATH . "wp-admin/includes/upgrade.php");
		dbDelta( $create_sql );
	}


//register the new table with the wpdb object
	if (!isset($wpdb->post_like_table))
	{
		$wpdb->post_like_table = $table_name;
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
	}

}
add_action( 'init', 'post_like_table_create');



function get_client_ip() {
	$ip=$_SERVER['REMOTE_ADDR'];
	return $ip;
}

function my_action_callback() {
	check_ajax_referer( 'my-special-string', 'security' );
	$postid = intval( $_POST['postid'] );
	$user_id=get_current_user_id();
	$is_loggedin = 0;
	$liked = 0;
	global $wpdb;

	//calculate like count from db.
	if ($user_id === 0) {
		echo 0;
		die();
	}

	$row1 = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid' AND userid = '$user_id'");
	if ( empty($row1)){
		$wpdb->insert( $wpdb->post_like_table, array( 'postid' => $postid, 'userid' => $user_id ), array( '%d', '%s' ) );
		$liked = 1;
	}else{
		$wpdb->delete( $wpdb->post_like_table, array( 'postid' => $postid, 'userid'=> $user_id ), array( '%d','%s' ) );
		$liked = 0;
	}



	$totalrow1 = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid'");
	$total_like=$wpdb->num_rows;

	update_post_meta( $postid, 'likes_count', $total_like , '' );


	$data=array( 'postid'=>$postid,'likecount'=>$total_like,'userid'=>$user_id, 'is_loggedin'=> $is_loggedin, 'is_liked'=> $liked);
	echo json_encode($data);
	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_my_action', 'my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );



// fix paginate in custom taxonomy //
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
	add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page() {
	global $option_posts_per_page;
	if ( is_tax( 'zcategory') ) {
		return 1;
	} else {
		return $option_posts_per_page;
	}
}
// fix paginate in custom taxonomy //


function secureLink($url , $post , $str){
	$input = get_post_meta($post->ID, $str, true);
	$is_url = filter_var($url, FILTER_VALIDATE_URL);
	if ($url !== '' && $is_url ){
		$url = esc_url( $url, null, 'display' );
		$url = trim($url, '/');
		if (!preg_match('#^http(s)?://#', $url)) {
			$input = 'http://' . $url;
		}
		$urlParts = parse_url($input);
		$domain = preg_replace('/^www\./', '', $urlParts['host']);
		return $domain;
	}else{
		return 0;
	}
}


// Remove p tags from category description
remove_filter('the_content','wpautop');

// Show Planets List Short code
add_shortcode('show_planet_list', 'planet_list');
function planet_list($attr , $content = null){
	require_once( get_template_directory() . '/../woodmart-child/includes/planets_list.php' );
}

// custom sidebar
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Planet sidebar', // نام سایدبار
		'id' => 'planet-sidebar', // آیدی سایدبار را در اینجا تعیین کنید
		'description' => 'Planet category sidebar', // توضیحی در مورد این سایدبار
		'before_widget' => '<div class="widget">', // کد قبل از هر منو
		'after_widget' => '</div>', // کد بعد از هر منو
		'before_title' => '<h2 class="widget-title">', // قبل از عنوان منو
		'after_title' => '</h2>', // بعد از عنوان منو
	));
}

/*
 * Replace 'textdomain' with your plugin's textdomain. e.g. 'woocommerce'.
 * File to be named, for example, yourtranslationfile-en_GB.mo
 * File to be placed, for example, wp-content/lanaguages/textdomain/yourtranslationfile-en_GB.mo
 */
add_filter( 'load_textdomain_mofile', 'load_custom_plugin_translation_file', 10, 2 );
function load_custom_plugin_translation_file( $mofile, $domain ) {
	if ( 'textdomain' === $domain ) {
		$mofile = WP_LANG_DIR . '/woocommerce/woocommerce-fa_IR-' . get_locale() . '.mo';
	}
	return $mofile;
}




//////////////// for eeeico ///////////
function encrypt_decrypt($action, $string) {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key = 'H+MbQeThWmYq3t6w9z$C&F)J@NcRfUjXn2r5u7x!A%D*G-KaPdSgVkYp3s6v9y/B';
	$secret_iv = 'RfUjXn2r5u8x/A?D(G-KaPdSgVkYp3s6v9y$B&E)H@MbQeThWmZq4t7w!z%C*F-J';
	$key = hash('sha256', $secret_key);
	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}

add_action( 'wp_login', 'login_cookie' , 10 , 2);
function login_cookie($login) {
	$user = get_userdatabylogin($login);
	$id = $user->ID;
	$encrypted_id = encrypt_decrypt('encrypt', $id);
	$user = get_userdata( $id );
	$user_roles = $user->roles;
	$encrypted_role = encrypt_decrypt('encrypt', $user_roles[0]);


	$info = array(
		'userId' => $encrypted_id,
		'userRole' => $encrypted_role
	);

	setcookie("wordpress_8L25432ACC2D4A404E635266556A58CC", serialize($info), time()+14400 , '/', '' , false , false );  /* expire in 3 hours */
}

add_action( 'wp_logout', 'logout_cookie' , 15 , 1);
function logout_cookie() {
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time()-1000);
			setcookie($name, '', time()-1000, '/');
		}
	}
}

add_filter( 'allowed_redirect_hosts', function(){
	$hosts[] = 'http://192.168.30.99/auth/public/admin/dashboard/';
	return $hosts;
});

add_role( 'buyer', 'Buyer' , array(
	'read' => true, // true allows this capability
	'edit_posts' => true, // Allows user to edit their own posts
	'edit_pages' => true, // Allows user to edit pages
	'edit_others_posts' => true, // Allows user to edit others posts not just their own
	'create_posts' => true, // Allows user to create new posts
	'manage_categories' => true, // Allows user to manage post categories
	'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode'edit_themes' => false, // false denies this capability. User can’t edit your theme
	'edit_files' => true,
	'edit_theme_options'=>true,
	'manage_options'=>true,
	'moderate_comments'=>true,
	'manage_categories'=>true,
	'manage_links'=>true,
	'edit_others_posts'=>true,
	'edit_pages'=>true,
	'edit_others_pages'=>true,
	'edit_published_pages'=>true,
	'publish_pages'=>true,
	'delete_pages'=>true,
	'delete_others_pages'=>true,
	'delete_published_pages'=>true,
	'delete_others_posts'=>true,
	'delete_private_posts'=>true,
	'edit_private_posts'=>true,
	'read_private_posts'=>true,
	'delete_private_pages'=>true,
	'edit_private_pages'=>true,
	'read_private_pages'=>true,
	'unfiltered_html'=>true,
	'edit_published_posts'=>true,
	'upload_files'=>true,
	'publish_posts'=>true,
	'delete_published_posts'=>true,
	'delete_posts'=>true,
	'install_plugins' => false, // User cant add new plugins
	'update_plugin' => false, // User can’t update any plugins
	'update_core' => false // user cant perform core updates
) );


// function wporg_simple_role_caps() {
//     $role = get_role( 'buyer' );
//     $role->add_cap( 'edit_posts', true );
// }
// add_action( 'init', 'wporg_simple_role_caps', 11 );

//////////////// for eeeico ///////////




?>
