<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups;

use GrottoPress\WordPress\SUV\Setups\Optionizer\AbstractOptionizer;

final class Optionizer extends AbstractOptionizer
{
   public function run()
    {
        \add_action('admin_menu', [$this, 'add']);
        \add_action('admin_enqueue_scripts', [$this, 'enqueueMedia']);
    }

    /**
     * @action admin_menu
     */
    public function add()
    {
        $this->sections['DefaultFeaturedImage'] =
            new Optionizer\DefaultFeaturedImage($this);

        parent::add();
    }

    /**
     * @action admin_enqueue_scripts
     */
    public function enqueueMedia(string $suffix)
    {
        if ('options-media.php' != $suffix) {
            return;
        }

        \wp_enqueue_media();
    }
}
