<?php

//Factory
abstract class Product{
    private $sku;
    private $name;
    private $type = null;
    public function __construct($sku,$name){
        $this->sku = $sku;
        $this->name = $name;
    }
    public function getSku(){
        return $this->sku;
    }
    public function getName(){
        return $this->name;
    }
    public function getType(){
        return $this->type;
    }
}
class ProductChair extends Product{
    protected $type = 'Chair';
}
class ProductTable extends Product{
    protected $type = 'Table';
}
class ProductBookCase{
    protected $type = 'Boolcase';
}
$product = new ProductTable('0001','Table');
class ProductFactory{
    public static function build($productType,$sku,$name){
        $product = 'Product' . ucfirst($productType);
        if (class_exists($product)){
            return new $product($sku,$name);
        }else{
            throw new \Exception('Неверный тип продукта.');
        }
    }
}
class ProductController{
    public function create($productType){
        $product = ProductFactory::build($productType,$post['sku'],$post['name']);
        return $product->getType();
    }
}
