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
    public const string RULESET_GENERIC = __DIR__ . '/../.rules/.generic.php';
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
     * @return $this
     */
    public function appendRules(array $rules): self
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
     * @return $this
     */
    public function exclude(array|string $dirs): self
    {
        $this->getFinder()->exclude($dirs);

        return $this;
    }

    /**
     * Include directories for scanning.
     *
     * @param string|string[] $dirs
     * @return $this
     */
    public function include(array|string $dirs): self
    {
        $this->getFinder()->in($dirs);

        return $this;
    }

    /**
     * Ignore dot files.
     *
     * @param bool $ignore
     * @return $this
     */
    public function ignoreDotFiles(bool $ignore = true): self
    {
        $this->getFinder()->ignoreDotFiles($ignore);

        return $this;
    }

    /**
     * Ignore files and directories ignored by Git.
     *
     * @param bool $ignore
     * @return $this
     */
    public function ignoreGitIgnored(bool $ignore = true): self
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
    public function setRuleset(string $set): self
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
     * @return never
     */
    protected function handleInvalidRuleset(string $set): never
    {
        throw new InvalidArgumentException("The ruleset '{$set}' does not exist.");
    }

    /**
     * Initialize the file finder.
     *
     * @return $this
     */
    protected function initializeFinder(): self
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
     * @return $this
     */
    protected function registerCopyrightHeader(): self
    {
        $this->registerCustomFixers([
            'WvnderlabAgency/copyright_header' => new CopyrightHeaderFixer(),
        ]);

        return $this;
    }

    /**
     * Set the default ruleset.
     *
     * @return $this
     */
    protected function setDefaultCache(): self
    {
        $this->setCacheFile('./tmp/php-cs-fixer/cache/.php-cs-fixer.cache');

        return $this;
    }

    /**
     * Set the generic ruleset.
     *
     * @return $this
     */
    protected function setGenericRuleset(): self
    {
        $this->setRuleset(Configuration::RULESET_GENERIC);

        return $this;
    }
}
