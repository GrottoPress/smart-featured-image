<?php

/**
 * IMPORTANT: Keep code in this file compatible with PHP 5.2
 */

!defined('WPINC') && exit;
!defined('WP_UNINSTALL_PLUGIN') && exit;

require __DIR__.'/constants.php';

if (version_compare(PHP_VERSION, SFI_MIN_PHP, '<') ||
    version_compare(get_bloginfo('version'), SFI_MIN_WP, '<')
) {
    return;
}

if (!current_user_can('activate_plugins')) {
	wp_die(esc_html__(
        'You are not allowed to perform this action!',
        'smart-featured-image'
    ));
}

require __DIR__.'/vendor/autoload.php';

$post_types = SmartFeaturedImage()->utilities->featuredImage->postTypes();

if (is_multisite()) {
	$blogs = get_sites(array('number' => -1));

	foreach ($blogs as $blog) {
		switch_to_blog($blog->blog_id);
		deleteSmartFeaturedImageOptions($post_types);
	}

	restore_current_blog();
} else {
	deleteSmartFeaturedImageOptions($post_types);
}

function deleteSmartFeaturedImageOptions($post_types)
{
    foreach ($post_types as $post_type) {
		SmartFeaturedImage()->utilities->options
            ->defaultFeaturedImage($post_type->name)
            ->delete();
	}
}
