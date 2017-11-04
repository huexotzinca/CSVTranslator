<?php

/*
 * This file is part of the CSVTranslator package.
 *
 * (c) Neftali Bautista
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CSVTranslator;

use CSVTranslator\Exceptions\FileNotFoundException;

class CSVTranslator
{
    public static function getContent($filePath)
    {
        $content = array();
        if (!file_exists($filePath)) {
            throw new FileNotFoundException(null, null, null, $filePath);
        }

        $handle = fopen($filePath, 'r');
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $content[] = $data;
        }
        fclose($handle);

        return $content;
    }

    public static function getContentWithoutTitles($fileName = '', $titlesAlias = null)
    {
        $content = self::getContent($fileName);
        array_shift($content);

        if ($titlesAlias && is_array($titleAlias)) {
            $content = self::assignContentKeys($content, $titleAlias);
        }

        return $content;
    }

    protected static function assignContentKeys($fileContent = null, $titlesAlias = array())
    {
        $titlesLength = $titlesAlias ? count($titlesAlias) : 0;
        $hasTitlesInFile = false;
        $dataTitles = array_keys($titlesAlias)[0] === 0 ? $titlesAlias : array();
        $data = array();
        $errors = false;
        $fileRows = count($fileContent);

        // Read the CSV
        for ($row = 0; $row < $fileRows; $row++) {
            $record = $fileContent[$row];
            $cols = count($record);
            if ($cols == $titlesLength) {
                // If have titles use the $titlesAlias var for set in the rigth column name
                if ($row == 0 && empty($dataTitles)) {
                    for ($column = 0; $column < $cols; $column++) {
                        $dataTitle = array_search($record[$column], $titlesAlias);
                        if (!$dataTitle) {
                            $hasTitlesInFile = false;
                            break;
                        } else {
                            $hasTitlesInFile = true;
                        }
                        $dataTitles[$column] = $dataTitle;
                    }

                    if ($hasTitlesInFile) {
                        continue;
                    } else {
                        // If not have titles in file, then assign in columns order with $titlesAlias var
                        $dataTitles = array_keys($titlesAlias);
                    }
                }
                // Set the values and keys to results array
                $values = array();
                for ($column = 0; $column < $cols; $column++) {
                    $values[$dataTitles[$column]] = $record[$column];
                }

                $data[] = $values;
            } else {
                // If line has no format or num of values
                if (!$errors) {
                    $errors = array();
                }
                $errors[$row] = $values;
            }
        }
        // return Array with all values in CSV assigned a key name like $titleAlias var
        $results = array(
            'data' => $data,
        );

        if ($errors) {
            $results['errors'] = $errors;
        }

        return $results;
    }

    public static function getContentWithKeys($fileName, $titlesAlias = null)
    {
        $fileContent = self::getContent($fileName);

        return self::assignContentKeys($fileContent, $titlesAlias);
    }
}
