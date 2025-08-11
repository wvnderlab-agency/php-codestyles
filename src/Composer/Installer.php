<?php declare(strict_types=1);

/**
 *  ################ 
 *  ##            ##     Copyright (c) 2025 Wvnderlab Agency
 *  ##                   
 *  ##   ##  ###  ##     ✉️ moin@wvnderlab.com
 *  ##    #### ####      🔗 https://wvnderlab.com
 *  #####  ##  ###   
 */

namespace WvnderlabAgency\CodeStyles\Composer;

/**
 * Installer class for Composer packages.
 */
final class Installer
{
    /**
     * Publishes the configuration files for the package.
     */
    public static function publishConfiguration(): void
    {
        self::publishConfigurationFile('.editorconfig');
        self::publishConfigurationFile('.php-cs-fixer.php.dist', '.php-cs-fixer.php');
    }

    /**
     * Copies a configuration file from the source to the target path.
     *
     * @param string $source The source path of the configuration file.
     * @param string|null $target The target path where the configuration file should be copied. If null, it defaults to the current working directory with the same name as the source file.
     * @param bool $overwrite Whether to overwrite the existing file if it exists.
     */
    protected static function publishConfigurationFile(string $source, ?string $target = null, bool $overwrite = false): void
    {
        $source = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $source;
        $target = $target
            ? getcwd() . DIRECTORY_SEPARATOR . $target
            : getcwd() . DIRECTORY_SEPARATOR . basename($source);

        if ($overwrite || !file_exists($target)) {
            echo copy($source, $target)
                ? '[Wvnderlab] Success: Copied ' . basename($target) . ' to project root.' . PHP_EOL
                : '[Wvnderlab] Error: Could not copy ' . basename($target) . ' to project root.' . PHP_EOL;
        }
    }
}
