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

class SimpleReaderErrorsTest extends AbstractTestCase
{
    /**
     * @expectedException \CSVTranslator\Exceptions\FileNotFoundException
     */
    public function testGetContentThrowsExceptionForFileNotFound()
    {
        $fileContent = CSV::getContent('file/not/found.csv');
    }

    /**
     * @expectedException \CSVTranslator\Exceptions\FileNotFoundException
     */
    public function testGetContentWithoutTitlesThrowsExceptionForFileNotFound()
    {
        $fileContent = CSV::getContentWithoutTitles('file/not/found.csv');
    }

    /**
     * @expectedException \CSVTranslator\Exceptions\FileNotFoundException
     */
    public function testGetContentWithKeysThrowsExceptionForFileNotFound()
    {
        $fileContent = CSV::getContentWithKeys('file/not/found.csv', array(
            'name' => 'Name',
            'something' => 'Something',
        ));
    }
}
