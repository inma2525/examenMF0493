<?php
 class Producto {
     private $id;
     private $nombre_producto;
     private $descripcion;
     private $precio;
     private $stock;
     private $imagen_url;
     private $bd;
     private $id_categoria;
     

     public function __construct($nombre_producto, $descripcion,$precio, $stock,$imagen_url,$bd,$id_categoria,$id = null) {
         $this->id = $id;
         $this->nombre_producto = $nombre_producto;
         $this->descripcion = $descripcion;
         $this->precio = $precio;
         $this->stock = $stock;
         $this->imagen_url = $imagen_url;
         $this->bd = $bd;
         $this->id_categoria;
     }

     // Método para guardar un producto en  la base de datos
     public function guardar() {
        if (isset($this->id)) {
            // Actualizar producto existente
            $stmt = $this->bd->prepare("UPDATE productos SET nombre_producto = ? WHERE id = ?");
            return $stmt->execute([$this->nombre_producto, $this->id]);
        } else {
            // Insertar nuevo producto
            $stmt = $this->bd->prepare("INSERT INTO productos (nombre_producto) VALUES (?)");
            return $stmt->execute([$this->nombre_producto]);
        }
     }

     // Método estático para obtener todos los productos
     public static function getTodos($bd) {
         $stmt = $bd->query("SELECT * FROM productos");
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }      
     public static function getListaProductos   ($bd) {
         $stmt = $bd->query("SELECT * FROM productos");
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

    


    // Método estático para obtener un producto por su nombre
    public static function getProductoPorNombre($bd, $nombre_producto) {
        $stmt = $bd->prepare("SELECT * FROM productos WHERE nombre_producto = ?");
        $stmt->execute([$nombre_producto]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        return $producto ? $producto : null;
    }



     public function getId() {
         return $this->id;
     }

     public function getNombreProducto() {
         return $this->nombre_producto;
     }

     public function setNombreProducto($nombre_producto) {
         $this->nombre_producto = $nombre_producto;
     }

     public function setId($id) {
         $this->id = $id;
     }
 }