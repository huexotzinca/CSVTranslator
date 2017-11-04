<?php

/*
 * This file is part of the CSVTranslator package.
 *
 * (c) Neftali Bautista
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CSVTranslator;

use CSVTranslator\CSVTranslator as CSV;
use Tests\AbstractTestCase;

class ConstructTest extends AbstractTestCase
{
    public function testCreatesAnInstanceDefault()
    {
        $c = new CSV();
        $fileContent = CSV::getContent($this->fiftyNamesFile);
        $this->assertInstanceOf(CSV::class, $c);
    }
}
