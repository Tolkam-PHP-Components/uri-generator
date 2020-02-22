<?php declare(strict_types=1);

namespace Tolkam\UriGenerator;

interface UriGeneratorInterface
{
    /**
     * Generates uri
     *
     * @param string      $resourceName
     * @param string|null $strategyAlias
     *
     * @return string
     */
    public function generate(string $resourceName, string $strategyAlias = null): string;
}
