# expresscrypto
(Unofficial) Package to operate ExpressCrypto Microwallet for Cryptcurrencies. Official website: www.expresscrypto.io.

### Installation
Install **ExpressCrypto Package** from composer.

```composer require larvelfaucet/expresscrypto```

### Usage
```
use larvelfaucet\ExpressCrypto;

$apiKey = '--API Key--';
$userToken = '--User Token--';

$client = new Expresscrypto\ApiClient($apiKey, $userToken);

// getBalance will take default currency BTC and 
// empty IP address. You can give them if you need.
$response = $client->getBalance();

// To get all available Currencies
$response = $client->getAvailableCurrencies();

```
All responses from API calls will be the object of **ApiResponse** from the namespace **larvelfaucet\ExpressCrypto**. ApiResponse will have default *status* and *message* attribute for you to
decide whether the call successfully completed. All other data from API call will be available at **ApiResponse::data** Object. 
```
// From getBalance function, you can get the balance in Satoshi as mentioned below:
$response->data->balance 
```

### Available Functions
- **getBalance** returns *ApiResponse*
    - *String* Currency (optional)
    - *String* User IP (optional)
- **getAvailableCurrencies** returns *ApiResponse*
    - *String* User IP (optional)
- **getAvailableMethods** return *Array*
- **checkUserHash** returns *ApiResponse*
    - *String* User ID (required)
    - *String* User IP (optional)
- **sendPayment** returns *ApiResponse*
    - *String* User ID (required)
    - *int* Amount (required) in Satoshi
    - *String* Currency (required)[Default: BTC]
    - *String* User IP (optional)
- **sendReferralCommission** returns *ApiResponse*
    - *String* User ID (required)
    - *int* Amount (required) in Satoshi
    - *String* Currency (required)[Default: BTC]
    - *String* User IP (optional)
- **getListOfSites** return *ApiResponse*
    - *String* User IP (optional)
