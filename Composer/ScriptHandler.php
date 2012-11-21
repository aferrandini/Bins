<?php

/*
  * @author Ariel Ferrandini <arielferrandini@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Ferrandini\Composer;

use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler as BaseHandler;

class ScriptHandler extends BaseHandler
{
    public static function installBinUtils($event)
    {
        $options = self::getOptions($event);
        $appDir = $options['symfony-app-dir'];

        if (!is_dir($appDir)) {
            $event->getIO()->write('The symfony-app-dir ('.$appDir.') specified in composer.json was not found in '.getcwd().', can not install bin utils.</error>');

            return;
        }

        $binDir = $options['symfony-app-dir'].DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bin';

        if (!is_dir($binDir)) {
            $event->getIO()->write('Creating /bin dir.');

            if (!mkdir($binDir)) {
                $event->getIO()->write('Cannot create /bin dir.');

                return;
            }
        }

        if (!is_writable($binDir)) {
            $event->getIO()->write('<error>/bin dir is not writable.</error>');
        }

        $event->getIO()->write('<info>Installing bin/fixperms script.</info>');
        $fixperms_gist_url = 'https://raw.github.com/gist/4087091/e9827573fb3cc0675d63975ec104e9e63103b2ae/fixperms';
        $fixperms = file_get_contents($fixperms_gist_url);
        file_put_contents($binDir.DIRECTORY_SEPARATOR.'fixperms', $fixperms);
        chmod($binDir.DIRECTORY_SEPARATOR.'fixperms', 0755);

        $event->getIO()->write('<info>Installing bin/clearcache script.</info>');
        $clearcache_gist_url = 'https://raw.github.com/gist/4088354/f34d91df3e81df9eba8e4d94f1c0c80180f514cd/clearcache';
        $clearcache = file_get_contents($clearcache_gist_url);
        file_put_contents($binDir.DIRECTORY_SEPARATOR.'clearcache', $clearcache);
        chmod($binDir.DIRECTORY_SEPARATOR.'clearcache', 0755);
    }

}