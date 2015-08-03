<?php
namespace Halo;

abstract class Bootstrap {
    public static function loadconfig() {
        $config = new \Yaf_Config_Ini(__DIR__.'/../../conf/application.ini', 'product');
        \Yaf_Registry::set('config', $config);
    }

    public static function run() {
        self::loadconfig();
        $app  = new \Yaf_Application(__DIR__. "/../../conf/application.ini");
        $app->run();
    }
}
