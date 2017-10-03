<?php
	/**
     * custom wp-admin logo
     */
	function my_loginlogo() {
	  echo '<style type="text/css">
		h1 a {
		  background-image: url(' . plugins_url() . '/erp/assets/images/logo_small.png) !important;
		  background-size: 150px !important;
		  width: 100% !important;
		}
	  </style>';
	}
	
	function login_styling() {
	    
	    echo '<div id="login-btm"></div>';
	}
	
	/* Remove login page Labels */
	function empty_login_labels() {
        add_filter( 'gettext', 'username_change', 20, 3 );
        function username_change( $translated_text, $text, $domain ) 
        {
            if (preg_match("/Username|Password/", $text)) {
                $translated_text = '';
            }
            return $translated_text;
        }
    }
    
        /**
	 * change wp-admin dashboard logo
	 */
         function wpb_custom_logo() {
            echo '
            <style type="text/css">
            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
            background-image: url(' . plugins_url() . '/erp/assets/images/tiny-logo.png) !important;
            background-position: 0 0;
            color:rgba(0, 0, 0, 0);
            }
            #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon { 
            background-position: 0 0;
            }
            </style>
            ';
        }
	/**
	 * change wp-admin favicon
	 */
	function favicon(){
	echo '<link rel="shortcut icon" href="' . plugins_url() . '/erp/assets/images/favicon.ico" />',"\n";
	}
	/**
	 * remove Back to site link in wp-login
	 */
	function hide_login_nav()
	{
		?><style>#backtoblog{display:none}</style><?php
	}
	/**
	 * remove annoying footer thankyou from wordpress
	 */
	function hid_wordpress_thankyou() {
	  echo '<style type="text/css">#wpfooter {display:none;}</style>';
	}
	/**
	 * custom wp-admin logo hover text
	 */
	function my_loginURLtext() {
		return 'Corptne';
	}
	/**
	 * remove un-necessary menus
	 */
	function custom_menu_page_removing($user) {
		if ( current_user_can( 'employee' ) || current_user_can( 'travelagentclient' ) || current_user_can( 'traveldesk' ) || current_user_can( 'superadmin' ) || current_user_can( 'companyadmin' ) || current_user_can( 'travelagent' ) || current_user_can( 'masteradmin' ) || current_user_can( 'travelagentuser' )) {
				remove_menu_page( 'index.php' );
                                remove_menu_page( 'profile.php' );
                                remove_menu_page( 'import.php' );
                                remove_menu_page( 'upload.php' );
		}
	}
	/**
	 * Redirect to specific Dashboard page on login
	 */
	function my_login_redirect( $redirect_to, $request, $user ) {
		//is there a user to check?
		if ( isset( $user->roles ) && is_array( $user->roles ) ) {
			//check for admins
			if ( in_array( 'administrator', $user->roles ) ) {
				// redirect them to the default place
				return $redirect_to;
			}
					else if ( in_array( 'finance', $user->roles ) ) {
				return "/wp-admin/admin.php?page=dashboard";
			}
					else if ( in_array( 'employee', $user->roles ) ) {
				return "/wp-admin/admin.php?page=dashboard";
			}
					else if ( in_array( 'travelagentclient', $user->roles ) ) {
				return "/wp-admin/admin.php?page=dashboard";
			}
					else if ( in_array( 'traveldesk', $user->roles ) ) {
				return "/wp-admin/admin.php?page=dashboard";
			}
					else if ( in_array( 'superadmin', $user->roles ) ) {
				return "/wp-admin/admin.php?page=dashboard";
			}
					else if ( in_array( 'companyadmin', $user->roles ) ) {
				return "/wp-admin/admin.php?page=dashboard";
			}
					else if ( in_array( 'travelagent', $user->roles ) ) {
				return "/wp-admin/admin.php?page=dashboard";
			}
					else if ( in_array( 'masteradmin', $user->roles ) ) {
				return "/wp-admin/admin.php?page=dashboard";
			}
					else if ( in_array( 'travelagentuser', $user->roles ) ) {
				return "/wp-admin/admin.php?page=dashboard";
			}
		} else {
			return $redirect_to;
		}
	}
        /**
	 * Store session values for Login user
	 */
        function custom_login() {
            global $wpdb;
                if ( is_user_logged_in() ) {
                    $user = wp_get_current_user();
                   // var_dump($user);
                    if($result=$wpdb->get_row("SELECT * FROM admin WHERE user_id='$user->ID'")){
                        $_SESSION['adminid'] = $result->ADM_Id;
                        $_SESSION['compid'] = $result->COM_Id;
                        $_SESSION['username'] = $result->ADM_Username;
                        $_SESSION['adminname'] = $result->ADM_Name;
                        $_SESSION['sessionid'] = session_id();
                        //$sessionid=$_SESSION['sessionid'];
                        //$compid=$_SESSION['compid'];
                    }
                    else if($result=$wpdb->get_row("SELECT * FROM employees WHERE user_id='$user->ID'")){
                        //session of empuserid
                        $_SESSION['empuserid']=$result->EMP_Id;
                        $_SESSION['emp_code']=$result->EMP_Code;
                        //session of compid
                        $_SESSION['compid']=$result->COM_Id;
                        //session of employee name
                        $_SESSION['username']=$result->EMP_Name;
                        //session id
                        $_SESSION['sessionid']=session_id();
                     
                        //$_SESSION['delegate']=NULL;
                    } else if($result=$wpdb->get_row("SELECT SUP_Id, SUP_Type, SUP_Name FROM superadmin WHERE user_id='$user->ID' AND SUP_Status=1 AND SUP_Type IN (3,4)")){
                        
                        //session of supid
                        $_SESSION['supid']          =	$result->SUP_Id;
                        //session of name 
                        $_SESSION['name']           =	$result->SUP_Name;		
                        //session id
                        $_SESSION['taSessionid']    =	session_id();
                        $sessionid					=	$_SESSION['taSessionid'];
                        //session of type 3=travel agent, 4=travel agent user
                        $_SESSION['suptype']        =	$result->SUP_Type;
                    }else if($result=$wpdb->get_row("SELECT * FROM travel_desk WHERE user_id='$user->ID'")){
                        //session of empuserid
                      //  $_SESSION['empuserid']=$result->EMP_Id;
                      //  $_SESSION['emp_code']=$result->EMP_Code;
                        //session of compid
                        $_SESSION['compid']=$result->COM_Id;
                        //session of employee name
                        $_SESSION['tdid']=$result->TD_Id;
                        //session id
                        $_SESSION['sessionid']=session_id();  
                        $_SESSION['delegate']=NULL;
                    }
                  
                }
        }
        
        function custom_logout(){
            // Finally, destroy the session.
            session_destroy();
        }
        
        function my_login_stylesheet() {
	    wp_enqueue_style( 'custom-login', plugins_url() . '/erp/assets/css/style-login.css' );
	    
	    //wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
	    //echo plugins_url() . '/erp/assets/css/style-login.css';die;
	    }
	    /* Remove Admin Bar Links */
	    function remove_admin_bar_links() {
            global $wp_admin_bar;
            //$wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
            $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
            $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
            $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
            $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
            $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
            $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
            $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
            $wp_admin_bar->remove_menu('updates');          // Remove the updates link
            $wp_admin_bar->remove_menu('comments');         // Remove the comments link
            $wp_admin_bar->remove_menu('new-content');      // Remove the content link
            $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
            //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
        }
        
        function hide_admin_bar_from_front_end(){
  if (is_blog_admin()) {
    return true;
  }
  return false;
}

/**
* Redirect users from the normal dashboard to your custom dashboard
*/
function current_screen( $screen ) {
	$user = wp_get_current_user();
	if($user->data->user_login!="mayur"){
		if( 'dashboard' == $screen->id ) {
			wp_safe_redirect( admin_url('admin.php?page=dashboard') );
			exit;
		}
	}
}

function add_xn_admin_bar() {
?>
<div class="hidden-sm hidden-xs col-md-1 col-lg-pull-3 pull-right"> 
<select style="z-index:999; margin-top:-10px; position:absolute" class="form-control" id="sel2">
<div class="form-group">
        <option>Currency</option>
		<option>(&dollar;) USD </option>
        <option>(&#8377) INR</option>
		<option>(&euro;) EURO</option>
</div>
</select>
</div>
<div class="hidden-md hidden-lg">
<select style="z-index:999; right:100px; margin-top:5px; position:absolute">
  <div class="form-group">
        <option>Currency</option>
		<option>(&dollar;) USD</option>
        <option>(&#8377) INR</option>
		<option>(&euro;) EURO</option>
</div>
</select>
</div>
<?php
}


?>