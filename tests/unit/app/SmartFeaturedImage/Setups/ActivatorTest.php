<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups;

use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;
use GrottoPress\WordPress\SUV\AbstractPlugin;
use GrottoPress\SmartFeaturedImage\AbstractTestCase;

class ActivatorTest extends AbstractTestCase
{
    public function testRun()
    {
        $register_activation_hook = FunctionMocker::replace(
            'register_activation_hook'
        );

        $title = new Activator(Stub::makeEmpty(AbstractPlugin::class));

        $title->run();

        $register_activation_hook->wasCalledWithOnce([
            \SFI_PLUGIN_PATH,
            [$title, 'checkCapability']
        ]);

        $register_activation_hook->wasCalledWithOnce([
            \SFI_PLUGIN_PATH,
            [$title, 'checkAdminReferrer']
        ]);
    }
}
