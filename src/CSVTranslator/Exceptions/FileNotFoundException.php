<?php

/*
 * This file is part of the CSVTranslator package.
 *
 * (c) Neftali Bautista
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CSVTranslator\Exceptions;

use Symfony\Component\Filesystem\Exception\FileNotFoundException as Exception;

class FileNotFoundException extends Exception
{
    /**
     * Constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     * @param string          $path
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null, $path = null)
    {
        if (null === $message) {
            if (null === $path) {
                $message = 'File could not be found.';
            } else {
                $message = sprintf('File "%s" could not be found.', $path);
            }
        }

        parent::__construct($message, $code, $previous, $path);
    }
}
