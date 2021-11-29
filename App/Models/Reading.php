<?php

namespace App\Models;

use App\Core\Model;

class Reading extends Model
{
    public function __construct(
        public int $id = 0,
        public int $userID = 0,
        public int $year = 0,
        public int $month = 0,
        public int $time = 0
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id','userID','year','month','time'];
    }

    static public function setTableName()
    {
        return "reading";
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
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @param int $month
     */
    public function setMonth(int $month): void
    {
        $this->month = $month;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    public static function controlDate($date) :bool
    {
        return $date != null and substr_count($date, "-") == 2;
    }

    public static function correctDate($day, $month, $year) :bool
    {
        return is_numeric($day) and is_numeric($month) and is_numeric($year) and checkdate($month, $day, $year);
    }

    public static function controlTime($time) :bool
    {
        return $time != null and substr_count($time, ":") == 1;
    }

    public static function correctTime($minute, $hour) :bool
    {
        return is_numeric($minute) and is_numeric($hour) and $hour >= 0 and $hour <= 24 and $minute >= 0 and $minute <= 59;
    }
}