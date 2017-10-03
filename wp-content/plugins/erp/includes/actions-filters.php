<?php

/** Actions *******************************************************************/

// process erp actions on admin_init
add_action( 'admin_init', 'erp_process_actions' );
add_action( 'admin_footer', 'erp_import_export_javascript' ); 
add_action( 'admin_init', 'erp_process_import_export' );
add_action( 'admin_footer', 'erp_email_settings_javascript' );
add_action( 'admin_notices', 'erp_importer_notices' );
add_action( 'admin_init', 'erp_import_export_download_sample_action' );
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
add_action('admin_init', 'custom_login');
//add_action('wp_logout', 'custom_logout');
add_action( 'admin_menu', 'custom_menu_page_removing' );
//add_action('login_head', 'my_loginlogo');
add_action('login_footer', 'login_styling');
add_action('admin_head','favicon');
add_action( 'login_head', 'hide_login_nav' );
add_action('admin_head', 'hid_wordpress_thankyou');
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');
add_action( 'login_head', 'empty_login_labels' );
//add_action( 'login_enqueue_scripts', 'sourcexpress_login_enqueue_scripts', 10 );
//Hide admin bar logo and links
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
add_action( 'current_screen', 'current_screen' );
//add_action('admin_bar_menu', 'add_xn_admin_bar',25);
/** Filters *******************************************************************/

add_filter( 'map_meta_cap', 'erp_map_meta_caps', 10, 4 );
add_filter( 'cron_schedules', 'erp_cron_intervals', 10, 1 );
add_filter( 'ajax_query_attachments_args', 'erp_show_users_own_attachments', 1, 1 );
//add_filter(  'gettext',  'register_text'  );
//add_filter(  'gettext',  'password_text'  );
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
add_filter('login_headertitle', 'my_loginURLtext');
add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );

