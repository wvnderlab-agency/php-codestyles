<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        getcwd() . DIRECTORY_SEPARATOR . 'src'
    ])
    ->withPhpSets()
    ->withImportNames()
    ->withTypeCoverageLevel(0)
    ->withTypeCoverageDocblockLevel(0)
    ->withDeadCodeLevel(1)
    ->withCodeQualityLevel(2)
    ->withCodingStyleLevel(2);
