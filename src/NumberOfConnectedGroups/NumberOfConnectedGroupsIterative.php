<?php
/**
 * @author selcukmart
 * 14.02.2022
 * 14:46
 */

namespace Selcukmart\NumberOfConnectedGroupsY42\NumberOfConnectedGroups;

class NumberOfConnectedGroupsIterative extends AbstractNumberOfConnectedGroups
{
    protected array
        $groups_list = [],
        $ones_array = [];

    private function isConnected(int $row, int $column): bool
    {
        $is_in_group_or_alone = $this->distanceControl($row, $column);

        return $is_in_group_or_alone && $this->isValidRow($row) &&
            $this->isValidColumn($column) &&
            $this->matrixNodeEqualTo1($row, $column) &&
            !$this->isControlled($row, $column);
    }

    private function findAllOnes(): void
    {
        for ($i = 0; $i < $this->matrix_total_row_count; $i++) {
            for ($j = 0; $j < $this->matrix_total_column_count; $j++) {
                if ($this->matrixNodeEqualTo1($i, $j)) {
                    $this->ones_array['i' . $i . '.' . $j] = [$i, $j];
                }
            }
        }
    }

    private function detectConnectedOnes($row, $col): void
    {
        if ($this->isItInOnesArray($row, $col)) {
            $this->iterateRow();
            $this->reverseIterateRow();
        }
    }

    public function countGroups($matrix): int
    {
        if (empty($this->matrix)) {
            $this->matrix = $matrix;
        }
        $this->findAllOnes();
        [$iterator_row, $iterator_column] = $this->getMatrixIterators();
        for ($iterator_row->rewind(); $iterator_row->valid(); $iterator_row->next()) {
            for ($iterator_column->rewind(); $iterator_column->valid(); $iterator_column->next()) {
                if ($this->matrixNodeEqualTo1($iterator_row->current(), $iterator_column->current())
                    && !$this->isControlled($iterator_row->current(), $iterator_column->current())) {
                    $this->detectConnectedOnes($iterator_row->current(), $iterator_column->current());
                    $this->increaseGroupCount();
                }
            }
        }
        $this->total_group_count = count($this->groups_list);
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

        $this->groups_list[$this->total_group_count] = $this->groups_list[$this->total_group_count] ?? [];
        $this->groups_list[$this->total_group_count][] = [$row, $col];
        $this->control_array[$row][$col] = true;
        unset($this->ones_array['i' . $row . '.' . $col]);
    }

    /**
     * @param int $column
     * @param int $row
     * @return bool
     * @author selcukmart
     * 15.02.2022
     * 12:15
     */
    private function distanceControl(int $row, int $column): bool
    {
        if (isset($this->groups_list[$this->total_group_count])) {
            $groups_list = $this->groups_list[$this->total_group_count];
            $can_be_group = false;
            foreach ($groups_list as $item) {
                if ($column === $item[1]) {
                    $diff = (($item[0] - $row) ** 2);
                    if ($diff <= 2) {
                        $can_be_group = true;
                        break;
                    }
                } elseif ($row === $item[0]) {
                    $diff = (($item[1] - $column) ** 2);
                    if ($diff <= 2) {
                        $can_be_group = true;
                        break;
                    }
                }
            }
        } else {
            $can_be_group = true;
        }
        return $can_be_group;
    }

    /**
     * @param int $a
     * @return int
     * @author selcukmart
     * 15.02.2022
     * 12:18
     */
    private function nodeControl(int $a): void
    {
        for ($b = 0; $b < $this->getMatrixTotalColumnCount(); $b++) {
            if ($this->isConnected($a, $b)) {
                $this->setAsControlled($a, $b);
            }
        }
    }

    /**
     * @param int $a
     * @return int
     * @author selcukmart
     * 15.02.2022
     * 12:19
     */
    private function reverseNodeControl(int $a): void
    {
        for ($b = $this->getMatrixTotalColumnCount() - 1; $b >= 0; $b--) {
            if ($this->isConnected($a, $b)) {
                $this->setAsControlled($a, $b);
            }
        }
    }

    /**
     * @return int
     * @author selcukmart
     * 15.02.2022
     * 12:21
     */
    private function iterateRow(): void
    {
        for ($a = 0; $a < $this->getMatrixTotalRowCount(); $a++) {
            $this->nodeControl($a);
            $this->reverseNodeControl($a);
        }
    }

    private function reverseIterateRow(): void
    {
        for ($a = $this->getMatrixTotalRowCount() - 1; $a >= 0; $a--) {
            $this->nodeControl($a);
            $this->reverseNodeControl($a);
        }
    }

    /**
     * @param $row
     * @param $col
     * @return bool
     * @author selcukmart
     * 15.02.2022
     * 12:22
     */
    private function isItInOnesArray($row, $col): bool
    {
        return in_array([$row, $col], $this->ones_array, true);
    }

}