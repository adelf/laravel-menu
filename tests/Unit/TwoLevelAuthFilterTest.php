<?php

namespace Adelf\LaravelMenu\Tests\Unit;

use Adelf\LaravelMenu\Filters\TwoLevelAuthFilter;
use Adelf\LaravelMenu\ItemProcessors\EmptyMenuItemProcessor;
use Adelf\LaravelMenu\Tests\Traits\Closures;
use PHPUnit\Framework\TestCase;

class TwoLevelAuthFilterTest extends TestCase
{
    use Closures;

    public function testChildren()
    {
        $items = [
            [
                'id' => 1,
                'items' => [
                    [1],
                    [2],
                ]
            ],
            [
                'id' => 2,
                'items' => [
                    [3],
                    [4],
                ]
            ],
        ];

        $filteredItems = $this->runFilter($items);

        $this->assertCount(2, $filteredItems);
        $this->assertEquals(1, $filteredItems[0]['id']);
        $this->assertCount(2, $filteredItems[0]['items']);
        $this->assertEquals(2, $filteredItems[0]['items'][1][0]);
    }

    public function testEmptyChildren()
    {
        $items = [
            [
                'id' => 1,
                'items' => [
                    ['auth' => $this->falseClosure()],
                    ['auth' => $this->falseClosure()],
                ]
            ],
            [
                'id' => 2,
                'items' => [
                    [3],
                    [4],
                ]
            ],
        ];

        $filteredItems = $this->runFilter($items);

        $this->assertCount(1, $filteredItems);
        $this->assertEquals(2, $filteredItems[0]['id']);
    }

    /**
     * @param array $items
     * @return array
     */
    private function runFilter(array $items): array
    {
        $filter = new TwoLevelAuthFilter(new EmptyMenuItemProcessor());

        return $filter->filter($items);
    }
}