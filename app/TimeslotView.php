<?php

class TimeslotView {
    /**
     * @var Timeslot
     */
    private $timeslot;

    /**
     * @param Timeslot $timeslot
     */
    public function __construct(Timeslot $timeslot)
    {
        $this->timeslot = $timeslot;
    }

    /**
     * @return int
     */
    public function getDurationInMinutes()
    {
        return $this->timeslot->getStartsAt()->diff($this->timeslot->getEndsAt())->i;
    }

    /**
     * @param int $length
     * @return string
     */
    public function getDescriptionExcerpt(int $length = 10)
    {
        return substr($this->timeslot->getDescription(), 0,  $length);
    }
}