<?php

/*
 *
 * Ariel Ferrandini
 * arielferrandini@gmail.com
 *
 */

namespace Ferrandini\Composer;

use Symfony\Component\ClassLoader\ClassCollectionLoader;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpExecutableFinder;

/**
 * @author Ariel Ferrandini
 */
class ScriptHandler
{
    public static function installBinUtils($event)
    {
        $options = self::getOptions($event);
        $appDir = $options['symfony-app-dir'];

        if (!is_dir($appDir)) {
            echo 'The symfony-app-dir ('.$appDir.') specified in composer.json was not found in '.getcwd().', can not clear the cache.'.PHP_EOL;

            return;
        }

        var_dump($event);
        die();

        static::executeCommand($event, $appDir, 'cache:clear --no-warmup', $options['process-timeout']);
    }
}
