<?php

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $role = ['ROLE_USER'];
    private $id;

    public function __construct(
        string $email,
        string $password,
        string $name,
        string $surname,
        string $id
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->id = $id;
    }
    
    public function getName(): string 
    {
        return $this->name;
    }

    public function getSurname(): string 
    {
        return $this->surname;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole(): array
    {
        return $this->role;
    }

    public function getID(): int
    {
        return $this->id;
    }
}