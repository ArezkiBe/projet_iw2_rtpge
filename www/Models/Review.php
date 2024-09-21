<?php

namespace App\Models;

use App\Core\DB;

class Review extends DB
{

    private ?int $id = null;
    protected string $userName;
    protected string $content;
    protected string $created;
    protected ?string $updated;
    protected int $approved;
    protected int $user_id;


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id_review
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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

    /**
     * @return int 
     */
    public function getApproved(): int
    {
        return $this->approved;
    }

    /**
     * @param int $approved
     */
    public function setApproved(int $approved): void
    {
        $this->approved = $approved;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getCreated(): ?string
    {
        return $this->created;
    }

    /**
     * @param date $created
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
     * @param date $updated
     */
    public function setUpdated(string $time): void
    {
        $this->updated = $time;
    }


    /**
     * Get the value of userName
     */ 
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */ 
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }
}
