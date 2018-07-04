<?php

namespace Adelf\LaravelMenu\Tests\Unit;

use Adelf\LaravelMenu\Filters\TwoLevelAuthFilter;
use Adelf\LaravelMenu\ItemProcessors\EmptyMenuItemProcessor;
use Adelf\LaravelMenu\Tests\Traits\Closures;
use PHPUnit\Framework\TestCase;

class OneLevelAuthFilterTest extends TestCase
{
    use Closures;

    public function testWithoutAuth()
    {
        $items = [
            [
                'id' => 1,
            ],
            [
                'id' => 2,
            ],
        ];

        $filteredItems = $this->runFilter($items);

        $this->assertCount(2, $filteredItems);
        $this->assertEquals(1, $filteredItems[0]['id']);
    }

    public function testFalseAuth()
    {
        $items = [
            [
                'id' => 1,
                'auth' => $this->falseClosure(),
            ],
            [
                'id' => 2,
                'auth' => $this->falseClosure(),
            ],
        ];

        $filteredItems = $this->runFilter($items);

        $this->assertCount(0, $filteredItems);
    }

    public function testOneFalse()
    {
        $items = [
            [
                'id' => '1',
                'auth' => $this->trueClosure(),
            ],
            [
                'id' => 2,
                'auth' => $this->falseClosure(),
            ],
            [
                'id' => 3,
                'auth' => $this->trueClosure(),
            ],
        ];

        $filteredItems = $this->runFilter($items);

        $this->assertCount(2, $filteredItems);
        $this->assertEquals(1, $filteredItems[0]['id']);
        $this->assertEquals(3, $filteredItems[1]['id']);
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