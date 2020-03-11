<?php
declare (strict_types = 1);

namespace GrottoPress\
    SmartFeaturedImage\
    Setups\
    Optionizer\
    DefaultFeaturedImage\
    Settings;

use GrottoPress\WordPress\SUV\Setups\Optionizer\AbstractSetting as Setting;
use GrottoPress\SmartFeaturedImage\Setups\Optionizer\DefaultFeaturedImage;
use WP_Post_Type;

abstract class AbstractSetting extends Setting
{
    public function __construct(DefaultFeaturedImage $section)
    {
        parent::__construct($section->optionizer);

        $this->capability = ''; // Already taken care of in the section
    }
}
