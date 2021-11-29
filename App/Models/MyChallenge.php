<?php

namespace App\Models;

use App\Core\Model;

class MyChallenge  extends Model
{
    public function __construct(
        public int $id = 0,
        public int $challengeID = 0,
        public int $userID = 0,
        public float $progress = 0
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id','challengeID','userID','progress'];
    }

    static public function setTableName()
    {
        return "mychallenges";
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
     * @return float|int
     */
    public function getProgress(): float|int
    {
        return $this->progress;
    }

    /**
     * @param float|int $progress
     */
    public function setProgress(float|int $progress): void
    {
        $this->progress = $progress;
    }

    /**
     * @return int
     */
    public function getChallengeID(): int
    {
        return $this->challengeID;
    }

    /**
     * @param int $challengeID
     */
    public function setChallengeID(int $challengeID): void
    {
        $this->challengeID = $challengeID;
    }
}