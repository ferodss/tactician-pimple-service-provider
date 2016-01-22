<?php

namespace Pimple\Tactician\Provider\Handler\CommandNameExtractor;

use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor;

class DecamelizeClassNameExtractor implements CommandNameExtractor
{
    /**
     * {@inheritdoc}
     */
    public function extract($command)
    {
        $className = substr(strrchr(get_class($command), '\\'), 1);

        return preg_replace_callback('/(^|[a-z])([A-Z])/', function ($s) {
            return strtolower(strlen($s[1]) ? "$s[1]_$s[2]" : "$s[2]");
        }, $className);
    }
}
