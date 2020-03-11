<?php

/**
 * @wordpress-plugin
 * Plugin Name: Smart Featured Image
 * Plugin URI: https://www.grottopress.com/tutorials/smart-featured-image-wordpress-plugin/
 * Description: Automagically add featured image to posts using images inserted into post content. Displays a configurable default image if none found.
 * Version: 0.2.4
 * Author: GrottoPress.com
 * Author URI: https://www.grottopress.com
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: smart-featured-image
 * Domain Path: /lang
 */

/**
 * IMPORTANT: Keep code in this file compatible with PHP 5.2
 */

!defined('WPINC') && exit;

require __DIR__.'/constants.php';

if (version_compare(PHP_VERSION, SFI_MIN_PHP, '<') ||
    version_compare(get_bloginfo('version'), SFI_MIN_WP, '<')
) {
    add_action('admin_notices', 'printSmartFeaturedImageNotice');

    deactivateSmartFeaturedImage();
} else {
    require __DIR__.'/vendor/autoload.php';

    add_action('plugins_loaded', 'runSmartFeaturedImage', 0);
}

function runSmartFeaturedImage()
{
    SmartFeaturedImage()->run();
}

function printSmartFeaturedImageNotice()
{
    echo '<div class="notice notice-error">
        <p>'.
        sprintf(
            esc_html__(
                '%1$s plugin has been deactivated as it requires PHP >= %2$s and WordPress >= %3$s',
                'smart-featured-image'
            ),
            '<code>smart-featured-image</code>',
            '<strong>'.SFI_MIN_PHP.'</strong>',
            '<strong>'.SFI_MIN_WP.'</strong>'
        ).
        '</p>
    </div>';
}

function deactivateSmartFeaturedImage()
{
    deactivate_plugins(SFI_PLUGIN_BASENAME);
}
