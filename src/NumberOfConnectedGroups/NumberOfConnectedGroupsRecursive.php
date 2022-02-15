<?php
/**
 * @author selcukmart
 * 14.02.2022
 * 14:46
 */

namespace Selcukmart\NumberOfConnectedGroupsY42\NumberOfConnectedGroups;

use Selcukmart\NumberOfConnectedGroupsY42\Tools\IteratorFor;

class NumberOfConnectedGroupsRecursive extends AbstractNumberOfConnectedGroups
{
    
    private const
        POSSIBILITY_COUNT = 4;
    /**
     * neighbours for connection possibilities
     * @var array|int[]
     * @author selcukmart
     * 14.02.2022
     * 15:57
     */
    private array
        $neighbour_rows = [
        -1, 0, 0, 1
    ],
        $neighbour_columns = [
        0, -1, 1, 0
    ];

    private function isConnected(int $row, int $column): bool
    {
        return $this->isValidRow($row) &&
            $this->isValidColumn($column) &&
            $this->matrixNodeEqualTo1($row, $column) &&
            !$this->isControlled($row, $column);
    }

    private function DFSControlMethodForGroupLinkControlAsRecursive($row, $col): void
    {
        $this->setAsControlled($row, $col);
        $iterator = new IteratorFor(self::POSSIBILITY_COUNT);
        for ($iterator->rewind(); $iterator->valid(); $iterator->next()) {
            [$sum_row, $sum_column] = $this->sumRowAndColumnForValidation($row, $iterator->current(), $col);
            $isConnected = $this->isConnected($sum_row, $sum_column);
            if ($isConnected) {
                $this->DFSControlMethodForGroupLinkControlAsRecursive($sum_row, $sum_column);
            }
        }
    }

    public function countGroups($matrix): int
    {
        if (empty($this->matrix)) {
            $this->matrix = $matrix;
        }
        [$iterator_row, $iterator_column] = $this->getMatrixIterators();
        for ($iterator_row->rewind(); $iterator_row->valid(); $iterator_row->next()) {
            for ($iterator_column->rewind(); $iterator_column->valid(); $iterator_column->next()) {
                if ($this->matrixNodeEqualTo1($iterator_row->current(), $iterator_column->current())
                    && !$this->isControlled($iterator_row->current(), $iterator_column->current())) {
                    $this->DFSControlMethodForGroupLinkControlAsRecursive($iterator_row->current(), $iterator_column->current());
                    $this->increaseGroupCount();
                }
            }
        }
        return $this->total_group_count;
    }


    /**
     * @param $row
     * @param $col
     * @author selcukmart
     * 14.02.2022
     * 16:13
     */
    private function setAsControlled($row, $col): void
    {
        $this->control_array[$row][$col] = true;
    }


    /**
     * @param $row
     * @param int $index
     * @param $col
     * @return array
     * @author selcukmart
     * 14.02.2022
     * 16:26
     */
    private function sumRowAndColumnForValidation($row, int $index, $col): array
    {
        $sum_row = $row + $this->neighbour_rows[$index];
        $sum_column = $col + $this->neighbour_columns[$index];
        return [$sum_row, $sum_column];
    }

}