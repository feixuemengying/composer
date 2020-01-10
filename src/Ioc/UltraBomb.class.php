<?php
namespace Ioc;

use Ioc\SuperModuleInterface;

/**
 * 超级炸弹-超能力
 */
class UltraBomb implements SuperModuleInterface
{
    public function activate(array $target)
    {
        echo "UltraBomb".PHP_EOL;
        var_dump($target);
    }
}