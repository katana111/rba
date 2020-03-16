<?php

/**
 * Class Schedule
 */
class Schedule implements Iterator, Countable {
    /**
     * @var array
     */
    private $timeslots;
    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var int
     */
    private $_count = 0;

    /**
     *
     */
    public function __construct()
    {
        $this->timeslots = array();
    }

    /**
     * @param Timeslot $timeslot
     * @return $this
     */
    public function addTimeslot(Timeslot $timeslot)
    {
        if (!$this->overlaps($timeslot)) {
            $this->timeslots[] = $timeslot;
            ++$this->_count;
        }

        $this->sortByStartTime();
    }

    /**
     * Sort slots by starting time
     */
    private function sortByStartTime()
    {
        usort($this->timeslots, function ($timeslot1, $timeslot2) {
            $startsAt1 = $timeslot1->getStartsAt()->getTimestamp();
            $startsAt2 = $timeslot2->getStartsAt()->getTimestamp();

            if ($startsAt1 === $startsAt2) {
                return 0;
            }

            return ($startsAt1 < $startsAt2) ? -1 : 1;
        });
    }

    /**
     * @param Timeslot $timeslot
     * @return bool
     */
    public function overlaps(Timeslot $timeslot)
    {
        foreach ($this->timeslots as $existingSlot) {
            if ($timeslot->overlaps($existingSlot)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->_count;
    }

    /**
     * @return void
     */
    function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    function current()
    {
        return $this->timeslots[$this->position];
    }

    /**
     * @return mixed
     */
    function key()
    {
        return $this->position;
    }

    /**
     * @return void
     */
    function next()
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    function valid() {
        return isset($this->timeslots[$this->position]);
    }
}