# Howto install Symfony2 Bin Utils #

Change your `composer.json` and this package as a requirement.

    "aferrandini/bins"

Then add the execution scripts to run on post-install-cmd and post-update-cmd

    "post-install-cmd": [
        ...
        "Ferrandini\\Composer\\ScriptHandler::installBinUtils"
        ...
    ],
    "post-update-cmd": [
        ...
        "Ferrandini\\Composer\\ScriptHandler::installBinUtils"
        ...
    ],

Finally run composer install or update:

    composer.phar install

    composer.phar update

