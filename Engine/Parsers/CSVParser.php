<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Parsers;

use MikhUd\CSVGenTree\Engine\Parsers\AbstractParser;

/**
 * Класс CSVParser.
 */
class CSVParser extends AbstractParser
{
    /**
     * Парсинг csv файла в массив.
     *
     * @param string $path
     * @param string $delimeter
     * 
     * @return array
     */
    public function startParseToArray(string $path, string $delimeter): array
    {
        $result = [];
        $csvArray = explode("\n", file_get_contents($path));

        for ($i = 1; $i < count($csvArray); $i++) {
            $element = explode($delimeter, $csvArray[$i]);
            if ($element[0])
            $result[] = $element; 
        }

        return $result;
    }
}