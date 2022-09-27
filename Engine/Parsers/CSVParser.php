<?php

declare(strict_types=1);

namespace MikhUd\CSVDB\Engine\Parsers;

use MikhUd\CSVDB\Engine\Parsers\AbstractParser;

/**
 * Класс CSVParser.
 */
class CSVParser extends AbstractParser
{
    /**
     * Парсинг csv файла в массив.
     *
     * @param string $path
     * 
     * @return array
     */
    public function startParseToArray(string $path): array
    {
        $result = [];
        $csvArray = explode("\n", file_get_contents($path));

        for ($i = 1; $i < count($csvArray); $i++) {
            if ($csvArray[$i])
            $result[] = $csvArray[$i]; 
        }

        return $result;
    }
}