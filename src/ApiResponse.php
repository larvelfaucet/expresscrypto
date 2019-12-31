<?php 
namespace larvelfaucet\ExpressCrypto;

class ApiResponse {
    private $status;
    private $message;
    private $data;

    public function __construct($data){
        $this->status = $data->status;
        $this->message = $data->message;
        foreach($data as $key => $value){
            if(!in_array($key, ['status', 'message'])){
                $this->data->$key = $value;
            }
        }
    }
}