<?php
namespace Ioc;

use Ioc\SuperModuleInterface;

/**
 * X-超能力
 */
class XPower implements SuperModuleInterface
{
    public function activate(array $target)
    {
        echo "XPower".PHP_EOL;
        var_dump($target);
    }
}