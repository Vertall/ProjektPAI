<?php


class Message {
    private $id;
    private $senderID;
    private $receiverID;
    private $postID;
    private $content;
    private $time;


    public function __construct(string $id, string $senderID, string $receiverID, string $postID, 
                                string $time, string $content)
    {
        $this->senderID = $senderID;
        $this->receiverID = $receiverID;
        $this->postID = $postID;
        $this->time = $time;
        $this->content = $content;
        $this->id = $id;
    }

    public function getSenderID(): string 
    {
        return $this->senderID;
    }

    public function getReceiverID(): string 
    {
        return $this->receiverID;
    }

    public function getPostID(): string 
    {
        return $this->postID;
    }

    public function getTime(): string
    {
        return $this->time;
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