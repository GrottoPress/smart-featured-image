<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups\Optionizer\DefaultFeaturedImage\Settings;

use GrottoPress\SmartFeaturedImage\Setups\Optionizer\DefaultFeaturedImage;
use WP_Post_Type;

final class PostType extends AbstractSetting
{
    public function __construct(
        DefaultFeaturedImage $section,
        WP_Post_Type $post_type
    ) {
        parent::__construct($section);

        $this->id = $section->optionizer
            ->app
            ->utilities
            ->defaultFeaturedImage
            ->option($post_type->name)->id;

        $this->group = 'media';
        $this->args = ['sanitize_callback' => 'absint'];
    }
}
