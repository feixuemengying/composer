<?php
use Ioc\Container;
use Ioc\XPower;
use Ioc\UltraBomb;
use Ioc\Man;

spl_autoload_register(function($class){require_once str_replace("\\",DIRECTORY_SEPARATOR,__DIR__.'/'.$class.".class.php");});


$ioc_container = new Container();
$ioc_container ->bind("xp",function(){ return new XPower();});
$ioc_container ->bind("ub",function(){return new UltraBomb();});

$xp = $ioc_container->make("xp");

$ioc_container->bind("superman",function(Container $c,$super_name){return new Man($c->make($super_name));});

$superman = $ioc_container->make("superman",[$ioc_container,"xp"]);

$superman->doSuper();