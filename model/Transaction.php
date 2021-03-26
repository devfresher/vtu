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
        if ($catId == '') {
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
                "SELECT t.*, SUM(t.amount) AS total, p.product_code,  pp.selling_percentage, p.product_name, p.product_icon, p.category
                FROM $this->table t
                LEFT JOIN product_plan pp ON t.product_plan_id = pp.id 
                LEFT JOIN products p ON pp.product_code = p.product_code 
                WHERE t.user_id = '$userId'
                GROUP BY t.id, p.product_name, p.product_icon, p.category
                ORDER BY t.date DESC"
            );
        }else {
            $result = $this->db->getRecFrmQry(
                "SELECT t.*, SUM(t.amount) AS total, p.product_code,  pp.selling_percentage, p.product_name, p.product_icon, p.category
                FROM $this->table t
                LEFT JOIN product_plan pp ON t.product_plan_id = pp.id 
                LEFT JOIN products p ON pp.product_code = p.product_code
                WHERE t.user_id = '$userId' AND p.category = '$catId'
                GROUP BY t.id, p.product_name, p.product_icon, p.category
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
        $result = $this->db->getRecFrmQry(
            "SELECT t.*, pp.*, p.*
            FROM $this->table t 
            LEFT JOIN product_plan pp ON t.product_plan_id = pp.id 
            LEFT JOIN products p ON pp.product_code = p.product_code
            WHERE t.order_id = '$orderId' OR t.reference = '$orderId'"
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