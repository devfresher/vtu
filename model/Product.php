<?php
require_once MODEL_DIR.'Utility.php';
require_once MODEL_DIR.'Categories.php';

class Product Extends Utility
{

    public function __construct($db) {
        $this->db = $db;
        $this->table1 = 'products';
        $this->table2 = 'product_plan';
    }

    public function getAllProducts($category = '')
    {
        if ($category == '') {
            $result = $this->db->getAllRecords($this->table1, "*");
        } else {
            $result = $this->db->getAllRecords($this->table1, "*", "AND category = '$category'");
        }

        if (count($result) > 0){

            $feedback = $result;
            $this->responseBody =  $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function getProductsWithPlan($plan_id, $category = '')
    {
        if ($category == '') {
            $result = $this->db->getRecFrmQry(
                "SELECT * FROM `$this->table1` LEFT JOIN `$this->table2` ON $this->table1.product_code = $this->table2.product_code WHERE $this->table2.plan_id = '$plan_id'"
            );
        } else {
            $result = $this->db->getRecFrmQry(
                "SELECT * FROM `$this->table1` LEFT JOIN `$this->table2` ON $this->table1.product_code = $this->table2.product_code WHERE $this->table1.category = '$category' AND $this->table2.plan_id = '$plan_id'"
            );
        }

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
            "SELECT * FROM `$this->table1` LEFT JOIN `$this->table2` ON $this->table1.product_code = $this->table2.product_code WHERE $this->table1.product_code = '$product_code' AND $this->table2.plan_id = '$plan_id'"
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