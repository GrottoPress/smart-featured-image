<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Utilities;

use GrottoPress\SmartFeaturedImage\Utilities;
// use GrottoPress\Getter\GetterTrait;

class DefaultFeaturedImage
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
     * @return WP_Post_Types[string]
     */
    public function option(string $post_type): Options\DefaultFeaturedImage
    {
        return $this->utilities->options->defaultFeaturedImage($post_type);
    }
}
