<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage;

use GrottoPress\SmartFeaturedImage;
use GrottoPress\Getter\GetterTrait;
use GrottoPress\WordPress\Form\Field;
use WP_Post;

class Utilities
{
    use GetterTrait;

    /**
     * @var SmartFeaturedImage
     */
    private $app;

    /**
     * @var Utitilties\DefaultFeaturedImage
     */
    private $defaultFeaturedImage;

    /**
     * @var Utitilties\FeaturedImage
     */
    private $featuredImage;

    /**
     * @var Utitilties\Options
     */
    private $options;

    public function __construct(SmartFeaturedImage $plugin)
    {
        $this->app = $plugin;
    }

    private function getApp(): SmartFeaturedImage
    {
        return $this->app;
    }

    private function getDefaultFeaturedImage(): Utilities\DefaultFeaturedImage
    {
        return $this->defaultFeaturedImage ?:
            new Utilities\DefaultFeaturedImage($this);
    }

    private function getFeaturedImage(): Utilities\FeaturedImage
    {
        return $this->featuredImage ?: new Utilities\FeaturedImage($this);
    }

    private function getOptions(): Utilities\Options
    {
        return $this->options ?: new Utilities\Options($this);
    }

    public function post(WP_Post $post): Utilities\Post
    {
        return new Utilities\Post($this, $post);
    }

    /**
     * @param mixed[string] $args
     */
    public function field(array $args): Field
    {
        return new Field($args);
    }
}
