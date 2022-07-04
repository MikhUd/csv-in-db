<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Algorithms\Contracts;

/**
 * Класс AlgorithmContract.
 */
interface AlgorithmContract
{
    /**
     * Трансформация входных данных по алгоритму.
     *
     * @param array $data
     * 
     * @return array
     */
    public function transform(array $data): array;
}