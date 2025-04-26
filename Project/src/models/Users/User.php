<?php
class User{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function setName(string $name){
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
