<?php

declare(strict_types=1);

namespace MikhUd\CSVDB\Engine\Services\Contracts;

/**
 * Класс MainServiceContract.
 */
interface MainServiceContract
{
    /**
     * Проверка данных csv в базе и помещение отчета в файл.
     *
     * @param array $args
     * 
     * @return void
     */
    public function checkAndPutReportInFile(array $args): void;
}