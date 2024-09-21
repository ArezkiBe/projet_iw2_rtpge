<?php
namespace App\Models;
use App\Core\DB;
class Page extends DB
{
    private ?int $id = null;
    protected string $title;
    protected string $content;
    protected string $type;
    protected string $created;
    protected ?string $updated;

    /**
     * @return int
     */
    public function getId(): ?int
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
     * @return string
     */
    public function gettitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function settitle(string $title): void
    {
        $login = $title;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    public function getCreated(): ?string
    {
        return $this->created;
    }

    /**
     * @param date created
     */
    public function setCreated(string $time): void
    {
        $this->created = $time;
    }

    public function getUpdated(): ?string
    {
        return $this->updated;
    }

    /**
     * @param date updated
     */
    public function setUpdated(string $updated): void
    {
        $this->updated = $updated;
    }

    public function checkSlug($slug): bool
    {   
        $slug = urlencode($slug);
        if (substr_count($slug,"/") >1)
        {
            return false;
        }

        $slug = "/".str_replace("/","",strtolower(trim($slug)));
        $request = $this->checkUnique("slug",$slug);
        return $request;
    }


    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}