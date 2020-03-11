<?php
declare (strict_types = 1);

namespace GrottoPress\
    SmartFeaturedImage\
    Setups\
    Optionizer\
    DefaultFeaturedImage\
    Fields;

use GrottoPress\SmartFeaturedImage\Setups\Optionizer\DefaultFeaturedImage;
use WP_Post_Type;

final class PostType extends AbstractField
{
    public function __construct(
        DefaultFeaturedImage $section,
        WP_Post_Type $post_type
    ) {
        parent::__construct($section);

        $this->id = $section->settings["PostType_{$post_type->name}"]->id;
        $this->label = $post_type->labels->singular_name;
        $this->page = 'media';
        $this->section = $section->id;
        $this->callback = $this->callback($post_type, $section);
    }

    private function callback(
        WP_Post_Type $post_type,
        DefaultFeaturedImage $section
    ): callable {
        return function (array $args) use ($post_type, $section) {
            $utilities = $section->optionizer->app->utilities;
            $value = $utilities->defaultFeaturedImage
                ->option($post_type->name)
                ->get();

            echo $utilities->field([
                'id' => \esc_attr($this->id),
                'class' => 'regular-text',
                'name' => \esc_attr($this->id),
                'type' => 'media',
                'value' => \esc_attr($value),
            ])->render();
        };
    }
}
