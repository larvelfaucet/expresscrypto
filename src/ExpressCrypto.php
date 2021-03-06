<?php 
namespace vin_o_o\ExpressCrypto;
use GuzzleHttp\Client;
use \Exception;

class ExpressCrypto{

    private const _version = 2;
    private const _baseUrl = 'https://expresscrypto.io/';
    private $apiKey = '';
    private $userToken = '';

    private $availableMethods = [
        'checkUserHash',
        'sendPayment',
        'sendReferralCommission',
        'getBalance',
        'getAvailableCurrencies',
        'getListOfSites',
    ];
    private $status = [
        200 => 'Success',
        400 => 'Bad Request',
        403 => 'Unauthorized',
        404 => 'No account exist under this Id in ExpressCrypto.io',
        405 => 'Insufficient funds to pay, please load your account',
        415 => 'Unsupported currency',
        423 => 'Time frame not expired',
        429 => 'Too Many Requests',
        443 => 'Failed to get balance',
        500 => 'Internal Server Error',
        501 => 'Method Not Implemented',
        520 => 'Invalid response',
        521 => 'Connection refused, please try again later...',
        524 => 'Connection error',
    ];

    protected function _token($length = 64): String {
        $bytesLength = $length / 2;
        return bin2hex(random_bytes($bytesLength));
    }

    public function __construct(String $apiKey, String $userToken){
        $this->apiKey = $apiKey;
        $this->userToken = $userToken;
    }

    public function getAvailableMethods(): Array {
        return $this->availableMethods;
    }

    public function getStatusMessage(int $status): String {
        if(!in_array($status, array_keys($this->status))){
            throw new \Exception('Status not available');
        }
        return $this->status[$status];
    }

    public function getAllStatuses(): Array {
        return array_keys($this->status);
    }

    public function isMethodExists(String $method): bool {
        return in_array($method, $this->getAvailableMethods());
    }

    protected function getUrl(String $method): String {
        return self::_baseUrl . 'public-api/v' . self::_version . '/' . $method;
    }

    protected function _call(String $method, Array $args = []){
        // Let's assume the Timeout should be 30
        $client = new Client(['timeout' => 30]); 
        //Building Args for HTTP Call
        $params = $args;
        $params['user_token'] = $this->userToken;
        $params['api_key'] = $this->apiKey;
        // var_dump($params);exit;
        $response = $client->request('POST', $this->getUrl($method), [
            'form_params' => $params
        ]);
        return json_decode($response->getBody(), true);
    }

    public function getBalance(String $currency = 'BTC', String $ip = ''){
        $params = [
            'currency' => $currency,
            'ip_user' => $ip
        ];
        return $this->_call(__FUNCTION__, $params);
    }
    

}