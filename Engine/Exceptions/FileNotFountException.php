<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Exceptions;

use Exception;

/**
 * Класс FileNotFoundException.
 */
class FileNotFoundException extends Exception
{
    /**
     * Исключение для несуществующего файла.
     * 
     * @return static
     */
    public static function fileNotFound(): static
    {
        return new static('file not found');
    }
}