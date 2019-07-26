<?php
/**
 * Add abliity to paste row in content editor
 *
 * @param string $atts default settings
 *
 * @return string row morkup
 */
function Row_Start_shortcode($atts)
{
    ob_start(); ?>
    <div class="row">
    <?php
    return ob_get_clean();
}

add_shortcode('row', 'Row_Start_shortcode');

/**
 * Add abliity to paste column in content editor
 *
 * @param string $atts default settings
 *
 * @return string column morkup
 */
function Column_Start_shortcode($atts)
{
    ob_start(); ?>
    <div class="col-lg col-md-12">
    <?php
    return ob_get_clean();
}
add_shortcode('col', 'Column_Start_shortcode');

/**
 * Add abliity to close .row or .column in content editor
 *
 * @param string $atts default settings
 *
 * @return string </div> div closing tag
 */
function End_shortcode($atts)
{
    ob_start(); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('end', 'End_shortcode');

add_action('init', 'Add_button');

/**
 * Register & create buttons
 *
 * @return void
 */
function Add_button()
{
    if (current_user_can('edit_posts') &&  current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', 'add_plugin');
        add_filter('mce_buttons', 'Register_button');
    }
}

/**
 * Register a couple of buttons
 *
 * @param array $buttons bunch of old buttons
 *
 * @return array $buttons bunch of old and new buttons
 */
function Register_button($buttons)
{
    array_push($buttons, 'row', 'col');
    return $buttons;
}

/**
 * Create new buttons for 'columns' area
 *
 * @param array $plugin_array js for old buttons
 *
 * @return array $plugin_array js for old
 * and 'columns' area buttons
 */
function Add_plugin($plugin_array)
{
    $plugin_array['columns'] = get_template_directory_uri() . '/columns.js';
    return $plugin_array;
}