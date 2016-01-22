<?php

namespace Pimple\Test\Tactician\Provider\Handler\CommandNameExtractor;

use Pimple\Tactician\Provider\Handler\CommandNameExtractor\DecamelizeClassNameExtractor;
use Pimple\Tactician\Provider\TacticianServiceProvider;

class DecamelizeClassNameExtractorTest extends \PHPUnit_Framework_TestCase
{
    public function testIsExtractingNameForCommand()
    {
        $extractor = new DecamelizeClassNameExtractor();

        $this->assertEquals('tactician_service_provider', $extractor->extract(new TacticianServiceProvider()));
    }
}
