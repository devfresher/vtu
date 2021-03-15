<?php
require_once MODEL_DIR.'Utility.php';
require_once MODEL_DIR.'Categories.php';

class Product Extends Utility
{

    public function __construct($db) {
        $this->db = $db;
        $this->table1 = 'product';
        $this->table2 = 'product_plan';
    }

    public function getAllProducts()
    {
        
        $result = $this->db->getRecFrmQry(
            "SELECT * FROM `product_plan` LEFT JOIN `products` ON products.id = product_plan.product_id"
        );

        if (count($result) > 0){

            $feedback = $result;
            $this->responseBody =  $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function getProductsWithCat($cat_id, $plan_id)
    {
        $result = $this->db->getRecFrmQry(
            "SELECT * FROM `product_plan` LEFT JOIN `products` ON products.id = product_plan.product_id WHERE cat_id = '$cat_id' AND plan_id = '$plan_id'"
        );

        if (count($result) > 0){
            $feedback = $result;
            $this->responseBody =  $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function getProductWithCode($product_code, $plan_id)
    {
        $result = $this->db->getRecFrmQry(
            "SELECT * FROM `product_plan` LEFT JOIN `products` ON products.id = product_plan.product_id WHERE product_code = '$product_code' AND plan_id = '$plan_id'"
        );

        if (count($result) > 0){

            $feedback = $result[0];
            $this->responseBody =  $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function getProductWithId($product_plan_id)
    {
        $result = $this->db->getRecFrmQry(
            "SELECT * FROM `product_plan` LEFT JOIN `products` ON products.id = product_plan.product_id WHERE product_plan.id = '$product_plan_id' ORDER BY date DESC"
        );

        if (count($result) > 0){

            $feedback = $result[0];
            $this->responseBody =  $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}
?>