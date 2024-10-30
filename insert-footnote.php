<?php
/*
Plugin Name: Insert Footnote
Plugin URI: http://dekisugi.mobi/archives/25270 
Description:  A Wordpress plugin that insert any text or html at the end of each post. Tried of insert text plugins that is to bulky and complex? Try this simple and tiny plugin.
Version: 1.0
Author: Narin Olankijanan
Author URI: http://dekisugi.mobi
License: GPLv2
*/

/* Copyright 2012 Narin Olankijanan (email: narin1975@gmail.com)

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this progam; if not, write to the Free Software Foundation, Inc. 51 Franklin St, Fifth floor, Boston MA 02110-1301 USA
*/

add_action( 'admin_menu', 'dk_create_menu');

function dk_create_menu() {
   
         add_options_page( 'Insert Footnote', 'Insert Footnote','manage_options', _FILE_, 'dk_menu_page');
}

function dk_menu_page() {

        ?>
        <div class="wrap>
        <?php screen_icon(); ?>
<h2>Insert Footnote Plugin</h2>
<form action="options.php" method="post">
<?php settings_fields('dk_options'); ?>
<?php do_settings_sections('dk_plugin'); ?>
<input name="Submit" type="submit" value="Save Options" />
</form>
</div>
<?php
}

add_action('admin_init','dk_admin_init');

function dk_admin_init(){
 
     register_setting('dk_options', 'dk_options');
     add_settings_section('dk_main','Plugin Settings', 'dk_section_text','dk_plugin');
     add_settings_field( 'dk_text_string', 'Enter text or HTML to be placed below post contents', 'dk_setting_input','dk_plugin', 'dk_main');
}

function dk_section_text() {
     
     echo '<p>Enter your settings.</p>';
}

function dk_setting_input(){
     $options = get_option('dk_options');
     $text_string = $options['text_string'];
     echo "<textarea id='text_string' name='dk_options[text_string]'  rows=5>".$text_string."</textarea>";
     
}

add_filter('the_content', 'dk_insert_footer');

function dk_insert_footer($content){
    
    $options = get_option('dk_options');
     $text_string = $options['text_string'];
    return $content.$text_string;
}
/* EOF*/