<?php

declare(strict_types=1);

namespace MikhUd\CSVDB\Engine;

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
            'controller' => $config['available']['controller'],
            'presets' => $config['available']['presets']
        ];
    }
}