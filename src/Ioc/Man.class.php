<?php
namespace Ioc;

use Ioc\SuperModuleInterface;

/**
 * 人
 */
class Man
{
    protected $module;

    public function __construct(SuperModuleInterface $module)
    {
        $this->module = $module;
    }
    /**s
     * 超能力
     */
    public function doSuper()
    {
        echo $this->module->activate([1,2]);
    }
}
