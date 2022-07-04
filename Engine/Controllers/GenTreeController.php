<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Controllers;

use MikhUd\CSVGenTree\Engine\Services\GenTreeService;

/**
 * Класс GenTreeController.
 */
class GenTreeController
{
    /**
     * @param array $args
     * 
     * @return void
     */
    public function __invoke(array $args): void
    {
        GenTreeService::transformAndPutInFile($args);
    }
}