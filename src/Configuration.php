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

use InvalidArgumentException;
use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use WvnderlabAgency\CopyrightHeader\CopyrightHeaderFixer;

/**
 * The **Configuration** class.
 *
 * @package wvnderlab-agency/php-code-styles
 * @since   0.2.0
 */
final class Configuration extends Config
{
    private const string RULESET_GENERIC = __DIR__ . '/../.rules/.generic.php';
    public const string RULESET_LARAVEL = __DIR__ . '/../.rules/laravel.php';
    public const string RULESET_SYMFONY = __DIR__ . '/../.rules/symfony.php';

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->initializeFinder()
            ->registerCopyrightHeader()
            ->setDefaultCache()
            ->setGenericRuleset()
            ->setRiskyAllowed(true);
    }

    /**
     * Append .rules to the existing ruleset.
     *
     * @param array<string,mixed> $rules
     * @return static
     */
    public function appendRules(array $rules): static
    {
        $currentRules = $this->getRules();
        /** @var array<string, array<string, mixed>|bool> $newRules */
        $newRules = array_merge($currentRules, $rules);

        $this->setRules($newRules);

        return $this;
    }

    /**
     * Exclude directories from scanning.
     *
     * @param string|string[] $dirs
     * @return static
     */
    public function exclude(array|string $dirs): static
    {
        $this->getFinder()->exclude($dirs);

        return $this;
    }

    /**
     * Include directories for scanning.
     *
     * @param string|string[] $dirs
     * @return static
     */
    public function include(array|string $dirs): static
    {
        $this->getFinder()->in($dirs);

        return $this;
    }

    /**
     * Ignore dot files.
     *
     * @param bool $ignore
     * @return static
     */
    public function ignoreDotFiles(bool $ignore = true): static
    {
        $this->getFinder()->ignoreDotFiles($ignore);

        return $this;
    }

    /**
     * Ignore files and directories ignored by Git.
     *
     * @param bool $ignore
     * @return static
     */
    public function ignoreGitIgnored(bool $ignore = true): static
    {
        $this->getFinder()->ignoreVCS($ignore);
        $this->getFinder()->ignoreVCSIgnored($ignore);

        return $this;
    }

    /**
     * Set the ruleset.
     *
     * @param non-empty-string $set
     * @return $this
     */
    public function setRuleset(string $set): static
    {
        if (!file_exists($set)) {
            $this->handleInvalidRuleset($set);
        }

        /** @var array<string, array<string, mixed>|bool> $rules */
        $rules = require $set;
        $this->setRules($rules);

        return $this;
    }

    /**
     * Handle invalid ruleset.
     *
     * @param string $set
     */
    protected function handleInvalidRuleset(string $set): void
    {
        throw new InvalidArgumentException("The ruleset '{$set}' does not exist.");
    }

    /**
     * Initialize the file finder.
     *
     * @return $this
     */
    protected function initializeFinder(): static
    {
        $finder = (new Finder())
            ->in(getcwd() ?: __DIR__ . '/../../../../')
            ->ignoreUnreadableDirs()
            ->ignoreVCS(true)
            ->ignoreVCSIgnored(true);

        $this->setFinder($finder);

        return $this;
    }

    /**
     * Register the custom fixer from 'wvnderlab-agency/php-copyright-header'.
     *
     * @return static
     */
    protected function registerCopyrightHeader(): static
    {
        $this->registerCustomFixers([
            'WvnderlabAgency/copyright_header' => new CopyrightHeaderFixer(),
        ]);

        return $this;
    }

    /**
     * Set the default ruleset.
     *
     * @return static
     */
    protected function setDefaultCache(): static
    {
        $this->setCacheFile('./tmp/php-cs-fixer/cache/.php-cs-fixer.cache');

        return $this;
    }

    /**
     * Set the generic ruleset.
     *
     * @return static
     */
    protected function setGenericRuleset(): static
    {
        $this->setRuleset(static::RULESET_GENERIC);

        return $this;
    }
}
