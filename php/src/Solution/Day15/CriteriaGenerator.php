<?php

namespace App\Solution\Day15;

class CriteriaGenerator extends Generator
{
    private $criteria;

    /**
     * Set the criteria that must pass to determine valid values
     *
     * @param callable $criteria
     */
    public function setCriteria(callable $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * {@inheritdoc}
     * @return int
     */
    public function nextValue(): int
    {
        do {
            $nextValue = parent::nextValue();
        }
        while (!call_user_func($this->criteria, $nextValue));
        return $nextValue;
    }
}