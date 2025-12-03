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
  
  public function getAll(){
    $sql = "SELECT * FROM products ORDER BY updated_at ASC, id ASC";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function setById($id)
  {
    $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";
    $stmt = $this->db->query($sql, ['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      $this->id = $user['id'];
      $this->name = $user['name'];
      $this->category = $user['category'];
      $this->price = $user['price'];
      $this->stock = $user['stock'];
      $this->image_path = $user['image_path'];
      $this->status = $user['status'];
      return true;
    }
    return false;
  }
}