<?php
declare (strict_types = 1);

use GrottoPress\SmartFeaturedImage;

function SmartFeaturedImage(): SmartFeaturedImage
{
    return SmartFeaturedImage::getInstance();
}
