<?php

namespace Zend\Cache\Storage;

use Zend\Cache\PatternFactory;
use Sphp\Stdlib\Parser;
//echo realpath(__DIR__.'/../../cache');
$cache = new Adapter\Filesystem();
//print_r(Parser::fromFile('samiholck/config/cache.yml'));
$settings = ['ttl' => 1, 'cache_dir' => realpath(__DIR__.'/../../cache'),'dir_permission' => 493, 'file_permission' => 438];
$cache->setOptions($settings);

$plugin = new Plugin\ExceptionHandler(['throw_exceptions' => true]);
$cache->addPlugin($plugin);
$outputCache = PatternFactory::factory('output', [
            'storage' => $cache
        ]);
