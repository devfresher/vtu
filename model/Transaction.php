<?php
require_once MODEL_DIR.'Utility.php';
class Transaction Extends Utility
{

    public function __construct($db) {
        $this->db = $db;
        $this->table = 'transactions';
    }

    public function getAllTxn($catId='')
    {
        if ($catId != '') {
            $result = $this->db->getRecFrmQry(
                "SELECT t.*, pp.product_code, pp.product_plan_name, pp.cost_price, p.product_name, p.product_icon, c.name AS category
                FROM $this->table t 
                LEFT JOIN product_plan pp ON t.product_plan_id = pp.id 
                LEFT JOIN products p ON pp.product_id = p.id 
                LEFT JOIN category c ON pp.cat_id = c.id
                ORDER BY t.date DESC"
            );
        }else {
            $result = $this->db->getRecFrmQry(
                "SELECT t.*, pp.product_code, pp.product_plan_name, pp.cost_price, p.product_name, p.product_icon, c.name AS category
                FROM $this->table t 
                LEFT JOIN product_plan pp ON t.product_plan_id = pp.id 
                LEFT JOIN products p ON pp.product_id = p.id 
                LEFT JOIN category c ON pp.cat_id = c.id
                WHERE c.id = '$catId'
                ORDER BY t.date DESC"
            );
        }

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    public function getAllUserTxn($userId, $catId='')
    {
        if ($catId != '') {
            $result = $this->db->getRecFrmQry(
                "SELECT t.*, pp.product_code, pp.product_plan_name, pp.cost_price, p.product_name, p.product_icon, c.name AS category
                FROM $this->table t 
                LEFT JOIN product_plan pp ON t.product_plan_id = pp.id 
                LEFT JOIN products p ON pp.product_id = p.id 
                LEFT JOIN category c ON pp.cat_id = c.id
                WHERE t.user_id = '$userId'
                ORDER BY t.date DESC"
            );
        }else {
            $result = $this->db->getRecFrmQry(
                "SELECT t.*, pp.product_code, pp.product_plan_name, pp.cost_price, p.product_name, p.product_icon, c.name AS category
                FROM $this->table t 
                LEFT JOIN product_plan pp ON t.product_plan_id = pp.id 
                LEFT JOIN products p ON pp.product_id = p.id 
                LEFT JOIN category c ON pp.cat_id = c.id
                WHERE t.user_id = '$userId' AND c.id = '$catId'
                ORDER BY t.date DESC"
            );
        }

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    public function getTxn($orderId)
    {
        $result = $this->db->getAllRecords($this->table, "*", "AND order_id = '$orderId'", "ORDER BY date DESC");

        $result = $this->db->getRecFrmQry(
            "SELECT t.*, pp.product_code, pp.product_plan_name, pp.cost_price, p.product_name, p.product_icon, c.name AS category
            FROM $this->table t 
            LEFT JOIN product_plan pp ON t.product_plan_id = pp.id 
            LEFT JOIN products p ON pp.product_id = p.id 
            LEFT JOIN category c ON pp.cat_id = c.id
            WHERE t.order_id = '$orderId'"
        );

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    public function create($transactionData)
    {
        $newTxn = $this->db->insert($this->table, $transactionData);

        if ($newTxn > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function updateTxn($updateData, $orderid)
    {
        $whereData  = array('order_id' => $orderid);

        $update = $this->db->update($this->table, $updateData, $whereData);
        
        if ($update > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}
?>