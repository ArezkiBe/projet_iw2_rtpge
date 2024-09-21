<?php
namespace App\Models;
use App\Core\DB;
class PasswordReset extends DB
{
    private ?int $id = null;
    protected string $email;
    protected string $key;
    protected string $exp_date;


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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $email = strtolower(trim($email));
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getExpDate(): string
    {
        return $this->key;
    }

    /**
     * @param string $expDate
     */
    public function setExpDate(string $exp_date): void
    {
        $this->exp_date = $exp_date;
    }


}