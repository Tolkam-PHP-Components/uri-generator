<?php declare(strict_types=1);

namespace Tolkam\UriGenerator;

interface GeneratorStrategyInterface
{
    /**
     * Applies a strategy to a resource name
     *
     * @param string $resourceName
     *
     * @return string
     */
    public function apply(string $resourceName): string;
}
