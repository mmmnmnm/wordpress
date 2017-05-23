<?php
/**
 * Plugin Name: Wp Facebook Share Like Button
 * Plugin URI: http://www.vivacityinfotech.net
 * Description: A simple Facebook Like Button plugin for your posts/archive/pages or Home page.
 * Version: 2.2
 * Author: Vivacity Infotech Pvt. Ltd.
 * Author URI: http://www.vivacityinfotech.net
 * Text Domain: wp-fb-share-like-button
 * Domain Path: /languages
 */
/* Copyright 2014,2015,2016  Vivacity InfoTech Pvt. Ltd.  (email : support@vivacityinfotech.net)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

if (!defined('ABSPATH')) exit(); // Exit if accessed directly

$vifslb_like_settings = array();
$vifslb_like_settings['default_app_id'] = '';
$vifslb_like_layouts = array('standard', 'button_count', 'box_count', 'button');
$vifslb_like_verbs = array('like', 'recommend');
$vifslb_like_size = array('small', 'large');
$vifslb_like_aligns = array('left', 'right');
$vifslb_like_types = array(
    __("Activities", "wp-fb-share-like-button"), __("Activity", "wp-fb-share-like-button"), __("Company", "wp-fb-share-like-button"), __("Organizations", "wp-fb-share-like-button"),
    __("Author", "wp-fb-share-like-button"), __("Product", "wp-fb-share-like-button"), __("Websites", "wp-fb-share-like-button"), __("Article", "wp-fb-share-like-button"), __("Blog", "wp-fb-share-like-button"), __("Website", "wp-fb-share-like-button")
);

$vifslb_like_settings['language'] = 'en_Us';

global $pages;

/* Returns major/minor WordPress version. */
function vifslb_get_wp_version() {
    return (float) substr(get_bloginfo('version'), 0, 3);
}

// Add link - settings on plugin page
function vifb_likes($links) {
    $settings_link = '<a href="options-general.php?page=viva_fblikes">' . __("Settings", "wp-fb-share-like-button") . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'vifb_likes');

/* Formally registers Like settings. */
function vifslb_register_like_settings() {
    register_setting('vifslb_like', 'vifslb_like_width');
    register_setting('vifslb_like', 'vifslb_like_height');
    register_setting('vifslb_like', 'vifslb_like_layout');
    register_setting('vifslb_like', 'vifslb_like_verb');
    register_setting('vifslb_like', 'vifslb_like_size');    
    register_setting('vifslb_like', 'vifslb_like_align');
    register_setting('vifslb_like', 'vifslb_like_showfaces');
    register_setting('vifslb_like', 'vifslb_like_share');
    register_setting('vifslb_like', 'vifslb_like_show_at_top');
    register_setting('vifslb_like', 'vifslb_like_show_at_bottom');
    register_setting('vifslb_like', 'vifslb_like_show_on_page');
    register_setting('vifslb_like', 'vifslb_like_show_on_post');
    register_setting('vifslb_like', 'vifslb_like_show_on_home');
    register_setting('vifslb_like', 'vifslb_like_show_on_archive');
    register_setting('vifslb_like', 'vifslb_like_facebook_image');
    register_setting('vifslb_like', 'vifslb_like_html5');
    register_setting('vifslb_like', 'vifslb_like_facebook_app_id');
    register_setting('vifslb_like', 'vifslb_like_use_excerpt_as_description');
    register_setting('vifslb_like', 'vifslb_like_type');
    register_setting('vifslb_like', 'vifslb_like_excludepage');
    register_setting('vifslb_like', 'vifslb_like_use_plugin_lang');
    register_setting('vifslb_like', 'vifslb_like_btntype');
    
}

function vifslb_like_init() {
	    global $vifslb_like_settings;
	    global $pages;	
	    if (vifslb_get_wp_version() >= 2.7) {
	        if (is_admin()) {
	            add_action('admin_init', 'vifslb_register_like_settings');
	        }
    }
    add_filter('the_content', 'vifslb_like_func');
    add_filter('admin_menu', 'vifslb_like_admin_menu');
    add_filter('language_attributes', 'vifslb_like_schema');
    add_option('vifslb_like_width', '450');
    add_option('vifslb_like_height', '30');
    add_option('vifslb_like_layout', 'standard');
    add_option('vifslb_like_verb', 'like');
    add_option('vifslb_like_size', 'small');
    add_option('vifslb_like_align', 'left');
    add_option('vifslb_like_showfaces', 'false');
    add_option('vifslb_like_share', 'false');
    add_option('vifslb_like_show_at_top', 'true');
    add_option('vifslb_like_show_at_bottom', 'false');
    add_option('vifslb_like_show_on_page', 'true');
    add_option('vifslb_like_show_on_post', 'true');
    add_option('vifslb_like_show_on_home', 'true');
    add_option('vifslb_like_show_on_archive', 'false');
    add_option('vifslb_like_facebook_image', '');
    add_option('vifslb_like_html5', 'true');
    add_option('vifslb_like_facebook_app_id', $vifslb_like_settings['default_app_id']);
    add_option('vifslb_like_use_excerpt_as_description', 'true');
    add_option('vifslb_like_type', 'Article');
    add_option('vifslb_like_use_plugin_lang', 'en_Us');
    add_option('vifslb_like_btntype', 'html5');
    add_option('vifslb_like_excludepage', $pages);
    $vifslb_like_settings['width'] = get_option('vifslb_like_width');
    $vifslb_like_settings['height'] = get_option('vifslb_like_height');
    $vifslb_like_settings['layout'] = get_option('vifslb_like_layout');
    $vifslb_like_settings['verb'] = get_option('vifslb_like_verb');
    $vifslb_like_settings['language'] = get_option('vifslb_like_use_plugin_lang');
    $vifslb_like_settings['size'] = get_option('vifslb_like_size');
    $vifslb_like_settings['align'] = get_option('vifslb_like_align');
    $vifslb_like_settings['showfaces'] = get_option('vifslb_like_showfaces') === 'true';
    $vifslb_like_settings['share'] = get_option('vifslb_like_share') === 'true';
    $vifslb_like_settings['showattop'] = get_option('vifslb_like_show_at_top') === 'true';
    $vifslb_like_settings['showatbottom'] = get_option('vifslb_like_show_at_bottom') === 'true';
    $vifslb_like_settings['showonpage'] = get_option('vifslb_like_show_on_page') === 'true';
    $vifslb_like_settings['showonpost'] = get_option('vifslb_like_show_on_post') === 'true';
    $vifslb_like_settings['showonhome'] = get_option('vifslb_like_show_on_home') === 'true';
    $vifslb_like_settings['showonarchive'] = get_option('vifslb_like_show_on_archive') === 'true';
    $vifslb_like_settings['facebook_image'] = get_option('vifslb_like_facebook_image');
    $vifslb_like_settings['html5'] = get_option('vifslb_like_html5');
    $vifslb_like_settings['facebook_app_id'] = get_option('vifslb_like_facebook_app_id');
    $vifslb_like_settings['btntype'] = get_option('vifslb_like_btntype');
    $vifslb_like_settings['use_excerpt_as_description'] = get_option('vifslb_like_use_excerpt_as_description');
    $vifslb_like_settings['og'] = array();
    $vifslb_like_settings['og']['type'] = get_option('vifslb_like_type');    
    $plugin_path = plugin_basename(dirname(__FILE__) . '/languages');
    load_plugin_textdomain('wp-fb-share-like-button', '', $plugin_path);
    
     add_action('wp_head', 'vifslb_like_func_header_meta');
     add_action('wp_footer', 'vifslb_like_func_footer');
    
}

function vifslb_like_schema($attr) {
    $attr .= "\n xmlns:og=\"http://opengraphprotocol.org/schema/\"";
    $attr .= "\n xmlns:fb=\"http://www.facebook.com/2008/fbml\"";
    return $attr;
}

function vifslb_like_func_header_meta() {
    global $vifslb_like_settings;
    global $plugin_appid;
    if ($vifslb_like_settings['language'] == '') {
        $lang1 = 'en_Us';
    } else {
        $lang1 = $vifslb_like_settings['language'];
    }
    echo '<meta property="og:locale" content="' . $lang1 . '" />' . "\n";
    echo '<meta property="og:locale:alternate" content="' . $lang1 . '" />' . "\n";
        
    $fbappid = trim($vifslb_like_settings['facebook_app_id']);
    if (!empty($fbappid)) {
        echo '<meta property="fb:app_id" content="' . $fbappid . '" />' . "\n";
    }

    $image = trim($vifslb_like_settings['facebook_image']);
    if (!empty($image)) {
        echo '<meta property="og:image" content="' . $image . '" />' . "\n";
    }
    echo '<meta property="og:site_name" content="' . htmlspecialchars(get_bloginfo('name')) . '" />' . "\n";
    if(is_single() || is_page()) {
        $title = the_title('', '', false);
        $php_version = explode('.', phpversion());
        if (count($php_version) && $php_version[0] >= 5)
            $title = html_entity_decode($title, ENT_QUOTES, 'UTF-8');
        else
            $title = html_entity_decode($title, ENT_QUOTES);
        echo '<meta property="og:title" content="' . htmlspecialchars($title) . '" />' . "\n";
        echo '<meta property="og:url" content="' . get_permalink() . '" />' . "\n";
        if ($vifslb_like_settings['use_excerpt_as_description'] == 'true') {
            $description = trim(get_the_excerpt());
            if (!empty($description))
            echo '<meta property="og:description" content="' . htmlspecialchars($description) . '" />' . "\n";
        }
    }
   
    foreach ($vifslb_like_settings['og'] as $k => $v) {
        $v = trim($v);
        if ($v != '')
            echo '<meta property="og:' . $k . '" content="' . htmlspecialchars($v) . '" />' . "\n";
    }
}

function vifslb_like_func_footer() {
    global $vifslb_like_settings;
    global $plugin_appid;
    if ($vifslb_like_settings['language'] == '') {
        $lang1 = 'en_Us';
    } else {
        $lang1 = $vifslb_like_settings['language'];
    }

    $appids = trim($vifslb_like_settings['facebook_app_id']);
    $appids = explode(',', $appids);

    if (!count($appids))
        return;

    foreach ($appids as $appid) {
        if (is_numeric($appid))
            break;
    }

    if (!is_numeric($appid))
        return;

if ($vifslb_like_settings['btntype'] == 'html5') {
 echo '<div id="fb-root"></div>'; ?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $lang1; ?>/sdk.js#xfbml=1&version=v2.7&appId=<?php echo $appid; ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		<?php     
    }
}
 
function vifslb_like_func($content, $sidebar = false) {
    global $vifslb_like_settings;
    global $appids;
    if (is_single() && !$vifslb_like_settings['showonpost'])
        return $content; 
    if (is_page() && !$vifslb_like_settings['showonpage'])
        return $content;
    if (is_front_page() && !$vifslb_like_settings['showonhome'])
        return $content;
    if (is_archive() && !$vifslb_like_settings['showonarchive'])
        return $content;
    $pages = get_option('vifslb_like_excludepage');
    $pages1 = explode(',', $pages);
    if (!empty($pages)) {
        foreach ($pages1 as $page) {
            if (is_page($page) && ( $vifslb_like_settings['showonpage'] || !$vifslb_like_settings['showonpage'] )) {
                return $content;      
            }        
            if (is_single($page) && ( $vifslb_like_settings['showonpost'] || !$vifslb_like_settings['showonpost'] )) {
                return $content;
            } 
        }
    }
    $purl = get_permalink();
    $button = "\n<!-- Facebook Like Button Vivacity Infotech BEGIN -->\n";
    $showfaces = ($vifslb_like_settings['showfaces'] == 'true') ? "true" : "false";
    $share = ($vifslb_like_settings['share'] == 'true') ? "true" : "false";
    $url = urlencode($purl);
    $separator = '&amp;';
    $url = $url . $separator . 'width=' . $vifslb_like_settings['width']
            . $separator . 'layout=' . $vifslb_like_settings['layout']
            . $separator . 'action=' . $vifslb_like_settings['verb']
            . $separator . 'size=' . $vifslb_like_settings['size']
            . $separator . 'show_faces=' . $showfaces
            . $separator . 'share=' . $share
            . $separator . 'height=' . $vifslb_like_settings['height']
            . $separator . 'appId=' . $appids;
          
    $align = $vifslb_like_settings['align'] == 'right' ? 'right' : 'left';
   /* if ($vifslb_like_settings['btntype'] == 'xfbml') {
        $button .= '<fb:like href="' . $purl . '" layout="' . $vifslb_like_settings['layout'] . '" show_faces="' . $showfaces . '" width="' . $vifslb_like_settings['width'] . '" action="' . $vifslb_like_settings['verb'] . '" colorscheme="' . $vifslb_like_settings['colorscheme'] . '"></fb:like>';      
    } else */
    if ($vifslb_like_settings['btntype'] == 'html5') {
       $button .= '<div class="fb-like" data-href="' . $purl . '" data-layout="' . $vifslb_like_settings['layout'] . '" data-action="' . $vifslb_like_settings['verb'] . '" data-show-faces="' . $showfaces . '" data-size="' . $vifslb_like_settings['size'] . '" data-width="' . $vifslb_like_settings['width'] . '" data-share="' . $vifslb_like_settings['share'] . '" ></div>'; 
    } 
    
    else {
        $button .= '<iframe src="http://www.facebook.com/plugins/like.php?href=' . $url . '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:' . $vifslb_like_settings['width'] . 'px; height: ' . $vifslb_like_settings['height'] . 'px; align: ' . $align . ';"></iframe>';         
    }
    if ($align == 'right') {
        $button = '<div class="like-button" style="float: right; clear: both; text-align: right; width = 100%;">' . $button . '</div>';
    }
    $button .= "\n<!-- Facebook Like Button Vivacity Infotech END -->\n";

    if ($vifslb_like_settings['showattop'] == 'true')
        $content = $button . $content;

    if ($vifslb_like_settings['showatbottom'] == 'true')
        $content .= $button;

    return $content;
}

function vifslb_like_admin_menu() {
    $res = add_options_page(__("Like Plugin Options", "wp-fb-share-like-button"), __("Like-Settings", "wp-fb-share-like-button"), 'manage_options', 'viva_fblikes', 'vifslb_plugin_options');
    add_action('admin_enqueue_scripts', 'vifslb_admin_styles');
}

function vifslb_admin_styles() {
    /*
     * It will be called only on your plugin admin page, enqueue our stylesheet here
     */
    wp_register_style('vifslbStylesheet', plugins_url('style.css', __FILE__));
    wp_enqueue_style('vifslbStylesheet');
}

function vifslb_plugin_options() {
    global $vifslb_like_layouts;
    global $vifslb_like_verbs;
    global $vifslb_like_size;
    global $vifslb_like_aligns;
    global $vifslb_like_types;
    global $vifslb_like_excludepage;
    global $vifslb_like_settings;
    global $language;
    ?>
    <div class="wrap">

        <div class="top">
            <h3><?php _e( 'Facebook Like Button', 'wp-fb-share-like-button' );?> <small>by <a href="http://www.vivacityinfotech.net" target="_blank"><?php _e( 'Vivacity Infotech Pvt. Ltd.');?></a>
            </h3>
        </div> <!-- ------End of top-----------  -->

        <?php
        if ( $vifslb_like_settings['facebook_app_id'] == '' ) {
            ?>	
       <div class="error errormsg"><?php _e("Please Insert Your facebook App Id.", "wp-fb-share-like-button") ?></div>    	
        <?php } ?>

        <div class="inner_wrap">
            <div class="left">

                <form method="post" action="options.php" id="facebook_like" name="facebook_like">
                    <?php
                    if (vifslb_get_wp_version() < 2.7) {
                        wp_nonce_field('update-options');
                    } else {
                        settings_fields('vifslb_like');
                    }
                    ?>            
                
                    <table class="form-table">
                        <h3 class="title"><?php _e("Appearance Settings", 'wp-fb-share-like-button'); ?></h3>
                        <table class="form-table admintbl">
                            <tr valign="top">
                                <th scope="row"><?php _e("Width:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="text" name="vifslb_like_width" value="<?php echo get_option('vifslb_like_width'); ?>" /></td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e("Height:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="text" name="vifslb_like_height" value="<?php echo get_option('vifslb_like_height'); ?>" /></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Layout:", 'wp-fb-share-like-button'); ?></th>
                                <td>
                                    <select name="vifslb_like_layout">
                                        <?php
                                        $curmenutype = get_option('vifslb_like_layout');
                                        foreach ($vifslb_like_layouts as $type) {
                                            echo "<option value=\"$type\"" . ($type == $curmenutype ? " selected" : "") . ">$type</option>";
                                        }
                                        ?>
                                    </select>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Verb to display:", 'wp-fb-share-like-button'); ?></th>
                                <td>
                                    <select name="vifslb_like_verb">
                                        <?php
                                        $curmenutype = get_option('vifslb_like_verb');
                                        foreach ($vifslb_like_verbs as $type) {
                                            echo "<option value=\"$type\"" . ($type == $curmenutype ? " selected" : "") . ">$type</option>";
                                        }
                                        ?>
                                    </select>
                            </tr>

                            <tr>
                                <th scope="row"><?php _e("Size:", 'wp-fb-share-like-button'); ?></th>
                                <td>
                                    <select name="vifslb_like_size">
                                        <?php
                                        $curmenutype = get_option('vifslb_like_size');
                                        foreach ($vifslb_like_size as $type) {
                                            echo "<option value=\"$type\"" . ($type == $curmenutype ? " selected" : "") . ">$type</option>";
                                        }
                                        ?>
                                    </select>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Show Friends' Faces:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="checkbox" name="vifslb_like_showfaces" value="true" <?php echo (get_option('vifslb_like_showfaces') == 'true' ? 'checked' : ''); ?>/> <small><?php //_e("Don't forget to increase the Height accordingly", 'wp-fb-share-like-button' );          ?></small></td>
                            </tr>
                            <tr> 
                                <th scope="row"><?php _e("Include Share Button:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="checkbox" name="vifslb_like_share" value="true" <?php echo (get_option('vifslb_like_share') == 'true' ? 'checked' : ''); ?>/> <small><?php //_e("Don't forget to increase the Height accordingly", 'wp-fb-share-like-button' );          ?></small></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Language:", 'wp-fb-share-like-button'); ?></th>
                                <td>  
                                    <?php
                                    $language = array();
                                    $language['af_ZA'] = 'Afrikaans';
                                    $language['sq_AL'] = 'Albanian - shqiptar';
                                    $language['ar_AR'] = 'Arabic - العربية‬';
                                    $language['hy_AM'] = 'Armenian - հայերեն';
                                    $language['ay_BO'] = 'Aymara';
                                    $language['az_AZ'] = 'Azeri';
                                    $language['eu_ES'] = 'Basque - Euskal';
                                    $language['be_BY'] = 'Belarusian - беларускі';
                                    $language['bn_IN'] = 'Bengali - বাংলা';
                                    $language['bs_BA'] = 'Bosnian - bosanski';
                                    $language['bg_BG'] = 'Bulgarian - Български';
                                    $language['ca_ES'] = 'Catalan - Català';
                                    $language['ck_US'] = 'Cherokee';
                                    $language['hr_HR'] = 'Croatian - Hrvatska';
                                    $language['cs_CZ'] = 'Czech - České';
                                    $language['da_DK'] = 'Danish - dansk';
                                    $language['nl_NL'] = 'Dutch - Nederlands';
                                    $language['nl_BE'] = 'Dutch (Belgi?)';
                                    $language['en_GB'] = 'English (UK)';
                                    $language['en_PI'] = 'English (Pirate)';
                                    $language['en_UD'] = 'English (Upside Down)';
                                    $language['en_US'] = 'English (US)';
                                    $language['eo_EO'] = 'Esperanto';
                                    $language['et_EE'] = 'Estonian - Eesti';
                                    $language['fo_FO'] = 'Faroese';
                                    $language['tl_PH'] = 'Filipino - Pilipino';
                                    $language['fi_FI'] = 'Finnish - Suomi';
                                    $language['fr_CA'] = 'French (Canada) - Français (Canada)';
                                    $language['fr_FR'] = 'Galician - Galego';
                                    $language['ka_GE'] = 'Georgian - ქართული';
                                    $language['de_DE'] = 'German - German';
                                    $language['el_GR'] = 'Greek - Ελληνική';
                                    $language['gn_PY'] = 'Guaran';
                                    $language['gu_IN'] = 'Gujarati - ગુજરાતી';
                                    $language['he_IL'] = 'Hebrew - עברית';
                                    $language['hi_IN'] = 'Hindi - हिन्दी';
                                    $language['hu_HU'] = 'Hungarian - magyar';
                                    $language['is_IS'] = 'Icelandic - íslenska';
                                    $language['id_ID'] = 'Indonesian';
                                    $language['ga_IE'] = 'Irish - Gaeilge';
                                    $language['it_IT'] = 'Italian - italiano';
                                    $language['ja_JP'] = 'Japanese - 日本の';
                                    $language['jv_ID'] = 'Javanese - Jawa';
                                    $language['kn_IN'] = 'Kannada - ಕನ್ನಡ';
                                    $language['kk_KZ'] = 'Kazakh';
                                    $language['km_KH'] = 'Khmer - ភាសាខ្មែរ';
                                    $language['tl_ST'] = 'Klingon';
                                    $language['ko_KR'] = 'Korean - 한국어';
                                    $language['ku_TR'] = 'Kurdish';
                                    $language['la_VA'] = 'Latin';
                                    $language['lv_LV'] = 'Latvian - Latvijas';
                                    $language['fb_LT'] = 'Leet Speak';
                                    $language['li_NL'] = 'Limburgish';
                                    $language['lt_LT'] = 'Lithuanian - Lietuvos';
                                    $language['mk_MK'] = 'Macedonian - македонски';
                                    $language['mg_MG'] = 'Malagasy';
                                    $language['ms_MY'] = 'Malay - Melayu';
                                    $language['ml_IN'] = 'Maltese - Malti';
                                    $language['mr_IN'] = 'Marathi - मराठी';
                                    $language['mn_MN'] = 'Mongolian - Монгол Улсын';
                                    $language['ne_NP'] = 'Nepali - नेपाली';
                                    $language['se_NO'] = 'Northern S?mi';
                                    $language['nb_NO'] = 'Norwegian (bokmal)';
                                    $language['nn_NO'] = 'Norwegian (nynorsk)';
                                    $language['ps_AF'] = 'Pashto';
                                    $language['fa_IR'] = 'Persian - فارسی';
                                    $language['pl_PL'] = 'Polish - Polskie';
                                    $language['pt_BR'] = 'Portuguese (Brazil)';
                                    $language['pt_PT'] = 'Portuguese (Portugal)';
                                    $language['pa_IN'] = 'Punjabi - ਪੰਜਾਬੀ';
                                    $language['qu_PE'] = 'Quechua';
                                    $language['ro_RO'] = 'Romanian - română';
                                    $language['rm_CH'] = 'Romansh';
                                    $language['ru_RU'] = 'Russian - русский';
                                    $language['sa_IN'] = 'Sanskrit';
                                    $language['sr_RS'] = 'Serbian - Српска';
                                    $language['zh_CN'] = 'Simplified Chinese (China) - 简体中文（中国)';
                                    $language['sk_SK'] = 'Slovak - slovenský';
                                    $language['sl_SI'] = 'Slovenian - slovenščina';
                                    $language['so_SO'] = 'Somali';
                                    $language['es_LA'] = 'Spanish - Español';
                                    $language['es_CL'] = 'Spanish (Chile)';
                                    $language['es_CO'] = 'Spanish (Colombia)';
                                    $language['es_MX'] = 'Spanish (Mexico)';
                                    $language['es_ES'] = 'Spanish (Spain)';
                                    $language['sv_SE'] = 'Swedish - svenska';
                                    $language['sy_SY'] = 'Syriac';
                                    $language['tg_TJ'] = 'Tajik';
                                    $language['ta_IN'] = 'Tamil - தமிழ்';
                                    $language['tt_RU'] = 'Tatar';
                                    $language['te_IN'] = 'Telugu - తెలుగు';
                                    $language['th_TH'] = 'Thai - ไทย';
                                    $language['zh_HK'] = 'Traditional Chinese (Hong Kong)';
                                    $language['zh_TW'] = 'Traditional Chinese (Taiwan)';
                                    $language['tr_TR'] = 'Turkish - türk';
                                    $language['uk_UA'] = 'Ukrainian - Український';
                                    $language['ur_PK'] = 'Urdu - اردو';
                                    $language['uz_UZ'] = 'Uzbek';
                                    $language['vi_VN'] = 'Vietnamese - Việt';
                                    $language['cy_GB'] = 'Welsh - Cymraeg';
                                    $language['xh_ZA'] = 'Xhosa';
                                    $language['yi_DE'] = 'Yiddish - ייִדיש';
                                    $language['zu_ZA'] = 'Zulu';
                                    ?>

                                    <select name="vifslb_like_use_plugin_lang">
                                        <?php
                                        $curmenutype = get_option('vifslb_like_use_plugin_lang');
                                        foreach ($language as $keynw => $valnw) {
                                            $selected = '';
                                            if ($vifslb_like_settings['language'] == $keynw)
                                                $selected = "selected";
                                            echo '<option value="' . $keynw . '" ' . $selected . ' >' . $valnw . '</option>';
                                        }
                                        ?>

                                    </select>
                            </tr>


                        </table>
                        <h3 class="title"><?php _e("Position Settings:", 'wp-fb-share-like-button'); ?></h3>
                        <table class="form-table admintbl">

                            <tr>
                                <th scope="row"><?php _e("Align:", 'wp-fb-share-like-button'); ?></th>
                                <td>
                                    <select name="vifslb_like_align">
                                        <?php
                                        $curmenutype = get_option('vifslb_like_align');
                                        foreach ($vifslb_like_aligns as $type) {
                                            echo "<option value=\"$type\"" . ($type == $curmenutype ? " selected" : "") . ">$type</option>";
                                        }
                                        ?>
                                    </select>	
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Show at Top:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="checkbox" name="vifslb_like_show_at_top" value="true" <?php echo (get_option('vifslb_like_show_at_top') == 'true' ? 'checked' : ''); ?>/></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Show at Bottom:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="checkbox" name="vifslb_like_show_at_bottom" value="true" <?php echo (get_option('vifslb_like_show_at_bottom') == 'true' ? 'checked' : ''); ?>/></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Show on Page:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="checkbox" name="vifslb_like_show_on_page" value="true" <?php echo (get_option('vifslb_like_show_on_page') == 'true' ? 'checked' : ''); ?>/></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Show on Post:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="checkbox" name="vifslb_like_show_on_post" value="true" <?php echo (get_option('vifslb_like_show_on_post') == 'true' ? 'checked' : ''); ?>/></td>
                            </tr>
                            <tr>

                                <th scope="row"><?php _e("Show on Home:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="checkbox" name="vifslb_like_show_on_home" value="true" <?php echo (get_option('vifslb_like_show_on_home') == 'true' ? 'checked' : ''); ?>/></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Show on Archive:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="checkbox" name="vifslb_like_show_on_archive" value="true" <?php echo (get_option('vifslb_like_show_on_archive') == 'true' ? 'checked' : ''); ?>/></td>
                            </tr>

                        </table>
                        <h3 class="title"><?php _e("Other Settings:", 'wp-fb-share-like-button'); ?></h3>
                        <table class="form-table admintbl">

                            <tr valign="top">
                                <th scope="row"><?php _e("Image URL:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="text" size="56" name="vifslb_like_facebook_image" value="<?php echo get_option('vifslb_like_facebook_image'); ?>" /></td>
                            </tr>

                            <tr valign="top">
                                <th scope="row"><?php _e("Type of embedding:", 'wp-fb-share-like-button'); ?></th>
                                <td><span class="vifslb_like_btntype"><input type="radio" name="vifslb_like_btntype" value="html5" <?php echo (get_option('vifslb_like_btntype') == 'html5' ? 'checked' : ''); ?> /><?php _e("HTML5", 'wp-fb-share-like-button'); ?></span>
<span class="vifslb_like_btntype"><input type="radio" name="vifslb_like_btntype" value="iframe" <?php echo (get_option('vifslb_like_btntype') == 'iframe' ? 'checked' : ''); ?> /><?php _e("IFRAME", 'wp-fb-share-like-button'); ?></span>
                                    
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e("Facebook App ID (Required):", 'wp-fb-share-like-button'); ?><br /><small><?php _e("To get an App ID:", 'wp-fb-share-like-button'); ?> <a href="http://developers.facebook.com/setup/" target="_blank"><?php _e("Create an  App", 'wp-fb-share-like-button'); ?></a></small></th>
                                <td><input type="text" size="35" name="vifslb_like_facebook_app_id" value="<?php echo get_option('vifslb_like_facebook_app_id'); ?>" /> <small><?php //_e("Required if using XFBML", 'wp-fb-share-like-button' );          ?></small></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e("Use Excerpt as Description:", 'wp-fb-share-like-button'); ?></th>
                                <td><input type="checkbox" name="vifslb_like_use_excerpt_as_description" value="true" <?php echo (get_option('vifslb_like_use_excerpt_as_description') == 'true' ? 'checked' : ''); ?>/></td>
                            </tr>

                            <tr>
                                <th scope="row"><?php _e("Type:", 'wp-fb-share-like-button'); ?></th>
                                <td>
                                    <select name="vifslb_like_type">
                                        <?php
                                        $curmenutype = get_option('vifslb_like_type');
                                        foreach ($vifslb_like_types as $type) {

                                            echo "<option value=\"$type\"" . ($type == $curmenutype ? " selected" : "") . ">$type</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr valign="top">
                                <?php ?> 
                                <th scope="row"><?php _e("Exclude Using Page/Post IDs", 'wp-fb-share-like-button'); ?><br>
                                    <small><?php _e("For exclude FB like button, please insert page/post ids separate them with commas, like  5, 21", 'wp-fb-share-like-button'); ?></small><br>
                                    <small><?php _e("Please don't use space between post/page IDs", 'wp-fb-share-like-button'); ?></small></th>


                                <td><input type="text" size="35" name="vifslb_like_excludepage" value="<?php echo get_option('vifslb_like_excludepage'); ?> " />
                                </td>
                            </tr>


                        </table>

                        <?php if (vifslb_get_wp_version() < 2.7) : ?>
                            <input type="hidden" name="action" value="update" />
                            <input type="hidden" name="page_options" value="vifslb_like_width, vifslb_like_height, vifslb_like_layout, vifslb_like_verb, vifslb_like_size, vifslb_like_align, vifslb_like_showfaces, vifslb_like_show_at_top, vifslb_like_show_at_bottom, vifslb_like_show_on_page, vifslb_like_show_on_post, vifslb_like_show_on_home, vifslb_like_facebook_image, vifslb_like_html5, vifslb_like_use_excerpt_as_description, vifslb_like_facebook_app_id, vifslb_like_type , vifslb_like_excludepage" />
                        <?php endif; ?>

                        <div class="submitform">
                            <input type="submit" name="Submit"  class="button1" value="<?php _e('Save Changes', 'wp-fb-share-like-button') ?>" />
                        </div>


                </form>

                <p><strong><?php _e("You can also use", 'wp-fb-share-like-button'); ?> [vifblike] shortcode <?php _e("for showing like button on a page/post.", 'wp-fb-share-like-button'); ?><strong> </p>
                            <p><?php _e("You can also use below option to override the settings used above for version type in shortcode.", 'wp-fb-share-like-button'); ?><br>
                                * btntype => html5/iframe<br>
                                <?php _e("For Example:", 'wp-fb-share-like-button'); ?><br>
                                [vifblike btntype="iframe"] => <?php _e("For iframe version.", 'wp-fb-share-like-button'); ?> </p>

</div> <!-- --------End of left div--------- -->
                            <div class="right">
                                <center>
                                    <div class="bottom">
                                        <h3 id="download-comments-wvpd" class="title"><?php _e('Download Free Plugins', 'wp-fb-share-like-button'); ?></h3>
                                        <div id="downloadtbl-comments-wvpd" class="togglediv">  
                                            <h3 class="company">
                                                <p><?php _e('Vivacity InfoTech Pvt. Ltd. is an ISO 9001:2015 Certified Company is a Global IT Services company with expertise in outsourced product development and custom software development with focusing on software development, IT consulting, customized development.We have 200+ satisfied clients worldwide.', 'wp-fb-share-like-button') ?> </p>	
                                                <?php _e('Our Top 5 Latest Plugins', 'wvpd'); ?>:
                                            </h3>
                                            <ul class="">
                                                <li><a target="_blank" href="https://wordpress.org/plugins/wp-twitter-feeds/"><?php _e("WP twitter feeds"); ?></a></li>
                                                <li><a target="_blank" href="https://wordpress.org/plugins/facebook-comment-by-vivacity/"><?php _e("Facebook Comments by Vivacity"); ?></a></li>
                                                <li><a target="_blank" href="https://wordpress.org/plugins/vi-random-posts-widget/"><?php _e("Vi Random Post Widget"); ?></a></li>
                                                <li><a target="_blank" href="https://wordpress.org/plugins/wp-infinite-scroll-posts/"><?php _e("WP EasyScroll Posts"); ?></a></li>
                                                <li><a target="_blank" href="http://wordpress.org/plugins/wp-fb-share-like-button/"><?php _e("WP Facebook Like Button", 'wp-fb-share-like-button'); ?></a></li>
                                            </ul>
                                        </div> 
                                    </div>		
                                    <div class="bottom">
                                        <h3 id="donatehere-comments-wvpd" class="title"><?php _e('Donate Here', 'wp-fb-share-like-button'); ?></h3>
                                        <div id="donateheretbl-comments-wvpd" class="togglediv">  
                                            <p><?php _e('If you want to donate , please click on below image.', 'wp-fb-share-like-button'); ?></p>
                                            <a href="http://vivacityinfotech.net/paypal-donation/" target="_blank"><img class="donate" src="<?php echo plugins_url('assets/paypal.gif', __FILE__); ?>" width="150" height="50" title="<?php _e('Donate Here', 'wp-fb-share-like-button'); ?>"></a>		
                                        </div> 
                                    </div>	
                                    <div class="bottom">
                                        <h3 id="donatehere-comments-wvpd" class="title"><?php _e('Woocommerce Frontend Plugin', 'wp-fb-share-like-button'); ?></h3>
                                        <div id="donateheretbl-comments-wvpd" class="togglediv">  
                                            <p><?php _e('If you want to purchase , please click on below image.', 'wp-fb-share-like-button'); ?></p>
                                            <a href="http://vivacityinfotech.net/paypal-donation/" target="_blank"><img class="donate" src="<?php echo plugins_url('assets/woo_frontend_banner.png', __FILE__); ?>" width="336" height="280" title="<?php _e('Donate Here', 'wp-fb-share-like-button'); ?>"></a>		
                                        </div> 
                                    </div>
                                    <div class="bottom">
                                        <h3 id="donatehere-comments-wvpd" class="title"><?php _e('Blue Frog Template', 'wp-fb-share-like-button'); ?></h3>
                                        <div id="donateheretbl-comments-wvpd" class="togglediv">  
                                            <p><?php _e('If you want to purchase , please click on below image.', 'wp-fb-share-like-button'); ?></p>
                                            <a href="http://vivacityinfotech.net/paypal-donation/" target="_blank"><img class="donate" src="<?php echo plugins_url('assets/blue_frog_banner.png', __FILE__); ?>" width="336" height="280" title="<?php _e('Donate Here', 'wp-fb-share-like-button'); ?>"></a>		
                                        </div> 
                                    </div>
                                </center>
                            </div>
                            <!-- --------End of right div--------- -->
                            </div> <!-- --------End of inner_wrap--------- -->


                            </div> <!-- ---------End of wrap-------- --> 
                            <?php
                        }

                        vifslb_like_init();
                        add_filter('plugin_row_meta', 'vifslb_add_meta_links_wpfblsw', 10, 2);

                        function vifslb_add_meta_links_wpfblsw($links, $file) {
                            if (strpos($file, 'wp-fb-share-like-button.php') !== false) {
                                $links[] = '<a href="http://wordpress.org/support/plugin/wp-fb-share-like-button">Support</a>';
                                $links[] = '<a href="http://vivacityinfotech.net/paypal-donation/">Donate</a>';
                            }
                            return $links;
                        }

             function vifslb_like_short($fblikesrt) {
                            global $vifslb_like_settings;
                            global $appids;
                            extract(shortcode_atts(array(
                                "url" => get_permalink(),
                                            ), $fblikesrt));
                            if (!empty($fblikesrt)) {
                                foreach ($fblikesrt as $key => $option) {
                                    $key;
                                    $fblikecode[$key] = $option;
                                }
                            }

                            $content = '';

                            $pages = get_option('vifslb_like_excludepage');
                            $pages1 = explode(',', $pages);

                            if (!empty($pages)) {
                                foreach ($pages1 as $page) {
                                    if (is_page($page) && $vifslb_like_settings['showonpage']) {
                                        return 0;
                                    } elseif (is_page() && !$vifslb_like_settings['showonpage']) {
                                        return 0;
                                    }
                                    if (is_single($page) && $vifslb_like_settings['showonpost']) {
                                        return 0;
                                    } elseif (is_single() && !$vifslb_like_settings['showonpost']) {
                                        return 0;
                                    }
                                }
                            }
                            $purl = get_permalink();

                            $button = "\n<!-- Facebook Like Button Vivacity Infotech BEGIN -->\n";

                            $showfaces = ($vifslb_like_settings['showfaces'] == 'true') ? "true" : "false";
                            $share = ($vifslb_like_settings['share'] == 'true') ? "true" : "false";

                            $url = urlencode($purl);

                            $separator = '&amp;';

                            $url = $url . $separator . 'width=' . $vifslb_like_settings['width']
                                    . $separator . 'layout=' . $vifslb_like_settings['layout']
                                    . $separator . 'action=' . $vifslb_like_settings['verb']
                                    . $separator . 'size=' . $vifslb_like_settings['size']
                                    . $separator . 'show_faces=' . $showfaces
                                    . $separator . 'share=' . $share
                                    . $separator . 'height=' . $vifslb_like_settings['height']
                                    . $separator . 'appId=' . $appids;
                            $align = $vifslb_like_settings['align'] == 'right' ? 'right' : 'left';


                            if ($fblikecode['btntype'] == "iframe") {
                                $button .= '<iframe src="http://www.facebook.com/plugins/like.php?href=' . $url . '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:' . $vifslb_like_settings['width'] . 'px; height: ' . $vifslb_like_settings['height'] . 'px; align: ' . $align . ';"></iframe>'; 
                            } else if ($fblikecode['btntype'] == "html5") {
                               $button .= '<div class="fb-like" data-href="' . $purl . '" data-layout="' . $vifslb_like_settings['layout'] . '" data-action="' . $vifslb_like_settings['verb'] . '" data-show-faces="' . $showfaces . '" data-size="' . $vifslb_like_settings['size'] . '" data-width="' . $vifslb_like_settings['width'] . '" data-share="' . $vifslb_like_settings['share'] . '" ></div>'; 
                            } else if ($vifslb_like_settings['html5'] == 'true') {
                              $button .= '<div class="fb-like" data-href="' . $purl . '" data-layout="' . $vifslb_like_settings['layout'] . '" data-action="' . $vifslb_like_settings['verb'] . '" data-show-faces="' . $showfaces . '" data-size="' . $vifslb_like_settings['size'] . '" data-width="' . $vifslb_like_settings['width'] . '" data-share="' . $vifslb_like_settings['share'] . '" ></div>'; 
                            } else {
                               $button .= '<iframe src="http://www.facebook.com/plugins/like.php?href=' . $url . '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:' . $vifslb_like_settings['width'] . 'px; height: ' . $vifslb_like_settings['height'] . 'px; align: ' . $align . ';"></iframe>'; 
                            }
                            if ($align == 'right') {
                                $button = '<div class="like-button" style="float: right; clear: both; text-align: right; width = 100%;">' . $button . '</div>';
                            }
                            $button .= "\n<!-- Facebook Like Button Vivacity Infotech END -->\n";
                            return $button;
                        }

                        add_shortcode('vifblike', 'vifslb_like_short'); ?>