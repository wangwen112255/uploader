<?php


namespace Once\Uploader;


use Illuminate\Contracts\Config\Repository;
use Once\Uploader\Strategys\Qiniu;

class Uploader
{
    protected $options;
    protected $strategy;

    public function __construct($options)
    {

        $this->strategy = new $options();

    }

    public function createFile($fle_name, $file_path)
    {
        try {
            $this->strategy->create($fle_name, $file_path);
            return true;
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function deleteFile($path_name)
    {
        try {
            return $this->strategy->delete($path_name);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function config($options = [])
    {
        $options['strategy']=ucfirst($options['strategy']);
        $strategyClass = "\\Once\\Uploader\\Strategys\\".$options['strategy'];
        $this->strategy = new $strategyClass($options);

        return $this;
    }

    public function getFileUrl($url)
    {
        try {
            return $this->strategy->getUrl();
        } catch (\Exception $e) {
            throw $e;
        }
    }


}