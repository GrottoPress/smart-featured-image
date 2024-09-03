<?php
declare (strict_types = 1);

namespace GrottoPress;

use GrottoPress\SmartFeaturedImage\Setups;
use GrottoPress\SmartFeaturedImage\Utilities;
use GrottoPress\WordPress\SUV\AbstractPlugin;

final class SmartFeaturedImage extends AbstractPlugin
{
    /**
     * @var Utilities
     */
    private $utilities;

    /**
     * @var array<string, string>
     */
    private $meta;

    protected function __construct()
    {
        $this->setUpActivation();
        $this->setUpTranslations();
        $this->setUpOptionizer();
        $this->setUpFeaturedImage();
    }

    protected function getUtilities(): Utilities
    {
        return $this->utilities = $this->utilities ?: new Utilities($this);
    }

    /**
     * @return array<string, string>
     */
    protected function getMeta(): array
    {
        return $this->meta = $this->meta ?: $this->meta();
    }

    private function setUpActivation()
    {
        $this->setups['Activator'] = new Setups\Activator($this);
        $this->setups['Deactivator'] = new Setups\Deactivator($this);
    }

    private function setUpTranslations()
    {
        $this->setups['Translations\Core'] =
            new Setups\Translations\Core($this);
        $this->setups['Translations\Field'] =
            new Setups\Translations\Field($this);
    }

    private function setUpOptionizer()
    {
        $this->setups['Optionizer'] = new Setups\Optionizer($this);
    }

    private function setUpFeaturedImage()
    {
        $this->setups['FeaturedImage'] = new Setups\FeaturedImage($this);
        $this->setups['DefaultFeaturedImage'] =
            new Setups\DefaultFeaturedImage($this);
    }

    /**
     * @return array<string, string>
     */
    private function meta(): array
    {
        $data = \array_map(
            'sanitize_text_field',
            \get_file_data(SFI_PLUGIN_PATH, [
                'domain_path' => 'Domain Path',
                'name' => 'Plugin Name',
                'text_domain' => 'Text Domain',
            ], 'plugin')
        );

        $data['slug'] = \sanitize_title($data['name']);

        return $data;
    }
}
