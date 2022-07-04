<?php

declare(strict_types=1);

namespace MikhUd\CSVGenTree\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Класс GenTreeTest.
 */
class GenTreeTest extends TestCase
{
    /** @var array */
    private $config = [
        'algorithm' => 'genTree',
        'controller' => [
            'path' => 'MikhUd\\CSVGenTree\\Engine\\Controllers\\GenTreeController'
        ],
        'presets' => [
            'parser_type' => 'csv',
            'delimeter' => ';'
        ]
    ];

    /**
     * Тест genTree алгоритма.
     * 
     * @return void
     */
    public function testGenTree(): void
    {
        $args[0] = __DIR__ . '/../GenTreeTestValues/input.csv';
        $args[1] = __DIR__ . '/../GenTreeTestValues/';
        $args['appends'] = $this->config;
        (new $args['appends']['controller']['path'])($args);
        $dismatch = array_diff_key(
            json_decode(file_get_contents(__DIR__ . '/../GenTreeTestValues/output.json'), true), 
            json_decode(file_get_contents(__DIR__ . '/../GenTreeTestValues/myfile.json'), true)
        );
        unlink(__DIR__ . '/../GenTreeTestValues/myfile.json');

        $this->assertEquals(empty($dismatch), true);
    }
}