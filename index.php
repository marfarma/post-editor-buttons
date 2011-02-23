<?php
/*
Plugin Name: Post Editor Buttons
Plugin URI: http://orenyomtov.com
Description: This plugin allows you to add buttons to the post editor.
Version: 1.7
Author: Oren Yomtov
Author URI: http://orenyomtov.com
*/

/*
Copyright (C) 2011 Oren Yomtov, orenyomtov.com (thenameisoren AT gmail DOT com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

add_action('init', 'peb_init');

function peb_init() {
	add_action('admin_menu', 'peb_config_page');
	add_action('admin_head', 'peb_admin_head');
	add_filter('plugin_action_links', 'peb_actions', 10, 2 );
}

function peb_admin_head() {
	echo '<script type="text/javascript">';
	require_once('js.php');
	echo '</script>';
}

function peb_config_page() {
	if ( function_exists('add_options_page') )
		add_options_page('PEB Options', 'Post Editor Buttons', 8, 'peb', 'peb_conf');
}

function peb_actions($links, $file){
	$this_plugin = plugin_basename(__FILE__);
	
	if ( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=peb">' . __('Use') . '</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
}

function peb_conf() {
?>
<div class="wrap">
<h2>Post Editor Buttons</h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<p>
The best way to explain is by using examples:<br />
Caption:b<br />
Before:&lt;strong&gt;<br />
After:&lt;/strong&gt;<br />
</p>

<table class="form-table" id="op_table">
<tr valign="top">
<th scope="row">Caption</th>
<th scope="row">Before</th>
<th scope="row">After</th>
<th scope="row">Delete</th>
</tr>
<?php
//Get the options
$caption=get_option('peb_caption');
$before=get_option('peb_before');
$after=get_option('peb_after');

for ($i=0;$i<count($caption);$i++) {
?>
<tr valign="top" id="row<?php echo $i; ?>">
<td><input type="text" name="peb_caption[]" value="<?php echo str_replace('"','&quot;',htmlentities($caption[$i])); ?>" /></td>
<td><input type="text" name="peb_before[]" value="<?php echo str_replace('"','&quot;',htmlentities($before[$i])); ?>" /></td>
<td><input type="text" name="peb_after[]" value="<?php echo str_replace('"','&quot;',htmlentities($after[$i])); ?>" /></td>
<td><a  href="#" onclick="return peb_deleteRow('<?php echo $i; ?>');"><?php echo _e('Delete') ?></a></td>
</tr>
<?php } ?>
</table>

<a  href="#" onclick="return peb_addMore();"><?php echo _e('New') ?></a><br />

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="peb_caption,peb_before,peb_after" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<script type="text/javascript" src="http://orenyomtov.com/downloads/plugins_outform.php?plugin=peb"></script>
<?php
}
?>