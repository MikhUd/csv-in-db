<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Services\Contracts;

/**
 * Класс GenTreeServiceContract.
 */
interface GenTreeServiceContract
{
    /**
     * Трансформация csv по алгоритму и помещение результата в файл.
     *
     * @param array $args
     * 
     * @return void
     */
    public static function transformAndPutInFile(array $args): void;
}