<?php
require_once MODEL_DIR.'Http.php';

use HttpRequest;

class Monnify
{
    /**
     * base url
     *
     * @var
     */
    private $baseUrl;
    private $v1 = "/api/v1/";
    private $v2 = "/api/v2/";


    private $oAuth2Token = '';
    private $oAuth2TokenExpires = '';

    public function __construct($config)
    {
        $this->baseUrl = $config['baseUrl'];
        $this->config = $config;
    }


    private function getBasicAuthHeader()
    {
        $authHeader = "Authorization: Basic ".base64_encode($this->config['apiKey'].':'.$this->config['secKey']);
        return $authHeader;
    }

    private function getOauth2Header()
    {
        if (time() >= $this->oAuth2TokenExpires) {
            $this->getToken();
            $authHeader = "Authorization: Bearer ".$this->oAuth2Token;
        }

        return $authHeader;
    }


    /**
     * @return $this
     */
    private function getToken()
    {
        $endpoint = "{$this->baseUrl}{$this->v1}auth/login";

        $response = json_decode(
            HttpRequest::post(
                $endpoint,
                [$this->getBasicAuthHeader()]
            )
        );

        if ($response->requestSuccessful) {
            $this->oAuth2Token = $response->responseBody->accessToken;
            $this->oAuth2TokenExpires = ((time() + $response->responseBody->expiresIn) - 60);
        }

        return $this;
    }


    /**
     * This enables you to retrieve all banks supported by Monnify for collections and disbursements.
     * @return array
     */
    public function getBanks()
    {
        $endpoint = "{$this->baseUrl}{$this->v1}banks";

        $response = json_decode(
            HttpRequest::post(
                $endpoint,
                [$this->getOauth2Header()]
            )
        );

        if ($response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * This API enables you to retrieve all banks with valid USSD short code. This is useful if you'll like to display USSD short codes for your customers to dial.
     * For a full list of banks, use @return array
     *
     * @see getBanks()
     *
     */
    public function getBanksWithUSSDShortCode()
    {
        $endpoint = "{$this->baseUrl}{$this->v1}sdk/transactions/banks";

        $response = json_decode(
            HttpRequest::get(
                $endpoint,
                [$this->getOauth2Header()]
            )
        );

        if ($response->requestSuccessful){
            return $response->responseBody;
        }

    }


    /**
     * Creates a sub account for a merchant. Allowing the merchant split transaction settlement between the main account and one or more sub account(s)
     * For $bankCode, check returned object from getBanks() or  getBanksWithUSSDShortCode()
     * @param string $bankCode
     * @param string $accountNumber The account number that should be created as a sub account.
     * @param string $email The email tied to the sub account. This email will receive settlement reports for settlements into the sub account.
     * @param string|null $currencyCode
     * @param string|null $splitPercentage
     * @return array
     *
     * Once the request is sent, a sub account code will be returned. This sub account code is the unique identifier for that sub account and will be used to reference the sub account in split payment requests.
     * <strong>Note: </strong> Currency code and Split Percentage will use the configured default in you .env file if not explicitly provided
     * Also, if bank account is not found within the provide bank code a MonnifyFailedRequestException will be thrown
     *
     */
    public function createSubAccount(string $bankCode, string $accountNumber, string $email, string $currencyCode = null, string $splitPercentage = null)
    {
        $currencyCode = $currencyCode ?? $this->config['defaultCurrencyCode'];
        $splitPercentage = $splitPercentage ?? $this->config['default_split_percentage'];

        $endpoint = "{$this->baseUrl}{$this->v1}sub-accounts";

        $response = json_decode(
            HttpRequest::post(
                $endpoint,
                [$this->getBasicAuthHeader()],
                [
                    'currencyCode' => $currencyCode,
                    'bankCode' => $bankCode,
                    'accountNumber' => $accountNumber,
                    'email' => $email,
                    'defaultSplitPercentage' => $splitPercentage,
                ]
            )
        );

        if ($response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * Creates a sub accounts for a merchant. Allowing the merchant split transaction settlement between the main account and one or more sub account(s)
     * For $bankCode, check returned object from getBanks() or  getBanksWithUSSDShortCode()
     * @param array $accounts is an array of arrays, with each individual array containing the following keys 'currencyCode', 'bankCode', 'accountNumber', 'email', and 'defaultSplitPercentage'
     * Note that you can always get the set default currency code as well as default split percentage from the monnify config file with config('monnify.default_currency_code') and config('monnify.default_split_percentage') respectively
     * @return array
     *
     * Once the request is sent, a sub account code will be returned. This sub account code is the unique identifier for that sub account and will be used to reference the sub account in split payment requests.
     * <strong>Note: </strong> If any of the provided details bank account is not found within the corresponding provide bank code a MonnifyFailedRequestException will be thrown
     *
     */
    public function createSubAccounts(array $accounts)
    {
        $endpoint = "{$this->baseUrl}{$this->v1}sub-accounts";

        $response = json_decode(
            HttpRequest::post(
                $endpoint,
                [$this->getBasicAuthHeader()],
                $accounts
            )
        );

        if ($response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * Returns a list of sub accounts previously created by the merchant.
     * @return array
     *
     */
    public function getSubAccounts()
    {
        $endpoint = "{$this->baseUrl}{$this->v1}sub-accounts";

        $response = json_decode(
            HttpRequest::get(
                $endpoint,
                [$this->getBasicAuthHeader()]
            )
        );

        if ($response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * Deletes a merchant's sub account.
     * @param string $subAccountCode The unique reference for the sub account
     * @return array
     *
     */
    public function deleteSubAccount(string $subAccountCode)
    {
        $endpoint = "{$this->baseUrl}{$this->v1}sub-accounts/$subAccountCode";

        $response = json_decode(
            HttpRequest::delete(
                $endpoint,
                [$this->getBasicAuthHeader()]
            )
        );
        
        if ($response->requestSuccessful){
            return $response->responseMessage;
        }
    }


    /**
     * Updates the information on an existing sub account for a merchant.
     *
     * @param string $subAccountCode The unique reference for the sub account
     * @param string $bankCode
     * @param string $accountNumber
     * @param string $email The email tied to the sub account. This email will receive settlement reports for settlements into the sub account.
     * @param string|null $currencyCode
     * @param string|null $splitPercentage
     * @return array
     *
     */
    public function updateSubAccount(string $subAccountCode, string $bankCode, string $accountNumber, string $email, string $currencyCode = null, string $splitPercentage = null)
    {
        $currencyCode = $currencyCode ?? $this->config['default_currency_code'];
        $splitPercentage = $splitPercentage ?? $this->config['default_split_percentage'];

        $endpoint = "{$this->baseUrl}{$this->v1}sub-accounts";

        $response = json_decode(
            HttpRequest::put(
                $endpoint,
                [$this->getBasicAuthHeader()],
                [
                    'subAccountCode' => $subAccountCode,
                    'currencyCode' => $currencyCode,
                    'bankCode' => $bankCode,
                    'accountNumber' => $accountNumber,
                    'email' => $email,
                    'defaultSplitPercentage' => $splitPercentage,
                ]
            )
        );

        if (!$response->requestSuccessful) {
            return $response->responseBody;
        }
    }


    /**
     * This returns all transactions done by a merchant.
     *
     * @param array $queryParams
     * @return object
     *
     * @throws MonnifyFailedRequestException
     *
     * Kindly check here for query parameters keys
     * @link https://docs.teamapt.com/display/MON/Get+All+Transactions
     */
    public function getAllTransactions(array $queryParams)
    {
        $endpoint = "{$this->baseUrl}{$this->v1}transactions/search?" . http_build_query($queryParams, '', '&amp;');

        $response = json_decode(
            HttpRequest::get(
                $endpoint,
                [$this->getOauth2Header()]
            )
        );

        if (!$response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * Once an account number has been reserved for a customer, the customer can make payment by initiating a transfer to that account number at any time. Once the transfer hits the partner bank, we will notify you with the transfer details along with the accountReference you specified when reserving the account.
     *
     * @param string $accountReference Your unique reference used to identify this reserved account
     * @param string $accountName The name you want to be attached to the reserved account. This will be displayed during name enquiry
     * @param string $customerEmail Email address of the customer who the account is being reserved for. This is the unique identifier for each customer.
     * @param string $customerName Full name of the customer who the account is being reserved for
     * @param string|null $customerBvn BVN of the customer the account is being reserved for. Although this field is not mandated, it is advised that it is supplied. Please note that there could be low limits on the reserved account in future, if BVN is not supplied.
     * @param string|null $currencyCode
     * @param bool $restrictPaymentSource
     * @param array $allowedPaymentSources
     * @return object
     
     * @link https://docs.teamapt.com/display/MON/Reserving+An+Account
     */
    public function reserveAccount(string $accountReference, string $accountName, string $customerEmail, string $customerName = null, string $customerBvn = null, string $currencyCode = null, bool $restrictPaymentSource = false, $allowedPaymentSources = [])
    {
        if ($restrictPaymentSource && is_null($allowedPaymentSources))
            throw ("Allowed Payment Sources can't be null if payment source is restricted");

        $endpoint = "{$this->baseUrl}{$this->v2}bank-transfer/reserved-accounts";

        $requestBody = [
            "accountReference" => $accountReference,
            "accountName" => $accountName,
            "currencyCode" => $currencyCode ?? $this->config['defaultCurrencyCode'],
            "contractCode" => $this->config['contractCode'],
            "customerEmail" => $customerEmail,
            "getAllAvailableBanks"=> true,
            // "restrictPaymentSource" => $restrictPaymentSource,
        ];

        if ((!is_null($customerName)) && (!empty(trim($customerName))))
            $requestBody['customerName'] = $customerName;

        if ((!is_null($customerBvn)) && (!empty(trim($customerBvn))))
            $requestBody['bvn'] = $customerBvn;

        // if (!is_null($allowedPaymentSources))
        //     $requestBody['allowedPaymentSources'] = $allowedPaymentSources;

        $response = json_decode(
            HttpRequest::post(
                $endpoint, 
                [$this->getOauth2Header()], 
                $requestBody
            )
        );

        if ($response->requestSuccessful) {
            return $response->responseBody;
        }
    }


    /**
     * If you want to get the details of a reserved account, you can initiate a GET request to the endpoint below and we will return all the details attached to that account Reference.
     *
     * @param string $accountReference Your unique reference used to identify this reserved account
     * @return object
     *
     * @link https://docs.teamapt.com/display/MON/Get+Reserved+Account+Details
     */
    public function getReservedAccountDetails(string $accountReference)
    {
        $endpoint = "{$this->baseUrl}{$this->v1}bank-transfer/reserved-accounts/$accountReference";

        $response = json_decode(
            HttpRequest::get(
                $endpoint, 
                [$this->getOauth2Header()]
            )
        );

        if ($response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * You can update income splitting config for a reserved account using the endpoint below.
     *
     * @param string $accountReference Your unique reference used to identify this reserved account
     * @param MonnifyIncomeSplitConfig $incomeSplitConfig
     * @return object
     *
     * @link https://docs.teamapt.com/display/MON/Updating+Split+Config+for+Reserved+Account
     */
    public function updateReservedAccountSplitConfig(string $accountReference, $incomeSplitConfig = [])
    {
        $endpoint = "{$this->baseUrl}{$this->v1}bank-transfer/reserved-accounts/update-income-split-config/$accountReference";

        $response = json_decode(
            HttpRequest::put(
                $endpoint,
                [$this->getOauth2Header()],
                $incomeSplitConfig,
            )
        );

        if (!$response->requestSuccessful) {
            return $response->responseBody;
        }
    }


    /**
     * You can get a paginated list of transactions processed to a reserved account by making a GET Request to the endpoint below and by specifying the accountReference as a query parameter. You can also specify the page number and size (number of transactions) you want returned per page.
     *
     * @param string $accountReference Your unique reference used to identify this reserved account
     * @param int $page The page of data you want returned by Monnify (Starts from 0)
     * @param int $size The number of records you want returned in a page.
     * @return object
     *
     * @throws MonnifyFailedRequestException
     * @link https://docs.teamapt.com/display/MON/Getting+all+transactions+on+a+reserved+account
     */
    public function getAllTransactionsForReservedAccount(string $accountReference, int $page = 0, int $size = 10)
    {
        $endpoint = "{$this->baseUrl}{$this->v1}bank-transfer/reserved-accounts/transactions?accountReference=$accountReference&page=$page&size=$size";

        $response = json_decode(
            HttpRequest::get(
                $endpoint, 
                [$this->getOauth2Header()]
            )
        );

        if (!$response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * You can delete a reserved account by initiating a DELETE request to the endpoint below. We will immediately deallocate the account.
     * Please note this action cannot be reversed!!
     *
     * @param string $accountNumber The virtual account number generated for the accountReference (Reserved account number)
     * @return object
     *
     * @throws MonnifyFailedRequestException
     * @link https://docs.teamapt.com/display/MON/Deallocating+a+reserved+account
     */
    public function deallocateReservedAccount(string $accountNumber)
    {
        $endpoint = "{$this->baseUrl}{$this->v1}bank-transfer/reserved-accounts/$accountNumber";

        $response = json_decode(
            HttpRequest::delete(
                $endpoint,
                [$this->getOauth2Header()]
            )
        );

        if (!$response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * This API enables you restrict accounts that can fund a reserved account. This most used for a wallet system where you want only the owner of a reserved account to fund the reserved account.
     *
     * You can explicitly specify account numbers, or specify one or more account names.
     *
     * <strong>How are specified rules applied?</strong>
     * If only account numbers are specified, funding of account will be restricted to specified account numbers.
     * If only account names are specified, funding of account will be restricted to specified account names.
     * If both account numbers and account names are specified, funding will be permitted when either of the two rules match, i.e. source account number matches specified account numbers or source account name matches specified account name.
     * Account Name Matching Rule
     *
     * Matching of source account name is dynamic, such that if CIROMA CHUKWUMA ADEKUNLE is the specified account name, funding of accounts will be permitted from accounts with name that has AT LEAST TWO words from the specified name, and in any order.
     *
     * @param string $accountReference Your unique reference used to identify this reserved account
     * @param MonnifyAllowedPaymentSources $allowedPaymentSources
     * @return object
     *
     * @throws MonnifyFailedRequestException
     * @link https://docs.teamapt.com/display/MON/Getting+all+transactions+on+a+reserved+account
     */
    public function sourceAccountRestriction(string $accountReference, $allowedPaymentSources = [])
    {
        $endpoint = "{$this->baseUrl}{$this->v1}bank-transfer/reserved-accounts/update-payment-source-filter/$accountReference";

        $response = json_decode(
            HttpRequest::put(
                $endpoint,
                [$this->getOauth2Header()],
                [
                    "restrictPaymentSource" => true,
                    "allowedPaymentSources" => $allowedPaymentSources
                ],
            )
        );

        if (!$response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * Allows you initialize a transaction on Monnify and returns a checkout URL which you can load within a browser to display the payment form to your customer.
     *
     * @param float $amount The amount to be paid by the customer
     * @param string $customerName Full name of the customer
     * @param string $customerEmail Email address of the customer
     * @param string $paymentReference Merchant's Unique reference for the transaction.
     * @param string $paymentDescription Description for the transaction. Will be returned as part of the account name on name enquiry for transfer payments.
     * @param string $redirectUrl A URL which user will be redirected to, on completion of the payment.
     * @param MonnifyPaymentMethods $monnifyPaymentMethods
     * @param MonnifyIncomeSplitConfig $incomeSplitConfig
     * @param string|null $currencyCode
     * @return array
     *
     * @throws MonnifyFailedRequestException
     * @link https://docs.teamapt.com/display/MON/Initialize+Transaction
     */
    public function initializeTransaction(float $amount, string $customerName, string $customerEmail, string $paymentReference, string $paymentDescription, string $redirectUrl, $monnifyPaymentMethods = [], $incomeSplitConfig = [], string $currencyCode = null)
    {
        $endpoint = "{$this->baseUrl}{$this->v1}merchant/transactions/init-transaction";

        $formData = [
            "amount" => $amount,
            "customerName" => trim($customerName),
            "customerEmail" => $customerEmail,
            "paymentReference" => $paymentReference,
            "paymentDescription" => trim($paymentDescription),
            "currencyCode" => $currencyCode ?? $this->config['default_currency_code'],
            "contractCode" => $this->config['contract_code'],
            "redirectUrl" => trim($redirectUrl),
            "paymentMethods" => $monnifyPaymentMethods,
        ];

        if ($incomeSplitConfig !== null)
            $formData["incomeSplitConfig"] = $incomeSplitConfig;

        $response = json_decode(
            HttpRequest::post(
                $endpoint,
                [$this->getOauth2Header()],
                $formData
            )
        );

        if (!$response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * When Monnify sends transaction notifications, we add a transaction hash for security reasons. We expect you to try to recreate the transaction hash and only honor the notification if it matches.
     *
     * To calculate the hash value, concatenate the following parameters in the request body and generate a hash using the SHA512 algorithm:
     *
     * @param string $paymentReference Unique reference generated by the merchant for each transaction. However, will be the same as transactionReference for reserved accounts.
     * @param mixed $amountPaid The amount that was paid by the customer
     * @param string $paidOn Date and Time when payment happened in the format dd/mm/yyyy hh:mm:ss
     * @param string $transactionReference Unique transaction reference generated by Monnify for each transaction
     * @return string Hash of successful transaction
     *
     * @link https://docs.teamapt.com/display/MON/Calculating+the+Transaction+Hash
     */
    public function calculateTransactionHash(string $paymentReference, $amountPaid, string $paidOn, string $transactionReference)
    {
        $clientSK = $this->config['seckey'];
        return hash('sha512', "$clientSK|$paymentReference|$amountPaid|$paidOn|$transactionReference");
    }

    public function calculateTransactionHashFix(string $paymentReference, $amountPaid, string $paidOn, string $transactionReference)
    {
        $clientSK = $this->config['seckey'];
        return hash('sha512', "$clientSK|$paymentReference|$amountPaid|$paidOn|$transactionReference");
    }


    /**
     * We highly recommend that when you receive a notification from us, even after checking to ensure the hash values match,
     * you should initiate a get transaction status request to us with the transactionReference to confirm the actual status of that transaction before updating the records on your database.
     *
     * @param string $transactions Unique transaction reference generated by Monnify for each transaction
     * @return object
     *
     * @throws MonnifyFailedRequestException
     * @link https://docs.teamapt.com/display/MON/Get+Transaction+Status
     */
    public function getTransactionStatus(string $transactions)
    {
        $endpoint = "{$this->baseUrl}{$this->v2}transactions/$transactions/";

        $response = json_decode(
            HttpRequest::get(
                $endpoint,
                [$this->getOauth2Header()]
            )
        );
        
        if ($response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * Allows you get virtual account details for a transaction using the transactionReference of an initialized transaction.
     * This is useful if you want to control the payment interface.
     * There are a lot of UX considerations to keep in mind if you choose to do this so we recommend you read this @link https://docs.teamapt.com/display/MON/Optimizing+Your+User+Experience.
     *
     * @param string $transactionReference
     * @param string $bankCode
     * @return array
     *
     * @link https://docs.teamapt.com/display/MON/Pay+with+Bank+Transfer
     */
    public function payWithBankTransfer(string $transactionReference, string $bankCode)
    {
        $endpoint = "{$this->baseUrl}{$this->v1}merchant/bank-transfer/init-payment";

        $response = json_decode(
            HttpRequest::post(
                $endpoint,
                [$this->getBasicAuthHeader()],
                [
                    "transactionReference" => $transactionReference,
                    "bankCode" => trim($bankCode),
                ], 
            )
        );

        if (!$response->requestSuccessful){
            return $response->responseBody;
        }
    }


    /**
     * To initiate a single transfer,  you will need to send a request to the endpoint below:
     *
     * If the merchant does not have Two Factor Authentication (2FA) enabled, the transaction will be processed instantly and the response will be as follows:
     *
     * If the merchant has Two Factor Authentication (2FA) enabled, a One Time Password (OTP) will be sent to the designated email address(es). That OTP will need to be supplied via the VALIDATE OTP REQUEST before the transaction can be approved. If 2FA is enabled,
     *
     * @param float $amount
     * @param string $reference
     * @param string $narration
     * @param MonnifyBankAccount $bankAccount
     * @param string|null $currencyCode
     * @return array
     *
     * @see https://docs.teamapt.com/display/MON/Initiate+Transfer
     */
    public function initiateTransferSingle(float $amount, string $reference, string $narration, string $bankAccountNumber, string $bankCode, string $currencyCode = null)
    {
        $endpoint = "{$this->baseUrl}{$this->v1}disbursements/single";

        $response = json_decode(
            HttpRequest::post(
                $endpoint,
                [$this->getBasicAuthHeader()],
                [
                    "amount" => $amount,
                    "reference" => trim($reference),
                    "narration" => trim($narration),
                    "bankCode" => $bankCode,
                    "accountNumber" => $bankAccountNumber,
                    "currency" => $currencyCode ?? $this->config['default_currency_code'],
                    "walletId" => $this->config['wallet_id']
                ]
            )
        );

        if (!$response->requestSuccessful){
            return $response->initiateTransferSingle;
        }
    }

}
