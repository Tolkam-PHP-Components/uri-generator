<?php

namespace Tolkam\UriGenerator\Strategy\Traits;

use Tolkam\Utils\Str;

trait PathJoinerTrait
{
    /**
     * Joins segments with a glue
     *
     * @param array  $segments
     * @param string $glue
     *
     * @return string
     */
    protected function join(array $segments, string $glue): string
    {
        $segments = array_filter($segments, fn($v) => !empty($v) && is_string($v));
        $segments = implode($glue, $segments);
        
        return Str::fixPathSeparators($segments, $glue);
    }
}
