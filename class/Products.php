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
  public function getid(){
    return $this->id;
  }
  public function setPrice($price){
    $this->price= $price;
  }
  public function setStock($stock){
    $this->stock= $stock;
  }
  public function setStatus($status){
    $this->status = $status;
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
  public function save() {
        if (isset($this->id)) {
            $sql = "INSERT INTO products (name, category, price, stock, image_path, status, created_at, updated_at) 
                    VALUES (:name, :category, :price, :stock, :image_path, :status, NOW(), NOW())";
            $params = [
                'name' => $this->name,
                'category' => $this->category,
                'price' => $this->price,
                'stock' => $this->stock,
                'image_path' => $this->image_path,
                'status' => $this->status
            ];
            $stmt = $this->db->query($sql, $params);
            if ($stmt !== false) {
                $this->id = $this->db->conn->lastInsertId();
                return true;
            }
            return false;
        }
    }
}