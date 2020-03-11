<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

final class DefaultFeaturedImage extends AbstractSetup
{
    public function run()
    {
        \add_filter('get_post_metadata', [$this, 'set'], 10, 4);
        \add_filter('update_post_metadata', [$this, 'unsave'], 10, 5);
    }

    /**
     * @filter get_post_metadata
     *
     * @var mixed $metadata
     *
     * @return mixed
     */
    public function set(
        $metadata,
        int $post_id,
        string $meta_key,
        bool $single
    ) {
        if ('_thumbnail_id' != $meta_key) {
            return $metadata;
        }

        global $wpdb;

        $thumbnail_exists = $wpdb->get_var($wpdb->prepare(
            "SELECT meta_value FROM $wpdb->postmeta WHERE post_id=%d AND meta_key=%s",
            $post_id,
            $meta_key
        ));

        if ($thumbnail_exists) {
            return $metadata;
        }

        if (\wp_is_post_revision($post_id)) {
            return $metadata;
        }

        $post = \get_post($post_id);
        $post_util = $this->app->utilities->post($post);

        if ($post_util->contentHasImage()) {
            return $metadata;
        }

        if (!\post_type_supports($post->post_type, 'thumbnail')) {
            return $metadata;
        }

        if ('publish' != $post->post_status) {
            return $metadata;
        }

        if ($post_util->disableSmartFeaturedImage()) {
            return $metadata;
        }

        if ($image = $this->app
            ->utilities
            ->defaultFeaturedImage
            ->option($post->post_type)
            ->get()
        ) {
            return $image;
        }

        return $metadata;
    }

    /**
     * Never save default/fallback image as post thumbnail.
     *
     * Simply display it, without saving to database.
     * This would ensure that whenever we change the default (fallback)
     * image, all posts without featured image displays the new one, since
     * the old one was never saved as featured image for those posts.
     *
     * @filter update_post_metadata
     *
     * @param mixed $check
     * @param mixed $meta_value
     * @param mixed $previous_value
     *
     * @return mixed
     */
    function unsave(
        $check,
        int $post_id,
        string $meta_key,
        $meta_value,
        $previous_value
    ) {
        if ('_thumbnail_id' != $meta_key) {
            return $check;
        }

        if ($meta_value !=
            $this->app
                ->utilities
                ->defaultFeaturedImage
                ->option(\get_post_type($post_id))
                ->get()
        ) {
            return $check;
        }

        return false;
    }
}
