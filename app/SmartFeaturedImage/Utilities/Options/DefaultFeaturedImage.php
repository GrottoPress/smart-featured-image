<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Utilities\Options;

use GrottoPress\SmartFeaturedImage\Utilities\Options;
use GrottoPress\Getter\GetterTrait;

class DefaultFeaturedImage extends AbstractOption
{
    public function __construct(Options $options, string $post_type)
    {
        parent::__construct($options);

        $this->default = 0;
        $this->id = "{$this->options->utilities->app->meta['slug']}-{$post_type}-default-featured-image";
    }

    public function get(): int
    {
        $value = \absint(parent::get());

        return \wp_attachment_is_image($value) ? $value : $this->default;
    }
}
