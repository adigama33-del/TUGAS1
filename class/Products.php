<?php
class Products{

    public $name;
    public $category;
    public $image_path;

    protected $id;
    protected $price;
    protected $stock;
    protected $status;
    protected $db;

    public function __construct()
  {
    $this->db = new Database();
  }
  
}