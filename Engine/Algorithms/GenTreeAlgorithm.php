<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine\Algorithms;

use MikhUd\CSVGenTree\Engine\Algorithms\Contracts\AlgorithmContract;

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

        //Проверяем у всех парентов и добавляем чилдренов
        for ($i = 0; $i < count($this->data); $i++) {
            for ($j = 0; $j < count($this->data); $j++) {
                if ($this->data[$j]['parent'] == $this->data[$i]['itemName']) {
                    $this->data[$i]['children'][] = $this->data[$j]['itemName'];
                }
            }
        }
        //Проверяем у всех релейшены и добавляем чилдренов по этим релейшенам
        for ($i = 0; $i < count($this->data); $i++) {
            if ($this->data[$i]['relation'] == null) {
                continue;
            }
            foreach ($this->data as $el) {
                if ($el['parent'] == $this->data[$i]['relation']) {
                    $this->data[$i]['children'][] = $el['itemName'];
                }
            }
        }
        //Воссоздаем адекватную структуру выходного json`а
        foreach ($this->data as $el) {
            if ($el['parent'] == null) {
                $result[] = [
                    'itemName' => $el['itemName'],
                    'parent' => $el['parent'],
                    'children' => $this->buildChildTree($el)
                ];
            }
        }

        return $result;
    }

    /**
     * Построение дерева потомков (children).
     *
     * @param array $el
     * 
     * @return array
     */
    private function buildChildTree(array $el): array
    {
        $tree = [];
        if (!isset($el['children'])) {
            return [];
        }

        foreach ($this->data as $element) {
            if (in_array($element['itemName'], $el['children'])) {
                $tree[] = [
                    'itemName' => $element['itemName'],
                    'parent' => $element['parent'],
                    'children' => $this->buildChildTree($element)
                ];
            }
        }

        return $tree;
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