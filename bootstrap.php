<?php
require_once(__DIR__ . '/class/SplClassLoader.php');
SplClassLoader::bootstrap(array(
    'HasOffers' => __DIR__ . '/class',
    'Slim' => __DIR__ . '/class',
    'Httpful' => __DIR__ . '/class',
    'DashboardTm' => __DIR__. '/class',
    'HasOffersTests' => __DIR__ . '/tests',
    'DashboardTmTests' => __DIR__ . '/tests',
    'TestSuite' => __DIR__ . '/tests'
));

SplClassLoader::bootstrap(array(
    'Twig' => __DIR__ . '/class',
), '_');

require_once(__DIR__ . '/class/Propel/autoload.php');
require_once(__DIR__ . '/class/Slim/Extras/Views/Extension/TwigAutoloader.php');
?>
