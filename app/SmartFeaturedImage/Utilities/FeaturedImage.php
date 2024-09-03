<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Utilities;

use GrottoPress\SmartFeaturedImage\Utilities;
// use GrottoPress\Getter\GetterTrait;

class FeaturedImage
{
    // use GetterTrait;

    /**
     * @var Utilities
     */
    private $utilities;

    public function __construct(Utilities $utilities)
    {
        $this->utilities = $utilities;
    }

    /**
     * @return \WP_Post_Types[string]
     */
    public function postTypes(): array
    {
        $post_types = \get_post_types(['public' => true], 'objects');

        $thumbnail_post_types = [];

        foreach ($post_types as $post_type) {
            if (!\post_type_supports($post_type->name, 'thumbnail')) {
                continue;
            }

            $thumbnail_post_types[$post_type->name] = $post_type;
        }

        return $thumbnail_post_types;
    }
}
