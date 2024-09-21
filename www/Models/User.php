<?php
namespace App\Models;
use App\Core\DB;
class User extends DB
{
    private ?int $id = null;
    protected string $login;
    protected string $email;
    protected string $password;
    protected ?string $password_key;
    protected ?int $role;
    protected ?int $status;
    protected ?int $is_deleted;
    protected ?string $created;
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
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setlogin(string $login): void
    {
        $login = ucwords(strtolower(trim($login)));
        $this->login = $login;
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
    public function getPwd(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPwd(string $password): void
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isDeleted(): int
    {
        return $this->is_deleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted(int $is_deleted): void
    {
        $this->is_deleted = $is_deleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setUpdated(String $updated): void
    {
        $this->updated = $updated;
    }



    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}