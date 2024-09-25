<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Utilities;

use GrottoPress\SmartFeaturedImage\Utilities;
// use GrottoPress\Getter\GetterTrait;
use WP_Post;
use WP_Post_Types;

class Post
{
    // use GetterTrait;

    /**
     * @var Utilities
     */
    private $utilities;

    /**
     * @var WP_Post
     */
    private $object;

    public function __construct(Utilities $utilities, WP_Post $post)
    {
        $this->utilities = $utilities;
        $this->object = $post;
    }

    public function getFirstImageID(): int
    {
        return \attachment_url_to_postid($this->catchFirstImage());
    }

    public function contentHasImage(): bool
    {
        return $this->getAttachedImages() || $this->catchFirstImage();
    }

    public function disableSmartFeaturedImage()
    {
        return \get_post_meta(\absint($this->object->ID), 'no_sfi', true);
    }

    /**
     * @return WP_Post[]
     */
    public function getAttachedImages(): array
    {
        return \get_children([
            'post_parent' => $this->object->ID,
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'numberposts' => -1,
        ]);
    }

    private function catchFirstImage(): string
    {
        if (!($content = $this->object->post_content)) return '';

        \preg_match_all(
            '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
            $content,
            $matches
        );

        if (empty($matches[1])) return '';

        foreach ($matches[1] as $source) {
            $uploads_dir = \wp_upload_dir();
            $base_url = $uploads_dir['baseurl'] ?? '';

            if ($base_url && 0 === \stripos($source, $base_url)) {
                return \esc_url($source);
            }
        }

        return '';
    }
}
