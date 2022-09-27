<?php

declare(strict_types=1);

namespace MikhUd\CSVDB\Engine\Controllers;

use MikhUd\CSVDB\Engine\Services\MainService;

/**
 * Класс MainController.
 */
class MainController
{
    /**
     * @param array $args
     * 
     * @return void
     */
    public function __invoke(array $args): void
    {
        (new MainService())->checkAndPutReportInFile($args);
    }
}