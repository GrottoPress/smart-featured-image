# Smart Featured Image WordPress Plugin

* Author: [@GrottoPress](https://gitlab.com/grottopress)
* Author Website: [https://www.grottopress.com](https://www.grottopress.com)
* Contributor(s): [@akadusei](https://gitlab.com/akadusei)
* License: [GNU General Public License v2.0 or later](http://www.gnu.org/licenses/gpl-2.0.html)

## Description

**IMPORTANT:** *This plugin requires **PHP** version **5.3** or newer. We recommend **PHP** version **7.0** or newer.*

*Smart Featured Image* is a WordPress plugin to automagically add featured image to posts using images inserted into post content, if no featured image is explicitly added to post.

The plugin dynamically displays a configurable fallback image if no featured image is found.

The default (fallback) image settings are available via the *Media Settings* screen ('**Settings**' -> '**Media**') in the WordPress administration area. There are options to set the default featured image for each public post type.

*Smart Featured Image* works by:

1. Checking if a featured image was added to the post.
1. If no featured image was added, the plugin looks for images attached to the post (ie images uploaded to the current post). If found, the first attached image is saved as the post's featured image.
1. If no image was attached to the post, the plugin looks for an image inserted into the post content, but not necessary attached to the post. If found, the first local image inserted is saved as featured image.
1. If all of the above fail, the plugin falls back to the default featured image set for the post type in question under the *Default Featured Image* section of the *Media Settings* screen.

**Note** that the plugin **does not save** the default featured image as the featured image. Rather, it simply returns that image whenever a call to get the post thumbnail is made.

This means, any time the default featured image changes, all posts that used the previous default featured image would automatically use the new default featured image since the old one was never saved to the database as featured image.

Give *Smart Featured Image* a shot. You will love it.