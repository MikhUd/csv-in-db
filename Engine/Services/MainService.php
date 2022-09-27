<?php

declare(strict_types=1);

namespace MikhUd\CSVDB\Engine\Services;

use Exception;
use MikhUd\CSVDB\Engine\Services\Contracts\MainServiceContract;
use MikhUd\CSVDB\Engine\Database\DatabaseRepository;

/**
 * Класс MainService.
 */
class MainService implements MainServiceContract
{
    /** @var array */
    const PARSERS = [
        'csv' => 'MikhUd\\CSVDB\\Engine\\Parsers\\CSVParser'
    ];

    public function __construct(
        private $databaseRepository = new DatabaseRepository()
    ) {}

    /**
     * Проверка данных csv в базе и помещение отчета в файл.
     *
     * @param array $args
     * 
     * @return void
     */
    public function checkAndPutReportInFile(array $args): void
    {
        if (!$parser = new(self::PARSERS[$args['appends']['presets']['parser_type']])) {
            echo 'Парсер не поддерживается';

            return;
        }

        [$pathToInputFile, $pathToOutputFile] = array_slice($args, 0, 2);

        try {
            $parsedArray = $parser->parseToArray($pathToInputFile);
            $outputArray = $this->databaseRepository->getExistsBooksAndAuthorsFromDB($parsedArray);
            $outputFile = fopen("$pathToOutputFile/report.csv", "w");
            fputcsv($outputFile, array('Книга', 'Автор'));
            foreach ($outputArray as $line) {
                fputcsv($outputFile, [$line['book'], $line['author']]);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}