<?php

namespace App\Models;

use App\Core\Model;
use App\Config\Configuration;

class User extends Model
{
    public function __construct(
        public int $userID = 0,
        public ?string $mail = null,
        public ?string $name = null,
        public ?string $surname = null,
        public ?string $password = null
    )
    {
    }
    static public function setDbColumns()
    {
        return ['userID','mail','name','surname','password'];
    }

    static public function setTableName()
    {
        return "registration";
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
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string|null $mail
     */
    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public static function controlMail($mail) :bool
    {
        return ($mail != null) and (strpos($mail, "@")) and (substr($mail,-1,1) != "@") and (strlen($mail) <= Configuration::MAX_LENGTH_30);
    }

    public static function controlIdentification($identification) :bool
    {
        return ($identification != null) and (strlen($identification) <= Configuration::MAX_LENGTH_30);
    }
}