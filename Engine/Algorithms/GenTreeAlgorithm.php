<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Algorithms;

use MikhUd\CSVGenTree\Engine\Algorithms\Contracts\AlgorithmContract;
use MikhUd\CSVGenTree\Engine\Nodes\Node;

/**
 * Класс GenTreeAlgorithm.
 */
class GenTreeAlgorithm implements AlgorithmContract
{
    /** @var array */
    private array $data;

    /**
     * Трансформация входных данных по алгоритму.
     *
     * @param array $data
     * 
     * @return array
     */
    public function transform(array $data): array
    {
        $this->data = $this->prepareData($data);
        $result = [];

        $map = [];
        foreach ($this->data as $el) {
            $map[$el['itemName']] = new Node($el['itemName']);
            if ($el['parent'])
            $map[$el['parent']] = new Node($el['parent']);
        }

        foreach ($this->data as $el) {
            if ($el['parent']) {
                $map[$el['parent']]->addChild($map[$el['itemName']]);
                $map[$el['itemName']]->setParent($map[$el['parent']]->getValue());
                continue;
            }
            $map[$el['itemName']]->setParent(null);
        }
        
        foreach ($this->data as $el) {
            if (isset($el['relation'])) {
                $map[$el['itemName']]->addChildren($map[$el['relation']]->getChildren());
            }
        }

        foreach ($map as $el) {
            if ($el->getParent() === null)
            $result[] = $el;
        }

        return $this->transformDataToOutput($result);
    }

    /**
     * Трансформация финальных данных в выходной массив.
     *
     * @param array $result
     * 
     * @return array
     */
    private function transformDataToOutput(array $result): array
    {
        $finalResult = [];
        foreach ($result as $el) {
            $finalResult[] = [
                'itemName' => $el->getValue(),
                'parent' => $el->getParent(),
                'children' => $this->transformDataToOutput($el->getChildren())
            ];
        }

        return $finalResult;
    }

    /**
     * Изменение формата массива входных данных.
     *
     * @param array $data
     * 
     * @return array
     */
    private function prepareData(array $data): array
    {
        $result = [];

        foreach ($data as &$el) {
            foreach ($el as $key => $value) {
                unset($el[$key]);
                switch ($key) {
                    case 0:
                        $el['itemName'] = json_decode($value);
                        break;
                    case 1:
                        $el['type'] = json_decode($value);
                        break;
                    case 2:
                        $el['parent'] = json_decode($value);
                        break;
                    case 3:
                        $el['relation'] = json_decode($value);
                        break;
                }
            }
            $result[] = $el;
        }

        return $result;
    }
}