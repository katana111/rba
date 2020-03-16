<?php

/**
 * Class Artist
 */
class Artist {
    /**
     * @var string
     */
    private $name;

    /**
     * @param $name string
     * @throws InvalidArgumentException
     */
    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('empty argument');
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}