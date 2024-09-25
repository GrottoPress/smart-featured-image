<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

final class FeaturedImage extends AbstractSetup
{
    public function run()
    {
        \add_action('save_post', [$this, 'set']);
        \add_action('edit_attachment', [$this, 'set']);

        \add_action('the_post', [$this, 'set']);
        \add_action('draft_to_publish', [$this, 'set']);
        \add_action('new_to_publish', [$this, 'set']);
        \add_action('pending_to_publish', [$this, 'set']);
        \add_action('future_to_publish', [$this, 'set']);
    }

    /**
     * Set featured image.
     *
     * Image to use when featured image not set:
     *
     * - Use first attached image in post OR
     * - Use first image src in post content OR
     * - Use default featured image
     *
     * @action the_post
     * @action new_to_publish
     * @action draft_to_publish
     * @action pending_to_publish
     * @action future_to_publish
     *
     * @action save_post
     * @action edit_attachment
     *
     * @param int|\WP_Post $post
     */
    public function set($post)
    {
        $post = \get_post($post);

        if ('publish' != $post->post_status) return;
        if (\has_post_thumbnail($post->ID)) return;
        if (\wp_is_post_revision($post->ID)) return;
        if (!\post_type_supports($post->post_type, 'thumbnail')) return;

        $post_util = $this->app->utilities->post($post);

        if ($post_util->disableSmartFeaturedImage()) return;

        if ($attached_images = $post_util->getAttachedImages()) {
            foreach($attached_images as $attachment_id => $attachment) {
                \set_post_thumbnail($post->ID, $attachment_id);
                break;
            }
        } elseif ($image_id = $post_util->getFirstImageID()) {
            \set_post_thumbnail($post->ID, $image_id);
        }
    }
}
