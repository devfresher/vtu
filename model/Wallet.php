<?php
class Wallet Extends Utility
{
    public function __construct($db) {
        $this->db = $db;
        $this->table1 = 'wallet_in';
        $this->table2 = 'wallet_out';
    }

    public function walletReadAll() {
        $walletIn = $this->db->getAllRecords($this->table1, "*");
        $walletOut = $this->db->getAllRecords($this->table2, "*");

        if ($walletIn) {
            $feedback = $walletIn;

            if ($walletOut) {
                $i = count($walletIn);
    
                foreach ($walletOut as $key) {
                    $feedback[$i] = $key;
                }
            }
            
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function walletRead($userId) {
        $walletResult = $this->db->getRecFrmQry("
            SELECT 
            user_id,old_balance,amount,
            balance_after,reference,type,status,date 
            FROM $this->table2 
            UNION ALL 
            SELECT 
            user_id,old_balance,amount,
            balance_after,reference,type,status,date 
            FROM $this->table1 ORDER BY date DESC
        ");

        if ($walletResult) {
            $feedback = $walletResult;
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function walletReadItem($userId, $table, $type='')
    {
        $walletResult = $this->db->getAllRecords($table, "*", "AND user_id = '$userId' AND type = '$type'", "ORDER BY date DESC");

        if ($walletResult) {
            $feedback = $walletResult;
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function walletReadItemWithOrderId($table, $orderId)
    {
        $walletResult = $this->db->getAllRecords($table, "*", "AND order_id = '$orderId'");

        if (count($walletResult) > 0) {
            $feedback = $walletResult[0];
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function getWalletInHistories($userId)
    {
        $walletResult = $this->db->getAllRecords($this->table1, "*", "AND user_id = '$userId'", "ORDER BY date DESC");

        if ($walletResult) {
            $feedback = $walletResult;
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function getWalletFundingHistories($userId)
    {
        $walletResult = $this->db->getAllRecords($this->table1, "*", "AND user_id = '$userId' AND type = '1'", "ORDER BY date DESC");

        if ($walletResult) {
            $feedback = $walletResult;
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody = false;
        }

        return $this->responseBody;
        var_dump($this->responseBody);
    }

    public function getMoneyShareHistories($userId)
    {
        $walletResult = $this->db->getRecFrmQry("
        SELECT  `id`,`user_id`,`old_balance`,`amount`,`balance_after`,`reference`,`type`,`status`,`date`
            FROM $this->table2 
            WHERE `user_id` = $userId AND `type` = '5' 
            UNION ALL
        SELECT  `id`,`user_id`,`old_balance`,`amount`,`balance_after`,`reference`,`type`,`status`,`date`
            FROM $this->table1
            WHERE `user_id` = $userId AND type = '2' 
            ORDER BY `date` DESC
        ");
        

        if ($walletResult) {
            $feedback = $walletResult;
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function fundWalletRequest($walletRequestData)
    {
        $topUp = $this->db->insert($this->table1, $walletRequestData);

        if ($topUp > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function approveWalletRequest($reference, $apprvdBy)
    {
        $update = $this->db->getRecFrmQry("UPDATE $this->table1 SET `status`=3, `approved_by` = $apprvdBy, `balance_after` = `old_balance` + `amount`  WHERE  `reference` = '$reference'");

        if ($update > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function spendFromWallet($walletRequestData)
    {
        $spend = $this->db->insert($this->table2, $walletRequestData);

        if ($spend > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function getWalletBalance($userId)
    {
        $total_wallet_in = $this->sumWalletIn($userId);
        $total_wallet_out = $this->sumWalletOut($userId);

        if($total_wallet_in == 0 OR $total_wallet_in < $total_wallet_out){
            $walletBalance = 0;
        }else{
            $walletBalance = $total_wallet_in - $total_wallet_out;
        }

        $this->responseBody	= $walletBalance;

        return $this->responseBody;
    }

    private function sumWalletIn($userId)
    {
        $result = $this->db->getRecFrmQry("SELECT SUM(amount) AS total_sum FROM $this->table1 WHERE user_id = '$userId' AND status = '3'");
        
        if ($result > 0) {
            $sum = (double) $result[0]['total_sum'];
        } else {
            $sum = (double) 0;
        }

        return $this->responseBody = $sum;
    }

    private function sumWalletOut($userId)
    {
        $result = $this->db->getRecFrmQry("SELECT SUM(amount) AS total_sum FROM $this->table2 WHERE user_id = '$userId'");
        
        if ($result > 0) {
            $sum = (double) $result[0]['total_sum'];
        } else {
            $sum = (double) 0;
        }

        return $this->responseBody = $sum;
    }
}