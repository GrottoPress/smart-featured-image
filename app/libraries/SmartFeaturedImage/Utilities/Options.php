<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Utilities;

use GrottoPress\SmartFeaturedImage\Utilities;
use GrottoPress\Getter\GetterTrait;

class Options
{
    use GetterTrait;

    /**
     * @var Utilities
     */
    private $utilities;

    public function __construct(Utilities $utilities)
    {
        $this->utilities = $utilities;
    }

    private function getUtilities(): Utilities
    {
        return $this->utilities;
    }

    public function defaultFeaturedImage(
        string $post_type
    ): Options\DefaultFeaturedImage {
        return new Options\DefaultFeaturedImage($this, $post_type);
    }
}
