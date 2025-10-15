<?php

declare(strict_types=1);

/**
 *  ################
 *  ##            ##    Copyright (c) 2025 Wvnderlab Agency
 *  ##
 *  ##   ##  ###  ##    ✉️ moin@wvnderlab.com
 *  ##    #### ####     🔗 https://wvnderlab.com
 *  #####  ##  ###
 */

namespace WvnderlabAgency\CodeStyles;

/**
 * The **Composer** class.
 *
 * This class is responsible for publishing configuration files to the packages.
 *
 * @package wvnderlab-agency/php-code-styles
 * @since   0.2.0
 */
final readonly class Composer
{
    /**
     * The callback for the `post-install-cmd` Composer script.
     *
     * @return void
     */
    public static function install(): void
    {
        // target: .editorconfig.php
        self::publishStubFile('.editorconfig');
        // target: .php-cs-fixer.php
        self::publishStubFile('.php-cs-fixer.php.dist', '.php-cs-fixer.php');
        // target: phpstan.neon
        self::publishStubFile('phpstan.neon.dist', 'phpstan.neon');
        // target: rector.php
        self::publishStubFile('rector.php.dist', 'rector.php');
    }

    /**
     * The callback for the `post-update-cmd` Composer script.
     *
     * @return void
     */
    public static function update(): void
    {
        self::install();
    }

    /**
     * Copies a configuration file from the source to the target path.
     *
     * @param string $source The source path of the configuration file.
     * @param string|null $target The target path where the configuration file should be copied. If null, it defaults to the current working directory with the same name as the source file.
     * @param bool $overwrite Whether to overwrite the existing file if it exists.
     * @return void
     */
    protected static function publishStubFile(string $source, ?string $target = null, bool $overwrite = false): void
    {
        $root = __DIR__ . DIRECTORY_SEPARATOR . '..';
        $stubsDir = $root . DIRECTORY_SEPARATOR . '.stubs';
        $stubSubDir = match (true) {
            self::isLaravelProject() => DIRECTORY_SEPARATOR . 'laravel',
            self::isSymfonyProject() => DIRECTORY_SEPARATOR . 'symfony',
            default => ''
        };
        $stub = $stubsDir . $stubSubDir . DIRECTORY_SEPARATOR . $source;

        $target = $target
            ? getcwd() . DIRECTORY_SEPARATOR . $target
            : getcwd() . DIRECTORY_SEPARATOR . basename($stub);

        if ($overwrite || !file_exists($target)) {
            echo copy($stub, $target)
                ? '[Wvnderlab] Success: Copied ' . basename($target) . ' to project root.' . PHP_EOL
                : '[Wvnderlab] Error: Could not copy ' . basename($target) . ' to project root.' . PHP_EOL;
        }
        else {
            echo '[Wvnderlab] Notice: ' . basename($target) . ' already exists. Skipping copy.' . PHP_EOL;
        }
    }

    /**
     * Determine if the current project is a Laravel project.
     *
     * @return bool
     */
    protected static function isLaravelProject(): bool
    {

        return file_exists(getcwd() . DIRECTORY_SEPARATOR . 'artisan')
            && file_exists(getcwd() . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'app.php');
    }

    /**
     * Determine if the current project is a Symfony project.
     *
     * @return bool
     */
    protected static function isSymfonyProject(): bool
    {

        return (file_exists(getcwd() . DIRECTORY_SEPARATOR . 'bin') && is_dir(getcwd() . DIRECTORY_SEPARATOR . 'bin'))
            && (file_exists(getcwd() . DIRECTORY_SEPARATOR . 'config') && is_dir(getcwd() . DIRECTORY_SEPARATOR . 'config'));
    }
}
