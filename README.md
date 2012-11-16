# Howto install Symfony2 Bin Utils #

Change your `composer.json` and this package as a requirement.

    "require": {
        ...
        "aferrandini/bins": "dev-master"
    }

Then add the execution scripts to run on post-install-cmd and post-update-cmd

    "scripts": {
        "post-install-cmd": [
            ...
            "Ferrandini\\Composer\\ScriptHandler::installBinUtils"
            ...
        ],
        "post-update-cmd": [
            ...
            "Ferrandini\\Composer\\ScriptHandler::installBinUtils"
            ...
        ]
    }

Finally run composer install or update:

    composer.phar install
    
    composer.phar update

