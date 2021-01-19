<?php


class Post {
    private $id;
    private $title;
    private $town;
    private $agreement;
    private $company;
    private $content;


    public function __construct(string $title, string $town, string $agreement, string $company, string $content, string $id)
    {
        $this->title = $title;
        $this->town = $town;
        $this->agreement = $agreement;
        $this->company = $company;
        $this->content = $content;
        $this->id = $id;
    }

    public function getTitle(): string 
    {
        return $this->title;
    }

    public function getTown(): string
    {
        return $this->town;
    }

    public function getAgreement(): string
    {
        return $this->agreement;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getID()
    {
        return $this->id;
    }
}