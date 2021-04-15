<?php
require_once MODEL_DIR.'Utility.php';

class Plan Extends Utility
{

    public function __construct($db) {
        $this->db = $db;
        $this->table = 'plan';
        $this->table2 = 'product_plan';
    }

    public function getAllPlans()
    {
        $result = $this->db->getAllRecords($this->table, "*");

        if (count($result) > 0){

            $feedback = $result;
            $this->responseBody =  $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function getPlan($planId)
    {
        if ($result = $this->db->getAllRecords($this->table, "*", "AND id = $planId")){

            $feedback = $result[0];
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }
        
        return $this->responseBody;
    }

    public function createPlan($planData)
    {
        $this->db->beginTransaction();
        try {
            
            $createPlan = $this->db->insert($this->table, $planData);
            $planId = $this->db->lastInsertId();
            
            $createProductPlan = $this->createProductPlan($planId);
            
            if ($createPlan > 0 AND $createProductPlan > 0) {
                $this->responseBody =  true;
                $this->db->commit();
            } else {
                $this->responseBody =  false;
                $this->db->rollback();
            }
        } catch (Exception $e) {
            $this->db->rollback();
            $this->responseBody =  false;
            echo $e->getMessage();
        }

        return $this->responseBody;
    }

    public function createProductPlan($planId)
    {
        $product = new Product($this->db);
        $allProducts = $product->getAllProducts();

        $productPlanData = array();
        $i = 0;
        foreach ($allProducts as $productItem) {
            $productPlanData[$i]['product_code'] = $productItem['product_code'];
            $productPlanData[$i]['plan_id'] = $planId;
            $productPlanData[$i]['selling_percentage'] = 0;
            $productPlanData[$i]['extra_charge'] = 0;

            $i++;
        }

        try {
            $this->db->delete2("DELETE FROM ".$this->table2." WHERE plan_id = ".$planId."");

            if (isset($productPlanData) && !empty($productPlanData)) {
                $insert = $this->db->multiInsert($this->table2, $productPlanData);
                $this->responseBody =  $insert;
            }
        } catch (Exception $e) {
            $this->responseBody =  false;
            $e->getMessage();
        }

        return $this->responseBody;
    }

    public function updatePlan($planData, $planId)
    {
        $update = $this->db->update($this->table, $planData, array('id' => $planId));

        if ($update > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}