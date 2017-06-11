=== Smart Featured Image ===
Contributors: grottopress, attakusiadusei
Donate link: 
Tags: featured-image, post-thumbnail
Requires at least: 4.0
Tested up to: 4.8
Stable tag: 0.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automagically add featured image to posts using images inserted into post content, if no featured image is explicitly added to post.

== Description ==

**IMPORTANT:** *This plugin requires **PHP** version **5.3** or newer. We recommend **PHP** version **7.0** or newer.*

*Smart Featured Image* is a WordPress plugin to automagically add featured image to posts using images inserted into post content, if no featured image is explicitly added to post.

The plugin displays a configurable fallback image if no featured image is found.

The default (fallback) image settings are available via the *Media Settings* screen ('**Settings**' -> '**Media**') in the WordPress administration area. There are options to set the default featured image for each public post type.

*Smart Featured Image* works by:

1. Checking if a featured image was added to the post.
1. If no featured image was added, the plugin looks for images attached to the post (ie images uploaded to the current post). If found, the first attached image is saved as the post's featured image.
1. If no image was attached to the post, the plugin looks for an image inserted into the post content, but not necessary attached to the post. If found, the first local image inserted is saved as featured image.
1. If all of the above fail, the plugin falls back to the default featured image set for the post type in question under the *Default Featured Image* section of the *Media Settings* screen.

You'll notice that, in step 4 above, the plugin **does not save** the default featured image as the featured image. Rather, it simply returns that image whenever a call to get the post thumbnail is made. This is the intended behaviour.

This means, any time the default featured image changes, all posts that used the previous default featured image would automatically use the new default featured image since the old one was never saved to the database as featured image.

Give *Smart Featured Image* a shot. You will love it.

== Installation ==

Follow the steps below to install the plugin:

1. Unzip and upload `smart-featured-image` to the `wp-content/plugins` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the *Default Featured Image* under '**Settings**' -> '**Media**'.

== Frequently Asked Questions ==

= How do I contribute to development =

The plugin's source code is on [Gitlab](https://gitlab.com/GrottoPress/smart-featured-image)

== Screenshots ==

1. The Default Featured Image section on the Media Settings screen.

== Changelog ==

= 0.1.1 =
- Fixed typo in README.txt

= 0.1.0 =
- Initial public release