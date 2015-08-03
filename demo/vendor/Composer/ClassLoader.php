<?php
namespace Composer\AutoLoad;

class ClassLoader {
    private $prefixDir;

    public function __CONSTRUCT() {
        $this->register();
    }
    public function register() {
        spl_autoload_register(array($this, 'loader'), true);
    }

    public function loader($name) {
        $file = $this->getFile($name);
        include $file;
    }

    public function set($prefix, $path) {
        $this->prefixDir[$prefix] = $path;
    }

    private function getFile($name) {
        $arr = explode("\\", $name);
        $prefix = $arr[0];
        $count = count($arr)-1;
        $fileName = $arr[$count];
        unset($arr[0]);
        unset($arr[$count]);
        $path = $arr ? implode('/', $arr) : '';
        $prePath = $this->prefixDir[$prefix];

        return $prePath.'/'.$path.'/'.$fileName.'.php';
    }
}
