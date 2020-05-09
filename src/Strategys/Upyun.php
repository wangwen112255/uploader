<?php


namespace Once\Uploader\Strategys;


use Once\Uploader\Contracts\UploadStrategy;
use Upyun\Config;

class Upyun implements UploadStrategy
{
    protected $client;
    protected $options;
    protected $error;

    public function __construct($options = [])
    {
        try {
            $this->options = $options;
            $service_name = $this->options['upyun_service_name'];
            $service_operator = $this->options['upyun_operator_name'];
            $service_password = $this->options['upyun_operator_password'];
            $serviceConfig = new Config($service_name, $service_operator, $service_password);
            $this->client = new \Upyun\Upyun($serviceConfig);

        } catch (Exception $e) {
            throw new \Exception('又拍云上传创建失败');
        }


    }

    public function create($file_name = '', $file_path = '')
    {
        try {

            $file = fopen($file_path, 'r');
            $this->client->write($file_name, $file);
        } catch (\Exception $e) {
            throw  $e;
        }


    }

    public function delete($pathname)
    {
        try {
            $this->client->delete($pathname);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }

        return true;
    }


}