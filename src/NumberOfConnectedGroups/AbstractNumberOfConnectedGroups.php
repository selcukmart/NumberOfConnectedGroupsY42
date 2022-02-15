<?php
/**
 * @author selcukmart
 * 15.02.2022
 * 12:24
 */

namespace Selcukmart\NumberOfConnectedGroupsY42\NumberOfConnectedGroups;

use Selcukmart\NumberOfConnectedGroupsY42\Tools\IteratorFor;

abstract class AbstractNumberOfConnectedGroups
{

    protected array
        $matrix = [],
        $control_array = [[]];
    protected int
        $total_group_count = 0;

    public function __construct(protected readonly int $matrix_total_row_count, protected readonly int $matrix_total_column_count)
    {

    }

    /**
     * @param int $row
     * @param int $column
     * @return bool
     * @author selcukmart
     * 14.02.2022
     * 16:14
     */
    protected function isControlled(int $row, int $column): bool
    {
        return isset($this->control_array[$row][$column]);
    }

    /**
     * @return array
     * @author selcukmart
     * 14.02.2022
     * 17:21
     */
    protected function getMatrixIterators(): array
    {
        $iterator_row = new IteratorFor($this->matrix_total_row_count);
        $iterator_column = new IteratorFor($this->matrix_total_column_count);
        return [$iterator_row, $iterator_column];
    }


    /**
     * @return int
     * @author selcukmart
     * 14.02.2022
     * 16:27
     */
    protected function increaseGroupCount(): int
    {
        return ++$this->total_group_count;
    }

    /**
     * @return array
     */
    public function getMatrix(): array
    {
        return $this->matrix;
    }

    /**
     * @return int
     */
    public function getMatrixTotalRowCount(): int
    {
        return $this->matrix_total_row_count;
    }

    /**
     * @return int
     */
    public function getMatrixTotalColumnCount(): int
    {
        return $this->matrix_total_column_count;
    }

    /**
     * @return int
     */
    public function getTotalGroupCount(): int
    {
        return $this->total_group_count;
    }

    /**
     * @param int $row
     * @param int $column
     * @return mixed
     * @author selcukmart
     * 14.02.2022
     * 16:15
     */
    protected function matrixNodeEqualTo1(int $row, int $column): mixed
    {
        return $this->matrix[$row][$column];
    }


    /**
     * @param int $row
     * @return bool
     * @author selcukmart
     * 14.02.2022
     * 16:24
     */
    protected function isValidRow(int $row): bool
    {
        return ($row >= 0) && ($row < $this->matrix_total_row_count);
    }

    protected function isValidColumn(int $column): bool
    {
        return ($column >= 0) && ($column < $this->matrix_total_column_count);
    }

    public function __destruct()
    {

    }
}