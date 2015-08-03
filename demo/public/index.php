<?php
define('APPLICATION_PATH', __DIR__.'/../');
$loader = require(APPLICATION_PATH.'vendor/autoload.php');
$loader->set('Ss', APPLICATION_PATH.'common');
$loader->set('Halo', APPLICATION_PATH.'library/Halo');
Halo\Bootstrap::run();
