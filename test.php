<?php
$dataArray = array(
    'username' => '07030237966001',
    'password' => urlencode(12345),
    'meterno' => '12345',
    'amount' => 600,
    'productid' => 'aedcprepd'
);
$data = http_build_query($dataArray);

$getUrl = "http://vtutopupbox.com/b2bhub/api/electricity?".$data;
$result_call = file_get_contents($getUrl);

print_r($result_call);
?>