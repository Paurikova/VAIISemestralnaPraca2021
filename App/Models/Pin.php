<?php

namespace App\Models;

use App\Config\Configuration;
use App\Core\Model;

class Pin extends Model
{

    public function __construct(
        public int $id = 0,
        public int $userID = 0,
        public ?string $title = null,
        public ?string $text = null,
        public ?string $picture = null,
        public ?string $stars = null
    )
    {
    }

    /*
     * Tahanie dat z databazy
     * Len tie stlpce, ktore potrebujem
     */
    static public function setDbColumns()
    {
        return ['id','userID','title','text','picture','stars'];
    }

    static public function setTableName()
    {
        return "pins";
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     */
    public function setUserID(int $userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     */
    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return string|null
     */
    public function getStars(): ?string
    {
        return $this->stars;
    }

    /**
     * @param string|null $stars
     */
    public function setStars(?string $stars): void
    {
        $this->stars = $stars;
    }

    public static function controlTitle($title): bool
    {
        return ($title != null) and (strlen($title) <= Configuration::MAX_LENGTH_30);
    }

    public static function controlText($text): bool
    {
        return strlen($text) <= Configuration::MAX_LENGTH_95;
    }

    public static function controlStars($stars): bool
    {
        return  (is_numeric($stars)) and ($stars >= 0 and $stars <= 5);
    }
}