<?php

/**
 * Class Timeslot
 */
abstract class Timeslot
{
    /**
     * @var Artist
     */
    private $artist;

    /**
     * @var string
     */
    private $description;

    /**
     * @var DateTime
     */
    private $startsAt;

    /**
     * @var DateTime
     */
    private $endsAt;

    /**
     * @param Artist $artist
     * @param string $description
     * @param DateTime $startsAt
     * @param DateTime $endsAt
     * @throws InvalidArgumentException
     */
    public function __construct(Artist $artist, string $description, DateTime $startsAt, DateTime $endsAt)
    {
        if (empty($artist && $description && $endsAt && $startsAt) || get_class($startsAt) !== 'DateTime' || get_class($endsAt) !== 'DateTime' || get_class($artist) !== 'Artist') {
            throw new InvalidArgumentException('empty argument');
        }

        $this->artist = $artist;
        $this->description = $description;
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
    }

    /**
     * @return Artist
     */
    public function getArtist()
    {
        return $this->artist;
    }


    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return DateTime
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * @return DateTime
     */
    public function getEndsAt()
    {
        return $this->endsAt;
    }

    /**
     * @param Timeslot $timeslot
     * @return bool
     */
    public function overlaps(Timeslot $timeslot)
    {
        return
            ( ($this->startsAt >= $timeslot->getStartsAt()) && ($this->endsAt <= $timeslot->getEndsAt()) )
            ||
            ( ($this->startsAt <= $timeslot->getStartsAt()) && ($this->endsAt > $timeslot->getStartsAt()) )
            ||
            ( ($this->startsAt < $timeslot->getEndsAt()) && ($this->endsAt > $timeslot->getEndsAt()) )
            ||
            ( ($this->startsAt <= $timeslot->getStartsAt()) && ($this->endsAt >= $timeslot->getEndsAt()) );

    }
}