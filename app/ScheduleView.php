<?php

/**
 * Class ScheduleView
 */
class ScheduleView {
    /**
     * @var Schedule
     */
    private $schedule;

    /**
     * @param Schedule $schedule
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @return int
     */
    public function getNumberOfTimeslots()
    {
        return $this->schedule->count();
    }

    /**
     * return int
     */
    public function getDurationInMinutes()
    {
        /**
         * @TODO: Implementation. Include breaks between timeslots in overall schedule duration.
         */
        $first = new DateTime();
        $last = new DateTime();
        $lastDuration = 0;

        foreach ($this->schedule as $key => $timeslot) {
            if ($key === 0) {
                $first = $timeslot->getStartsAt();
            }

            if ($key === $this->schedule->count() - 1) {
                $last = $timeslot->getStartsAt();
                $lastDuration = abs($timeslot->getStartsAt()->getTimestamp() - $timeslot->getEndsAt()->getTimestamp()) / 60;
            }
        }


        return abs(($first->getTimestamp() - $last->getTimestamp()) / 60) + $lastDuration;
    }
}