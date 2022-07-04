<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Services;

use Exception;
use MikhUd\CSVGenTree\Engine\Services\Contracts\GenTreeServiceContract;

/**
 * Класс GenTreeService.
 */
class GenTreeService implements GenTreeServiceContract
{
    /** @var array */
    const PARSERS = [
        'csv' => 'MikhUd\\CSVGenTree\\Engine\\Parsers\\CSVParser'
    ];

    /** @var array */
    const ALGORITHMS = [
        'genTree' => 'MikhUd\\CSVGenTree\\Engine\\Algorithms\\GenTreeAlgorithm'
    ];

    /**
     * Трансформация csv по алгоритму и помещение результата в файл.
     *
     * @param array $args
     * 
     * @return void
     */
    public static function transformAndPutInFile(array $args): void
    {
        if (!$parser = new(self::PARSERS[$args['appends']['presets']['parser_type']])) {
            echo 'Парсер не поддерживается';

            return;
        }

        if (!$algorithm = new (self::ALGORITHMS[$args['appends']['algorithm']])) {
            echo 'Алгоритм не поддерживается';

            return;
        }

        [$pathToInputFile, $pathToOutputFile] = array_slice($args, 0, 2);

        try {
            $parsedArray = $parser->parseToArray($pathToInputFile, $args['appends']['presets']['delimeter']);
            $transformedArray = $algorithm->transform($parsedArray);
            file_put_contents("$pathToOutputFile/myfile.json", json_encode(
                $transformedArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}