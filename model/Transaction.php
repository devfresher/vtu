<?php
require_once MODEL_DIR.'Utility.php';
class Product Extends Utility
{
    public function getAll()
    {

    }

    public function create($transactionData)
    {
        $newTxn = $this->db->insert('transactions', $transactionData);

        if ($newTxn > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}
?>