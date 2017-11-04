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

class SimpleReaderTest extends AbstractTestCase
{
    public function testReadFileContent()
    {
        $fileContent = CSV::getContent($this->fiftyNamesFile);

        $this->assertInternalType('array', $fileContent);
        $this->assertCount(51, $fileContent);
        $this->assertCount(5, $fileContent[50]);
        $this->assertEquals('emachostiew@ucoz.ru', $fileContent[33][2]);
    }

    public function testDeleteTitlesFromContent()
    {
        $fileContent = CSV::getContentWithoutTitles($this->fiftyNamesFile);

        $this->assertInternalType('array', $fileContent);
        $this->assertCount(50, $fileContent);
        $this->assertCount(5, $fileContent[49]);
        $this->assertEquals('mbarti0@boston.com', $fileContent[0][2]);
        $this->assertEquals('emachostiew@ucoz.ru', $fileContent[32][2]);
    }

    public function testReadFileWithKeys()
    {
        $CSVFile = CSV::getContentWithKeys($this->fiftyNamesFile, $this->fiftyNamesFileColumnKeys);
        $fileContent = $CSVFile['data'];

        $this->assertInternalType('array', $fileContent);
        $this->assertCount(50, $fileContent);
        $this->assertCount(5, $fileContent[49]);
        $this->assertEquals('mbarti0@boston.com', $fileContent[0]['email']);
        $this->assertEquals('emachostiew@ucoz.ru', $fileContent[32]['email']);
    }

    public function testReadFileWithNoNameKeys()
    {
        $CSVFile = CSV::getContentWithKeys($this->fiftyNamesFile, array(
            'name',
            'lastName',
            'email',
            'gender',
            'country',
        ));
        $fileContent = $CSVFile['data'];

        $this->assertInternalType('array', $fileContent);
        $this->assertCount(51, $fileContent);
        $this->assertCount(5, $fileContent[50]);
        $this->assertEquals('Last Name', $fileContent[0]['lastName']);
        $this->assertEquals('Email', $fileContent[0]['email']);
        $this->assertEquals('mbarti0@boston.com', $fileContent[1]['email']);
        $this->assertEquals('emachostiew@ucoz.ru', $fileContent[33]['email']);
    }
}
