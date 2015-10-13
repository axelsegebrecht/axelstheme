<?php
/*
* Plugin Name: Required Fields
* Plugin URI: http://plugins.nikostsolakos.com/required-fields/
* Description: Required Fields can check if you have fill in all the fields
* Version: 1.7
* Author: NikosTsolakos
* Author URI: https://profiles.wordpress.org/nikostsolakos/#content-plugins
* License: GPLv2
*/

/*
*	1. Plugin Activation / De-Activation
*	2. Admin Settings
*/

// =====
// 1. Plugin Activation / De-Activation
// =====

// Activation Start
register_activation_hook( __FILE__, "rf_activated");
function rf_activated()
{
	$default_settings = array(
        'rf_enabled_settings' => '',
        'rf_for_page_enabled' => '',
        'rf_save_draft' => '',
		'rf_image_for_page' => '',
		'rf_title_for_page' => '',
		'rf_title_settings' => '',
		'rf_excerpt_settings' => '',
		'rf_category_settings' => '',
		'rf_tag_settings' => '',
		'rf_custom_tag_id' => '',
		'rf_custom_tag_settings' => '',
		'rf_image_settings' => '',
		'rf_title_error' => 'Title is required',
		'rf_excerpt_error' => 'Excerpt is required',
		'rf_cat_error' => 'Categories are required',
		'rf_tag_error' => 'Please set less one tag',
		'rf_custom_tag_error' => 'Please set less one tag',
		'rf_img_error' => 'Post Thumbnail is required'
    );
	add_option("rf_settings", $default_settings);
}
// Activation End

// De-Activation Start
register_deactivation_hook(__FILE__, 'rf_deactivated');
function rf_deactivated()
{
	delete_option( 'rf_settings' );
}
// De-Activation End

// =====
// 2. Admin Settings
// =====

function rf_settings_init()
{
	register_setting('rf_settings', 'rf_settings', 'rf_settings_validate');
	// Main Section
	add_settings_section('rf_main_section', '<h3 style="text-align: center;border: solid 1px #D23733;background: #D23733;color: white;">Required Fields For Post</h3>', 'rf_main_section_text', __FILE__);
	// Fields Of Main Section
	add_settings_field('rf_title_settings', 'Set Title Required:', 'rf_title_settings', __FILE__, 'rf_main_section');
	add_settings_field('rf_excerpt_settings', 'Set Excerpt Required:', 'rf_excerpt_settings', __FILE__, 'rf_main_section');
	add_settings_field('rf_category_settings', 'Set Categories Required:', 'rf_category_settings', __FILE__, 'rf_main_section');
	add_settings_field('rf_image_settings', 'Set Featured Image Required:', 'rf_image_settings', __FILE__, 'rf_main_section');
	add_settings_field('rf_tag_settings', 'Set Tags Required:', 'rf_tag_settings', __FILE__, 'rf_main_section');
	add_settings_field('rf_custom_tag_settings', 'Set Custom Tags Required:', 'rf_custom_tag_settings', __FILE__, 'rf_main_section');
	// Save Draft
	add_settings_section('rf_save_draft_section', 'Save Drafts', 'rf_save_draft_text', rf_save_draft_text);
	// Fields of Save Draft
	add_settings_field('rf_save_draft', 'Save Drafts:', 'rf_save_draft', __FILE__, 'rf_save_draft_section');
	
	// Error Logs
	add_settings_section('rf_error_logs', '<div id="advanced"><a href="#collapse1">Set Error Logs</a></div>', 'rf_error_logs_text', rf_error_logs_text);
	// Fields Of Error logs
	add_settings_field('rf_title_error', 'Set Error For Title:', 'rf_title_error', __FILE__, 'rf_error_logs');
	add_settings_field('rf_excerpt_error', 'Set Error For Excerpt:', 'rf_excerpt_error', __FILE__, 'rf_error_logs');
	add_settings_field('rf_cat_error', 'Set Error For Categories:', 'rf_cat_error', __FILE__, 'rf_error_logs');
	add_settings_field('rf_tag_error', 'Set Error For Tags:', 'rf_tag_error', __FILE__, 'rf_error_logs');
	add_settings_field('rf_custom_tag_error', 'Set Error For Custom Tags:', 'rf_custom_tag_error', __FILE__, 'rf_error_logs');
	add_settings_field('rf_img_error', 'Set Error For Post thumbnail:', 'rf_img_error', __FILE__, 'rf_error_logs');
	// For Page
	add_settings_section('rf_for_page', '<div id="forpage"><a href="#collapse2">Required Fields For Page</a></div>', 'rf_for_page_text', rf_for_page_text);
	// Fields For Page
	add_settings_field('rf_for_page_enabled', 'Set Required Fields:', 'rf_for_page_enabled', __FILE__, 'rf_for_page');
	add_settings_field('rf_image_for_page', 'Image For Page:', 'rf_image_for_page', __FILE__, 'rf_for_page');
	add_settings_field('rf_title_for_page', 'Tag For Page:', 'rf_title_for_page', __FILE__, 'rf_for_page');

}
// Add rf_settings_init to Admin Section
add_action('admin_init', 'rf_settings_init' );


// Functions Of Fields Start

function rf_settings_validate($input) {
	return $input; 
}
function rf_main_section_text(){
}

include('includes/functions.php');

// Functions Of Fields End

// Set Plugin To Admin Menu
add_action('admin_menu', 'rf_admin_actions');

function rf_admin_panel()
{
	if ( !current_user_can( 'manage_options' ) ) 
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	$opt = get_option('rf_settings');
?>
	
	<div class="wrap" id="required_fields">
		<form action="options.php" method="post">
			<div id="poststuff">
				<div class="title_box">
					<h1>Required Fields</h1>						
				</div>	
				<div class="postbox" style="">
					<h3 style="color: #ffffff;"><div style="text-align: center;border: solid 1px #D23733;background: #D23733;" id="advanced">Active / De-Active</div></h3>
					<div style="margin: 10px !important;">
						<span>
						<style><?php require_once('css/style.css');?></style>
							<section style=" margin-bottom: -30px !important; ">
								<p>Required Fields For Post: </p>
									<div class="slideThree" style="margin: 0px 16%;">
									<?php rf_enabled_settings();?>
										<label for="slideThree"></label>
									</div>
							</section>
							<section style=" margin-bottom: -30px !important; ">
								<p>Required Fields For Page: </p>
									<div class="slideThree" style="margin: 0px 16%;">
									<?php rf_for_page_enabled();?>
										<label for="rf_for_page_enabled"></label>
									</div>
							</section>
							<section style=" margin-bottom: -30px !important; ">
								<p>Required Fields For Drafts: </p>
									<?php rf_save_draft_text(); ?>
							</section>
						</span>
					</div>
				</div>				
				<div class="postbox">
					<?php settings_fields('rf_settings'); ?>
					<div class="extra_settings">
						<h3>Extra Settings<h3>
					</div>
					<?php do_settings_sections(__FILE__); ?>
					<?php do_settings_sections(rf_for_page_text); ?>
					<hr style="  border: solid 2px #000;  border-left: solid 0px;border-right: solid 0px;border-bottom: solid 0px;border-style: dotted;">
					<?php do_settings_sections(rf_error_logs_text); ?>
					<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
					<script>
					$('#advanced a').click(function () {
						var collapse_content_selector = $(this).attr('href');
						var toggle_switch = $(this);
						$(collapse_content_selector).slideToggle(function () {
							$(this).is(':visible')? toggle_switch.text('Close Error Logs') : toggle_switch.text('Set Error Logs');
						});
					});
					</script>
					<script>
					$('#forpage a').click(function () {
						var collapse_content_selector = $(this).attr('href');
						var toggle_switch = $(this);
						$(collapse_content_selector).slideToggle(function () {
							$(this).is(':visible')? toggle_switch.text('Close Required Fields For Page') : toggle_switch.text('Required Fields For Page');
						});
					});
					</script>
					<script type="text/javascript">
					/* ColorFul Bg Button */
					$('#rf_custom_tag_settings').change(function() {
						
						if($("#rf_custom_tag_settings").prop('checked') == true) {
							document.getElementById("rf_custom_tag_id").removeAttribute('disabled');
							$('#rf_custom_tag_id').removeAttr('style');
						} else {
							document.getElementById("rf_custom_tag_id").setAttribute('disabled', 'disabled');
							document.getElementById("rf_custom_tag_id").style.cursor = 'no-drop';
						}
					});
					</script>
					<p class="submit" style="margin-left: 10px;">
						<input id="submit-rf-options" name="Submit" type="submit"  class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
					</p>
				</div>
			</div>
		</form>
	</div>
<?php }

function rf_admin_actions() {
	add_options_page("Required Fields Options", "Required Fields", 'manage_options', "Required_Fields", "rf_admin_panel");
}

function rf_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=Required_Fields">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'rf_settings_link' );

// =====
// 3. Frontend
// =====
function wp_rf_sc()
{
	$opt = get_option('rf_settings');
	wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_script', 'wp_rf_sc' );
	// Check Functions And Run
function required_fields()
	{
		$opt = get_option('rf_settings');
		if( !isset($opt['rf_enabled_settings']) )
		{
			echo '';
		}
		else
		{
			$rf_style = "{'background':'#FFEBE8', 'border':'#CC0000 solid 1px'}";
			
			/************************************************************ TITLE ************************************************************/
			if ( isset($opt['rf_title_settings']) )
			{	
				if (isset($opt['rf_for_page_enabled']) && isset($opt['rf_title_for_page']))
				{
					global $typenow;
					if(in_array($typenow, array('post','page')))
					{	
						echo "<script type='text/javascript'>\n";
						  echo "
						  jQuery('#publish"; if (isset($opt['rf_save_draft'])) {echo ", #save-post";} echo "').click(function(){
								var testervar = jQuery('[id^=\"titlediv\"]').find('#title');
								if (testervar.val().length < 1)
								{
									jQuery('[name^=\"post_title\"]').css( ".$rf_style." );
									setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
									alert('".$opt['rf_title_error']."');
									setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
									return false;
								}
							});
						  ";
						echo "</script>\n";
					}
					
				} else {
					global $post_type;
					if($post_type == 'post')
					{	
						echo "<script type='text/javascript'>\n";
						  echo "
						  jQuery('#publish"; if (isset($opt['rf_save_draft'])) {echo ", #save-post";} echo "').click(function(){
								var testervar = jQuery('[id^=\"titlediv\"]')
								.find('#title');
								if (testervar.val().length < 1)
								{
									jQuery('[name^=\"post_title\"]').css( ".$rf_style." );
									setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
									alert('".$opt['rf_title_error']."');
									setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
									return false;
								}
							});
						  ";
						echo "</script>\n";
					}
				}
			}
			/************************************************************ /TITLE ************************************************************/
			
			/************************************************************ EXCERPT ***********************************************************/
			if ( isset( $opt['rf_excerpt_settings'] ) )
			{
				global $post_type;
				if($post_type == 'post')
				{
					echo "<script type='text/javascript'>\n";
						  echo "
						  jQuery('#publish"; if (isset($opt['rf_save_draft'])) {echo ", #save-post";} echo "').click(function(){
								var ex_testervar = jQuery('[id^=\"postexcerpt\"]').find('#excerpt');
								if (ex_testervar.val().length < 1)
								{
									jQuery('[id^=\"postexcerpt\"]').css( ".$rf_style." );
									setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
									alert('".$opt['rf_excerpt_error']."');
									setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
									return false;
								}
							});
						  ";
					echo "</script>\n";
				}
			}
			/************************************************************ /EXCERPT ***********************************************************/
			
			/************************************************************ CATEGORIES ********************************************************/
			if ( isset($opt['rf_category_settings']) )
			{
				global $post_type;
				if($post_type=='post')
				{	
					echo "<script>
							jQuery(function($){
								$('#publish"; if (isset($opt['rf_save_draft'])) {echo ", #save-post";} echo "').click(function(e){
									if($('#taxonomy-category input:checked').length==0){
										jQuery('[id^=\"categorydiv\"]').css( ".$rf_style." );
										alert('" . __(''.$opt['rf_cat_error'].'', 'require-post-category') . "');
										e.stopImmediatePropagation();
										return false;
									}else{
										return true;
									}
								});
								var publish_click_events = $('#publish').data('events').click;
								if(publish_click_events){
									if(publish_click_events.length>1){
										publish_click_events.unshift(publish_click_events.pop());
									}
								}
								if($('#save-post').data('events') != null){
									var save_click_events = $('#save-post').data('events').click;
									if(save_click_events){
									  if(save_click_events.length>1){
										  save_click_events.unshift(save_click_events.pop());
									  }
									}
								}
							});
							</script>";
				}
			}
			/************************************************************ /CATEGORIES ************************************************************/
			
			/************************************************************ FEATURED IMAGE *********************************************************/
			if ( isset($opt['rf_image_settings']) )
			{
				if (isset($opt['rf_for_page_enabled']) && isset($opt['rf_image_for_page']))
				{
					global $typenow;
					if(in_array($typenow, array('post','page')))
					{
						echo "<script language='javascript' type='text/javascript'>
							jQuery(function($){
								$('#publish"; if (isset($opt['rf_save_draft'])) {echo ", #save-post";} echo "').click(function(e){
									if (jQuery('#set-post-thumbnail').find('img').size() < 1) {
										jQuery('[id^=\'postimagediv\']').css( ".$rf_style." );
										alert('".$opt['rf_img_error']."');
										jQuery('#ajax-loading').hide();
										jQuery('#publish"; if (isset($opt['rf_save_draft'])) {echo ", #save-post";} echo "').removeClass('button-primary-disabled');
										return false;
									}
								});
							});
						</script>";
					}
				}
				else
				{
					global $typenow;
					if(in_array($typenow, array('post')))
					{
						echo "<script language='javascript' type='text/javascript'>
							jQuery(function($){
								$('#publish"; if (isset($opt['rf_save_draft'])) {echo ", #save-post";} echo "').click(function(e){
									if (jQuery('#set-post-thumbnail').find('img').size() < 1) {
										jQuery('[id^=\'postimagediv\']').css( ".$rf_style." );
										alert('".$opt['rf_img_error']."');
										jQuery('#ajax-loading').hide();
										jQuery('#publish"; if (isset($opt['rf_save_draft'])) {echo ", #save-post";} echo "').removeClass('button-primary-disabled');
										return false;
									}
								});
							});
						</script>";
					}
				}
			}
			/************************************************************ /FEATURED IMAGE *************************************************/
			
			/************************************************************ TAGS ************************************************************/
			if ( isset($opt['rf_tag_settings']) ) 
			{
				global $post_type;
				if($post_type=='post'){
					echo "<script>
					jQuery(function($){
						$('#publish"; if ( isset( $opt['rf_save_draft'] ) ) {echo ", #save-post";} echo "').click(function(e){
							if($('#post_tag .tagchecklist span').length==0){
								jQuery('[id^=\"tagsdiv-post_tag\"]').css( ".$rf_style." );
								alert('".$opt['rf_tag_error']."');
								e.stopImmediatePropagation();
								return false;
							}else{
								return true;
							}
						});
						var publish_click_events = $('#publish').data('events').click;
						if(publish_click_events){
							if(publish_click_events.length>1){
								publish_click_events.unshift(publish_click_events.pop());
							}
						}
						if($('#save-post').data('events') != null){
							var save_click_events = $('#save-post').data('events').click;
							if(save_click_events){
							  if(save_click_events.length>1){
								  save_click_events.unshift(save_click_events.pop());
							  }
							}
						}
					});
					</script>";
				}
			}
			if ( isset($opt['rf_custom_tag_settings']) ) 
			{
				global $post_type;
				if($post_type=='post'){
					
					echo "<script>
					jQuery(function($){
						$('#publish"; if ( isset( $opt['rf_save_draft'] ) ) {echo ", #save-post";} echo "').click(function(e){
							if($('#".$opt['rf_custom_tag_id']." .tagchecklist span').length==0){
								jQuery('[id^=\"tagsdiv-".$opt['rf_custom_tag_id']."\"]').css( ".$rf_style." );
								alert('".$opt['rf_custom_tag_error']."');
								e.stopImmediatePropagation();
								return false;
							}else{
								return true;
							}
						});
						var publish_click_events = $('#publish').data('events').click;
						if(publish_click_events){
							if(publish_click_events.length>1){
								publish_click_events.unshift(publish_click_events.pop());
							}
						}
						if($('#save-post').data('events') != null){
							var save_click_events = $('#save-post').data('events').click;
							if(save_click_events){
							  if(save_click_events.length>1){
								  save_click_events.unshift(save_click_events.pop());
							  }
							}
						}
					});
					</script>";
				}
			}
			/************************************************************ /TAGS ************************************************************/
		}
	}
	add_action('admin_footer-post.php', 'required_fields');
	add_action('admin_footer-post-new.php', 'required_fields');
?>