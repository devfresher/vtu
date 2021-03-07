<?php
class Wallet Extends Utility
{
    protected $responseBody;

    public function walletReadAll() {
        $walletIn = $this->db->getAllRecords("wallet_in", "*");
        $walletOut = $this->db->getAllRecords("wallet_out", "*");

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
            FROM `wallet_out` 
            UNION ALL 
            SELECT 
            user_id,old_balance,amount,
            balance_after,reference,type,status,date 
            FROM wallet_in ORDER BY date DESC
        ");

        if ($walletResult) {
            $feedback = $walletResult;
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function walletReadItem($userId, $table, $type)
    {
        $walletOut = $this->db->getAllRecords($table, "*", "AND user_id = '$userId' AND type = '$type'");

        if ($walletOut) {
            $feedback = $walletOut;
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function fundWalletRequest($walletRequestData)
    {
        $topUp = $this->db->insert('wallet_in', $walletRequestData);

        if ($topUp > 0) {
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
        $result = $this->db->getRecFrmQry("SELECT SUM(amount) AS total_sum FROM wallet_in WHERE user_id = '$userId' AND status = '3'");
        
        if ($result > 0) {
            $sum = (double) $result[0]['total_sum'];
        } else {
            $sum = (double) 0;
        }

        return $this->responseBody = $sum;
    }

    private function sumWalletOut($userId)
    {
        $result = $this->db->getRecFrmQry("SELECT SUM(amount) AS total_sum FROM wallet_out WHERE user_id = '$userId'");
        
        if ($result > 0) {
            $sum = (double) $result[0]['total_sum'];
        } else {
            $sum = (double) 0;
        }

        return $this->responseBody = $sum;
    }
}