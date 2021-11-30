<?php

namespace App\Models;

use App\Core\Model;

class News extends Model
{
    public function __construct(
        public int $id = 0,
        public ?string $title = null,
        public ?string $author = null,
        public ?string $text = null,
        public ?string $pictureTitle = null,
        public ?string $picture1 = null,
        public ?string $picture2 = null,
        public ?string $picture3 = null
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id','title','author','text','pictureTitle','picture1','picture2','picture3'];
    }

    static public function setTableName()
    {
        return "news";
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
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
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
    public function getPictureTitle(): ?string
    {
        return $this->pictureTitle;
    }

    /**
     * @param string|null $pictureTitle
     */
    public function setPictureTitle(?string $pictureTitle): void
    {
        $this->pictureTitle = $pictureTitle;
    }

    /**
     * @return string|null
     */
    public function getPicture(int $index): ?string
    {
        if ($index == 1) {
            return $this->picture1;
        } else if ($index == 2) {
            return $this->picture2;
        } else {
            return $this->picture3;
        }
    }

    /**
     * @param string|null $picture1
     */
    public function setPicture1(?string $picture1): void
    {
        $this->picture1 = $picture1;
    }

    /**
     * @param string|null $picture2
     */
    public function setPicture2(?string $picture2): void
    {
        $this->picture2 = $picture2;
    }

    /**
     * @param string|null $picture3
     */
    public function setPicture3(?string $picture3): void
    {
        $this->picture3 = $picture3;
    }
}