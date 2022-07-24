<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Nodes;

use MikhUd\CSVGenTree\Engine\Nodes\Contracts\NodeContract;

/**
 * Класс Node.
 */
class Node implements NodeContract
{
    /** @var string */
    private string $value;

    /** @var mixed */
    private mixed $parent = '';

    /** @var array */
    private array $children;

    /**
     * Конструктор.
     *
     * @param array $data
     */
    public function __construct(string $value)
    {
        $this->value = $value;
        $this->children = [];
    }

    /**
     * Возврат value текущей ноды.
     * 
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Добавление дочерней ноды.
     *
     * @param Node $node
     * 
     * @return void
     */
    public function addChild(Node $node): void
    {
        $this->children[] = $node;
    }

    /**
     * Добавление дочерних нод.
     *
     * @param array $nodes
     * 
     * @return void
     */
    public function addChildren(array $nodes): void
    {
        foreach ($nodes as $node) {
            $this->children[] = $node;
        }
    }

    /**
     * Возврат дочерних нод.
     * 
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * Установка value родительской ноды.
     * 
     * @return void
     */
    public function setParent(mixed $node): void
    {
        $this->parent = $node;
    }

    /**
     * Возврат value родительской ноды.
     * 
     * @return mixed
     */
    public function getParent(): mixed
    {
        return $this->parent;
    }
}