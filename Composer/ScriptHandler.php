<?php

/*
 *
 * Ariel Ferrandini
 * arielferrandini@gmail.com
 *
 */

namespace Ferrandini\Composer;

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
            echo 'The symfony-app-dir ('.$appDir.') specified in composer.json was not found in '.getcwd().', can not install bin utils.'.PHP_EOL;

            return;
        }

        $binDir = $options['symfony-app-dir'].DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bin';

        if (!is_dir($binDir)) {
            echo 'Creating /bin dir.'.PHP_EOL;

            if (!mkdir($binDir)) {
                echo 'Cannot create /bin dir.'.PHP_EOL;

                return;
            }
        }

        if (!is_writable($binDir)) {
            echo '/bin dir is not writable.'.PHP_EOL;
        }

        echo "Installing bin/fixperms script.".PHP_EOL;
        $fixperms_gist_url = 'https://raw.github.com/gist/4087091/e9827573fb3cc0675d63975ec104e9e63103b2ae/fixperms';
        $fixperms = file_get_contents($fixperms_gist_url);
        file_put_contents($binDir.DIRECTORY_SEPARATOR.'fixperms', $fixperms);
        chmod($binDir.DIRECTORY_SEPARATOR.'fixperms', 0755);

        echo "Installing bin/clearcache script.".PHP_EOL;
        $clearcache_gist_url = 'https://raw.github.com/gist/4088354/f34d91df3e81df9eba8e4d94f1c0c80180f514cd/clearcache';
        $clearcache = file_get_contents($clearcache_gist_url);
        file_put_contents($binDir.DIRECTORY_SEPARATOR.'clearcache', $clearcache);
        chmod($binDir.DIRECTORY_SEPARATOR.'clearcache', 0755);

    }

    protected static function getOptions($event)
    {
        $options = array_merge(array(
            'symfony-app-dir' => 'app',
            'symfony-web-dir' => 'web',
            'symfony-assets-install' => 'hard'
            ), $event->getComposer()->getPackage()->getExtra());

        $options['symfony-assets-install'] = getenv('SYMFONY_ASSETS_INSTALL') ?: $options['symfony-assets-install'];

        $options['process-timeout'] = $event->getComposer()->getConfig()->get('process-timeout');
        return $options;
    }
}
