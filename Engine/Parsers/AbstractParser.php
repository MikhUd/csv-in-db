<?php

declare(strict_types=1);

namespace MikhUd\CSVDB\Engine\Parsers;

use MikhUd\CSVDB\Engine\Exceptions\FileNotFoundException;

/**
 * Класс AbstractParser.
 */
abstract class AbstractParser
{
    /**
     * Парсинг csv файла в массив.
     *
     * @param string $path
     * 
     * @return array
     */
    public function parseToArray(string $path): array
    {
        if (!file_exists($path)) {
            throw FileNotFoundException::fileNotFound();
        }

        return $this->startParseToArray($path);
    }

    /**
     * Парсинг csv файла в массив.
     *
     * @param string $path
     * 
     * @return array
     */
    public abstract function startParseToArray(string $path): array;
}