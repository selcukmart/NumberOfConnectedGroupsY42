<?php
/**
 * @author selcukmart
 * 14.02.2022
 * 14:51
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use Selcukmart\NumberOfConnectedGroupsY42\NumberOfConnectedGroups\NumberOfConnectedGroupsIterative;

class CountForIterativeTest extends TestCase
{
    public function testCount(): void
    {
        $matrix = [
            [1, 1, 0, 0, 0],
            [0, 1, 0, 0, 1],
            [1, 0, 0, 1, 1],
            [1, 0, 0, 0, 0],
            [1, 0, 1, 0, 1]
        ];

        $result = (new NumberOfConnectedGroupsIterative(5, 5))->countGroups($matrix);
        $accepted = 5;
        $this->assertSame($accepted, $result);
    }

    public function testCount2(): void
    {
        $matrix = [
            [1, 1, 1, 0, 0],
            [0, 1, 1, 0, 1],
            [1, 0, 0, 1, 1],
            [1, 0, 0, 0, 0],
            [1, 0, 1, 0, 1]
        ];

        $result = (new NumberOfConnectedGroupsIterative(5, 5))->countGroups($matrix);
        $accepted = 5;
        $this->assertSame($accepted, $result);
    }


    public function testCount3(): void
    {
        $matrix = [
            [1, 1, 1, 0, 0],
            [0, 0, 1, 0, 0],
            [0, 0, 0, 1, 1],
            [1, 0, 0, 0, 0],
            [1, 0, 1, 0, 1]
        ];

        $result = (new NumberOfConnectedGroupsIterative(5, 5))->countGroups($matrix);
        $accepted = 5;
        $this->assertSame($accepted, $result);
    }

    public function testCount4(): void
    {
        $matrix = [
            [1, 0, 1, 0, 0],
            [0, 0, 0, 0, 1],
            [0, 0, 1, 0, 0],
            [1, 0, 0, 0, 0],
            [1, 0, 1, 0, 1]
        ];

        $result = (new NumberOfConnectedGroupsIterative(5, 5))->countGroups($matrix);
        $accepted = 7;
        $this->assertSame($accepted, $result);
    }

    public function testCount5(): void
    {
        $matrix = [
            [1, 0, 1, 0, 0, 1, 1],
            [0, 0, 0, 0, 1, 0, 0],
            [0, 0, 1, 0, 0, 0, 0],
            [1, 0, 0, 0, 0, 0, 0],
            [1, 0, 1, 0, 1, 0, 0],
            [1, 0, 0, 0, 0, 0, 0],
            [1, 0, 0, 0, 1, 1, 1],
            [1, 0, 0, 0, 0, 0, 0],
            [1, 0, 1, 0, 1, 0, 0]
        ];

        $result = (new NumberOfConnectedGroupsIterative(9, 7))->countGroups($matrix);
        $accepted = 11;
        $this->assertSame($accepted, $result);
    }
}
