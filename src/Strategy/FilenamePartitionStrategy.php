<?php declare(strict_types=1);

namespace Tolkam\UriGenerator\Strategy;

use InvalidArgumentException;
use Tolkam\UriGenerator\GeneratorStrategyInterface;
use Tolkam\UriGenerator\Strategy\Traits\PathJoinerTrait;

class FilenamePartitionStrategy implements GeneratorStrategyInterface
{
    use PathJoinerTrait;
    
    /**
     * @var array
     */
    private array $options = [
        'prefix' => '',
        'segmentLength' => 2,
        'segmentsCount' => 4,
        'glue' => '/',
    ];
    
    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = array_replace($this->options, $options);
    }
    
    /**
     * @inheritDoc
     */
    public function apply(string $resourceName): string
    {
        $glue = (string) $this->options['glue'];
        
        $filename = pathinfo($resourceName, PATHINFO_FILENAME);
        $partition = $this->getPartition($filename, $glue);
        $resourceName = strtr($resourceName, [$filename => $partition . $glue . $filename]);
        
        return $this->join([(string) $this->options['prefix'], $resourceName], $glue);
    }
    
    /**
     * @param string $filename
     * @param string $glue
     *
     * @return string
     */
    protected function getPartition(string $filename, string $glue): string
    {
        $segmentsCount = (int) $this->options['segmentsCount'];
        $segmentLength = (int) $this->options['segmentLength'];
        
        $filename = mb_strtolower($filename);
        $fileNameLength = mb_strlen($filename);
        
        if ($fileNameLength < $segmentsCount * $segmentLength) {
            throw new InvalidArgumentException(sprintf(
                'Filename is too short (%s chars) to generate'
                . ' %s segments of %s characters length',
                $fileNameLength,
                $segmentsCount,
                $segmentLength
            ));
        }
        
        $segments = array_slice(str_split($filename, $segmentLength), 0, $segmentsCount);
        
        return implode($glue, $segments);
    }
}
