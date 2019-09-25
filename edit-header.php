<?php
/**
 * Plugin Name: Edit header
 * Plugin URI: https://github.com/divarsoy/edit-header
 * Description: Plugin to edit content above the header area
 * Version: 1.0
 * Author: Dag A. Ivarsøy
 * Author URI: https://github.com/divarsoy
 */
defined( 'ABSPATH' ) or die();

// Insert content before wp_head
add_action( 'wp_head', 'add_custom_content_before_header' );
function add_custom_content_before_header() {
    echo '<div class="header-wrapper">';
    echo do_shortcode( get_option('header-text'));
    echo '</div>';
}

add_shortcode('myshortcode', 'myshortcode_function');
function myshortcode_function(){
    return 'This is my shortcode';
}
// create custom plugin settings menu
add_action('admin_menu', 'edit_header_menu');
function edit_header_menu() {
	add_menu_page('Edit Header', 'Edit Header', 'administrator', __FILE__, 'edit_header_settings_page' );
	add_action( 'admin_init', 'register_edit_header_plugin_settings' );
}

function register_edit_header_plugin_settings() {
	register_setting( 'edit-header-settings-group', 'header-text' );
}
// Admin form
function edit_header_settings_page() {
?>
<div class="wrap">
    <h1>Edit Header</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'edit-header-settings-group' );
        do_settings_sections( 'edit-header-settings-group' );
        wp_editor( get_option('header-text'), "header-text");
        submit_button();
        ?>
    </form>
</div>
<?php } ?>
