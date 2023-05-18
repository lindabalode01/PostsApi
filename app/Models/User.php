<?php

namespace PostsApi\Models;

class User
{
    private string $id;
    private string $name;
    private string $username;
    private string $email;
    private string $phone;
    private string $website;
    private string $company;

    public function __construct(
        string $id,
        string $name,
        string $username,
        string $email,
        string $phone,
        string $website,
        string $company
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->website = $we;
        $this->company = $company;
    }

    public function getId():string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

}