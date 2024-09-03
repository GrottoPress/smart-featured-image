<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups\Optionizer\DefaultFeaturedImage\Fields;

use GrottoPress\WordPress\SUV\Setups\Optionizer\AbstractField as Field;
use GrottoPress\SmartFeaturedImage\Setups\Optionizer\DefaultFeaturedImage;
use WP_Post_Type;

abstract class AbstractField extends Field
{
    public function __construct(DefaultFeaturedImage $section)
    {
        parent::__construct($section->optionizer);

        $this->capability = ''; // Already taken care of in the section
    }
}
