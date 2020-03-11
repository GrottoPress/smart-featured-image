<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups\Optionizer;

use GrottoPress\SmartFeaturedImage\Setups\Optionizer;
use GrottoPress\WordPress\SUV\Setups\Optionizer\AbstractSection;

final class DefaultFeaturedImage extends AbstractSection
{
    public function __construct(Optionizer $optionizer)
    {
        parent::__construct($optionizer);

        $this->id = "{$this->optionizer->app->meta['slug']}-default-featured-image-section";
        $this->page = 'media';

        $this->callback = function () {
            echo '<p>'.\esc_html__(
                'Select the default featured image for each post type.',
                'smart-featured-image'
            ).'</p>';
        };

        $this->label = \esc_html__(
            'Default Featured Image',
            'smart-featured-image'
        );
    }

    public function add()
    {
        $post_types = $this->optionizer
            ->app
            ->utilities
            ->featuredImage
            ->postTypes();

        foreach ($post_types as $post_type) {
            $this->settings["PostType_{$post_type->name}"] =
                new DefaultFeaturedImage\Settings\PostType($this, $post_type);

            $this->fields["PostType_{$post_type->name}"] =
                new DefaultFeaturedImage\Fields\PostType($this, $post_type);
        }

        parent::add();
    }
}
