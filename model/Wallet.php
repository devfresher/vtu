<?php
class Wallet Extends Utility
{
    protected $responseBody;

    function __construct() {
        $this->responseBody	= array();
    }

    public function walletRead($table, $where) {
        $walletResult = $this->db->get($table, "*", "AND id = $userId");

        if ($walletResult) {
            return $walletResult;
        }
    }

    public function walletTopup($table, $walletData)
    {
        $topUp = $this->db->insert($table, $walletData);
        if ($topUp > 0) {
            return true;
        }
    }

    public function walletEdit($table, $walletData, $where)
    {
        $edit = $this->db->update($table, $walletData, $where);
        if ($edit > 0) {
           return true;
        }
    }

    public function walletWithdrawal($table, $walletData)
    {
        $withdrawal = $this->walletTopup($table, $walletData);
    }
}