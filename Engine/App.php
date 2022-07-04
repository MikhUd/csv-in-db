<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Engine;

/**
 * Класс App.
 */
class App
{
    /**
     * Точка запуска программы.
     *
     * @param array $args
     * 
     * @return void
     */
    public function run(array $args): void
    {
        $args['appends'] = $this->getParsedConfig();

        (new $args['appends']['controller']['path'])($args);
    }

    /**
     * Получение массива параметров конфига.
     * 
     * @return array
     */
    private function getParsedConfig(): array
    {
        $config = json_decode(file_get_contents(__DIR__ . '/../config/app.json'), true);

        return [
            'algorithm' => $config['algorithm'],
            'controller' => $config['available_algorithms'][$config['algorithm']]['controller'],
            'presets' => $config['available_algorithms'][$config['algorithm']]['presets']
        ];
    }
}