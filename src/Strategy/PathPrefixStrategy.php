<?php declare(strict_types=1);

namespace Tolkam\UriGenerator\Strategy;

use Tolkam\UriGenerator\GeneratorStrategyInterface;
use Tolkam\UriGenerator\Strategy\Traits\PathJoinerTrait;

class PathPrefixStrategy implements GeneratorStrategyInterface
{
    use PathJoinerTrait;
    
    /**
     * @var string
     */
    protected string $pathPrefix;
    
    /**
     * @var string
     */
    protected string $separator;
    
    /**
     * @param string $pathPrefix
     * @param string $separator
     */
    public function __construct(
        string $pathPrefix = '',
        string $separator = '/'
    ) {
        $this->pathPrefix = $pathPrefix;
        $this->separator = $separator;
    }
    
    /**
     * @inheritDoc
     */
    public function apply(string $resourceName): string
    {
        return $this->join([$this->pathPrefix, $resourceName], $this->separator);
    }
}
