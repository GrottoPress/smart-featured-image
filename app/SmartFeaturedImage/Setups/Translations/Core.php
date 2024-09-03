<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups\Translations;

use GrottoPress\WordPress\SUV\Setups\Translations\AbstractTranslation;
use GrottoPress\SmartFeaturedImage;

final class Core extends AbstractTranslation
{
    public function __construct(SmartFeaturedImage $plugin)
    {
        parent::__construct($plugin);

        $this->textDomain = $this->app->meta['text_domain'];
    }

    public function run()
    {
        \add_action('plugins_loaded', [$this, 'loadTextDomain' ]);
    }

    /**
     * @action plugins_loaded
     */
    public function loadTextDomain()
    {
        \load_plugin_textdomain(
            $this->textDomain,
            false,
            \basename(\dirname(SFI_PLUGIN_PATH)).$this->app->meta['domain_path']
        );
    }
}
