<?php declare(strict_types=1);

namespace Tolkam\UriGenerator\Strategy;

use Tolkam\UriGenerator\GeneratorStrategyInterface;

class NullStrategy implements GeneratorStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function apply(string $filename): string
    {
        return $filename;
    }
}
