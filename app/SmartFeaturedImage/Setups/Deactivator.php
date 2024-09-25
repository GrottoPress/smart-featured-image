<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

final class Deactivator extends AbstractSetup
{
    public function run()
    {
        \register_deactivation_hook(
            \SFI_PLUGIN_PATH,
            [$this, 'checkCapability']
        );

        \register_deactivation_hook(
            \SFI_PLUGIN_PATH,
            [$this, 'checkAdminReferrer']
        );
    }

    /**
     * @action deactivate_smart-featured-image/smart-featured-image.php
     */
    public function checkCapability()
    {
        if (\current_user_can('activate_plugins')) return;

        \wp_die(\esc_html__(
            'You are not allowed to perform this action!',
            'smart-featured-image')
        );
    }

    /**
     * @action deactivate_smart-featured-image/smart-featured-image.php
     */
    public function checkAdminReferrer()
    {
        if (isset($_GET['plugin'])) {
            \check_admin_referer("deactivate-plugin_{$_GET['plugin']}");
        } else {
            \check_admin_referer('bulk-plugins');
        }
    }
}
