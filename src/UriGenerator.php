<?php declare(strict_types=1);

namespace Tolkam\UriGenerator;

use Tolkam\UriGenerator\Strategy\NullStrategy;

class UriGenerator implements UriGeneratorInterface
{
    /**
     * @var GeneratorStrategyInterface
     */
    protected GeneratorStrategyInterface $defaultStrategy;
    
    /**
     * @var GeneratorStrategyInterface[]
     */
    protected array $strategies = [];
    
    /**
     * @param GeneratorStrategyInterface|null $defaultStrategy
     */
    public function __construct(GeneratorStrategyInterface $defaultStrategy = null)
    {
        $this->defaultStrategy = $defaultStrategy ?? new NullStrategy();
    }
    
    /**
     * @inheritDoc
     */
    public function generate(string $resourceName, string $strategyAlias = null): string
    {
        return $this->getStrategy($strategyAlias)->apply($resourceName);
    }
    
    /**
     * Adds resolving strategy
     *
     * @param GeneratorStrategyInterface $strategy
     * @param string|null                $alias
     *
     * @return UriGeneratorInterface
     * @throws UriGeneratorException
     */
    public function addStrategy(GeneratorStrategyInterface $strategy, string $alias = null): self
    {
        $strategies = &$this->strategies;
        if (isset($strategies[$alias])) {
            throw new UriGeneratorException(sprintf(
                'Strategy with "%s" alias already exists', $alias
            ));
        }
        
        $strategies[$alias] = $strategy;
        
        return $this;
    }
    
    /**
     * Gets resolving strategy
     *
     * @param string|null $strategyAlias
     *
     * @return GeneratorStrategyInterface
     * @throws UriGeneratorException
     */
    protected function getStrategy(string $strategyAlias = null): GeneratorStrategyInterface
    {
        if ($strategyAlias === null) {
            return $this->defaultStrategy;
        }
        
        if (!isset($this->strategies[$strategyAlias])) {
            throw new UriGeneratorException(sprintf('Unknown strategy "%s"', $strategyAlias));
        }
        
        return  $this->strategies[$strategyAlias];
    }
}
