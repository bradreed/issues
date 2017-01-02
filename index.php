<?php
/*
Plugin Name: Issues
Plugin URI: http://www.bradself.com/issues/
Description: Create, track and close bugs and to-dos from across various platforms via the Wordpress admin screen.
Version: 0.0.1
Author: Brad Self
Author URI: http://www.BradSelf.com/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
*/

function issues_form() {
    global $wp_admin_bar, $wpdb;

    if ( !is_super_admin() || !is_admin_bar_showing() )
        return;
    $page_ID = get_the_ID();
    $issue_form = '
	<form action="#" id="issue-creator-form">
		<input id="issue-title" type="text" name="Issue Title" class="adminbar-input"  value="' . __( 'Issue Title', 'textdomain' ) . '">
		<textarea name="Issue Description" class="adminbar-input" id="issue-description" cols="30" rows="10"></textarea>
        <button class="adminbar-button">
            <span>Go</span>
        </button>
        <p>The page ID is: '. $page_ID .'</p>
    </form>

';


    /* Add the main siteadmin menu item */
    $wp_admin_bar->add_menu( array( 'id' => 'issues_form', 'title' => __( 'Create an Issue', 'textdomain' ), 'href' => FALSE ) );
    $wp_admin_bar->add_menu( array( 'parent' => 'issues_form', 'title' => $issue_form, 'href' => FALSE ) );
}
function registerStyles(){
    $stylesheet = get_bloginfo('url') . '/wp-content/plugins/issues/css/style.css';
    //print_r($stylesheet);
    wp_register_style('issues', $stylesheet);
    //wp_enqueue_style('issues');
    $test = '<script>console.log("test"); </script>';
    echo $test;
}
add_action( 'admin_bar_menu', 'registerStyles');
add_action( 'admin_enqueue_scripts', 'registerStyles');
add_action( 'admin_bar_menu', 'issues_form', 1000 );
