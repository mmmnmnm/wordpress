=== WP Facebook Like Button ===
Contributors: vivacityinfotech.jaipur
Donate link: http://vivacityinfotech.net/paypal-donation/
Tags: Facebook Like Button, Facebook button, Like button, Social Plugin, Facebook Like, Like, Share, Facebook, Like, Button, Social, Bookmark,Social Sharing, Sharing, Bookmarking, Open Graph, Opengraph, Protocol, html5, iframe, like shortcode.
Requires at least:3.5
Tested up to:4.6.1
Stable tag: 2.2
License: GPLv2 or later

== Description ==

A Simple Facebook Like Button for your posts/home/pages/archive.

Lets people like and share pages and content from your site back to their Facebook profile with one click, so all their friends can read them.

Now users can select the Locale (Language) in which they want the Facebook Like button to be displayed (Default is 'en_US').

You can also customize setting for following features:

* Option for select like button language from a bunch of different languages.
* You can hide /show facebook like button on posts/archive/pages/home.
* You can show facebook like button at the top and/or botton of content of your posts/home/pages/archive.
* You can set Facebook Like Button Align to the Left or Right of your posts/home/pages/archive.
* You can show Friend's faces under like button.
* You can customize Width and Height.
* You can set - Layout (standard, button_count, box_count or button).
* You can set - Verb to display (Like or Recommend).
* You can set - Size (small or large)
* Hide facebook Like button using "Exclude Page/Post IDs" from any page if "Show on page" or "Show on post" checkbox enabled for all pages/posts.
* You can show facebook like button on a page or post by using a shortcode [vifblike]
* Iframe and HTML5 versions of Facebook Like Button. 
* Included share button optional

= Translators =

* English(US) (en_Us) - [Team Vivacity](http://vivacityinfotech.net/)
* Serbian (sr_RS) - [Team Vivacity](http://vivacityinfotech.net/)

If you have created your own language pack, or have an update of an existing one, you can send [gettext PO and MO files](http://codex.wordpress.org/Translating_WordPress) to [us](http://vivacityinfotech.net/contact-us/) so that We can bundle it into this plugin.
You can download the latest [POT file](http://plugins.svn.wordpress.org/wp-fb-share-like-button/trunk/languages/wp-fb-share-like-button.pot), and [PO files in each language](http://plugins.svn.wordpress.org/wp-fb-share-like-button/tags/2.2/languages/).

= Rate Us / Feedback =

Please take the time to let us and others know about your experiences by leaving a review, so that we can improve the plugin for you and other users.

= Want More? =

If You Want more functionality or some modifications, just drop us a line what you want and We will try to add or modify the plugin functions.

If you like the plugin please [Donate here](http://vivacityinfotech.net/paypal-donation/). 

== Installation ==


1. Download the Wp facebook Like Button Plugin.(Fb-like zip file).
2. Extract it in the '/wp-content/plugins/' directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Customize the plugin in the Settings > Like-Settings menu.

Your Facebook App Id is required to show facebook Like Button on your site.
If you don't have any facebook app id and so please click on "<a href="https://developers.facebook.com/apps" target="_blank" >Create New App</a>".

You can also remove Facebook like button from some pages/posts , if "show on page" or "Show on post" checkbox enabled for pages/posts. For remove Facebook like button please insert page/post ids separate them with commas,[ like 5, 21] in "Exclude Using Page/Post IDs" field.

After customize plugin settings, please click on "Save Changes".


Visit our <a href="http://vivacityinfotech.net/wordpress/plugins/wp-facebook-like-button-by-vivacity/">demo page</a> for more information.


== Frequently Asked Questions ==

= How to adjust Facebook Button position on the page =

In WordPress admin panel go to "Settings", find the Like-settings and choose one of the listed positions: Show at Top, Show at Bottom Then click "Save Changes".

= After the plugin installation and settings adjustment on the settings page it is still not working =
You should click "Save Changes". Make sure that you got the message "Options Saved".
After saving your settings you should refresh your web page where the Facebook Button icon should be placed.

= How to hide Facebook Button position on any page/post if checkbox enabled for all pages/posts =

You can remove Facebook like button from some pages/posts , if "show on page" or "Show on post" checkbox enabled for pages/posts. For remove Facebook like button please insert page/post ids separate them with commas,[ like 5, 21] in "Exclude Using Page/Post IDs" field.

= How to change version type of embedding of Facebook like Button =
In plugin backend we have option("Type of embedding") for change version of like button.
You can also use below options to override the default setting used for version type in shortcode.
* btntype => html5/iframe
For Example:
 [vifblike btntype="iframe"] => For iframe version.

== Credits ==
* Thanks [facebook.com] for open graph api.


== Screenshots ==

1. WP Facebook Like Button plugin installed and appears in the plugins menu.
2. WP Facebook Like Button Appearance Settings Section.
3. WP Facebook Like Button Position Settings Section.
4. Displaying WP Facebook Like Button after your post.


== Changelog ==

= 2.2 =
* Resolved bugs to update show FB button options on posts/pages/home.
* Added Size option.
* Updated open graph api to latest 2.7
* Removed button colorsheme.
* Updated FB like button shortcode to [vifblike]
* Updated POT and PO/mo files for multi language support.
* Renamed plugin file name.
* Removed default plugin's App Id uses.
* Tested with latest WP version.
* Updated version type of embedding FB like button using iframe/html5. Removed xfbml from latest open graph api.
* Included share button optional.

= 2.1 =
* A bug of curl is resolved.

= 2.0 =
*Added option for custom post type ui.
*Compatible with Wordpress Latest Version 4.3.


= 1.9 =
* Updated version type of embedding FB like button using xfbml/iframe/html5.
* Updated shortcode parameter code for change version type of like button using shortcode.
* Updated pot/po/mo files for multi language support.

= 1.8 =
* feature is added for hiding like button on posts using post ids.
* Multi languages support.
* POT file added for translate plugin in your language.
* Added po/mo files for Serbian (sr_RS) language.


= 1.7 =
* Added a shortcode [like] option for showing like button on a page or post and Added a new layout option (button).

= 1.6 =
* A bug for displaying language code in bottom of website is resolved.

= 1.5 =
* corrected bugs for adding language features with many default themes.

= 1.4 =
* Added the feature to select language from a bunch of different languages.

= 1.3 =
* Stable version.

= 1.2 =
* A new feature is added for hiding like button on pages

= 1.1 =
* A bug of content not appearing is resolved.

= 1.0 =
* Intial Release of Plugin

Visit our <a
href="http://vivacityinfotech.net/wordpress/plugins/wp-facebook-like-button-by-vivacity/">demo page</a> for more information.

