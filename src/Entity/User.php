<?php

namespace Ml\Api\Entity;

use Respect\Validation\Exceptions\NullTypeException;

class User
{
    private string $uuid;
    private ?string $firstname = null;
    private ?string $lastname = null;
    private ?string $email;
    private ?string $password = null;
    private ?string $phone = null;
    private string $created_at;

    public function get_uuid(): string
    {
        return $this->uuid;
    }

    /**
     * Chainable
     * @param string $uuid
     * 
     * @return $this
     */

    public function set_uuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function get_firstname(): ?string
    {
        return $this->firstname;
    }

    public function set_firstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function get_lastname(): ?string
    {
        return $this->lastname;
    }

    public function set_lastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function get_email(): string
    {
        return $this->email;
    }

    public function set_email(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function get_phone(): ?string
    {
        return $this->phone;
    }

    public function set_phone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function set_password(string $password)
    {
        $this->password = $password;
        return $this;
    }
    public function get_created_at(): string
    {
        return $this->created_at;
    }

    public function set_created_at(string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }



    public function unSerialize(array $user): self
    {
        if ($user['uuid']) {
            $this->set_uuid($user['uuid']);
        }
        if ($user['firstname']) {
            $this->set_firstname($user['firstname']);
        }
        if ($user['lastname']) {
            $this->set_lastname($user['lastname']);
        }
        if ($user['email']) {
            $this->set_email($user['email']);
        }
        if ($user['phone']) {
            $this->set_phone($user['phone']);
        }
        if ($user['password']) {
            $this->set_password($user['pasword']);
        }
        if ($user['created_at']) {
            $this->set_created_at($user['created_at']);
        }


        return $this;
    }

    public function serialize()
    {
        return get_object_vars($this);
    }
}
