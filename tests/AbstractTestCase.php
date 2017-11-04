<?php

/*
 * This file is part of the CSVTranslator package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests;

use CSVTranslator\CSVTranslator;
use PHPUnit_Framework_TestCase;

abstract class AbstractTestCase extends PHPUnit_Framework_TestCase
{
    protected $filesPath = 'example_files/';
    protected $fiftyNamesFile;
    protected $fiftyNamesFileColumnKeys;

    protected function setUp()
    {
        $this->fiftyNamesFile = $this->filesPath.'fifty_names.csv';
        $this->fiftyNamesFileColumnKeys = array(
            'name' => 'Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'country' => 'Country',
        );
    }

    protected function tearDown()
    {
    }
}
