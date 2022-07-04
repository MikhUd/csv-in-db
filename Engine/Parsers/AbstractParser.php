<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Parsers;

use MikhUd\CSVGenTree\Engine\Exceptions\FileNotFoundException;

/**
 * Класс AbstractParser.
 */
abstract class AbstractParser
{
    /**
     * Парсинг csv файла в массив.
     *
     * @param string $path
     * @param string $delimeter
     * 
     * @return array
     */
    public function parseToArray(string $path, string $delimeter): array
    {
        if (!file_exists($path)) {
            throw FileNotFoundException::fileNotFound();
        }

        return $this->startParseToArray($path, $delimeter);
    }

    /**
     * Парсинг csv файла в массив.
     *
     * @param string $path
     * @param string $delimeter
     * 
     * @return array
     */
    public abstract function startParseToArray(string $path, string $delimeter): array;
}