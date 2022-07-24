<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Nodes\Contracts;

use MikhUd\CSVGenTree\Engine\Nodes\Node;

/**
 * Интерфейс NodeContract.
 */
interface NodeContract
{
    /**
     * Возврат value текущей ноды.
     * 
     * @return string
     */
    public function getValue(): string;

    /**
     * Добавление дочерней ноды.
     *
     * @param Node $node
     * 
     * @return void
     */
    public function addChild(Node $node): void;

    /**
     * Добавление дочерних нод.
     *
     * @param array $nodes
     * 
     * @return void
     */
    public function addChildren(array $nodes): void;

    /**
     * Возврат дочерних нод.
     * 
     * @return array
     */
    public function getChildren(): array;

    /**
     * Установка value родительской ноды.
     * 
     * @return void
     */
    public function setParent(mixed $node): void;

    /**
     * Возврат value родительской ноды.
     * 
     * @return mixed
     */
    public function getParent(): mixed;
}