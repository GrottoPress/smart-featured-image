<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Utilities\Options;

use GrottoPress\SmartFeaturedImage\Utilities\Options;
use GrottoPress\WordPress\SUV\Utilities\Options\AbstractOption as Option;
use WP_Post_Type;

abstract class AbstractOption extends Option
{
    /**
     * @var Options
     */
    protected $options;

    public function __construct(Options $options)
    {
        $this->options = $options;
    }
}
