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
    $sql = "SELECT * FROM products ORDER BY updated_at DESC, created_at DESC, id ASC";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getid(){
    return $this->id;
  }
  public function setPrice($price){
    $this->price= $price;
  }
  public function getPrice(){
    return $this->price;
  }
  public function setStock($stock){
    $this->stock= $stock;
  }
  public function getStock(){
    return $this->stock;
  }
  public function setStatus($status){
    $this->status = $status;
  } 
  public function getStatus(){
    return $this->status;
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
  //Save
  public function save() {
        if (isset($this->id)) {
            // Edit
            $sql = "UPDATE products SET name=:name, category=:category, price=:price, stock=:stock, image_path=:image_path, status=:status, updated_at=NOW() WHERE id=:id";
            $params = [
                'name' => $this->name,
                'category' => $this->category,
                'price' => $this->price,
                'stock' => $this->stock,
                'image_path' => $this->image_path,
                'status' => $this->status,
                'id' => $this->id
            ];
            $stmt = $this->db->query($sql, $params);
            return $stmt !== false;
        } else {
            // Add
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
    //Delete
    public function delete() {
        //Hapus gambar
        if ($this->image_path && file_exists($this->image_path)) {
            unlink($this->image_path);
        }
        //Hapus data
        if (isset($this->id)) {
            $sql = "DELETE FROM products WHERE id = :id";
            $params = ['id' => $this->id];
            $stmt = $this->db->query($sql, $params);
            return $stmt !== false;
        }
        return false;
    }
    //Pencarian
    public function search($keyword) {
      $sql = "SELECT * FROM products 
              WHERE name LIKE :keyword 
              OR category LIKE :keyword 
              ORDER BY updated_at DESC, id ASC";
      
      $params = ['keyword' => "%$keyword%"];
      
      $stmt = $this->db->query($sql, $params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}