<?php


namespace Once\Uploader\Strategys;


use Once\Uploader\Contracts\UploadStrategy;
use OSS\OssClient;

class Oss implements UploadStrategy
{
    protected $ossClient;
    protected $auth;
    protected $options;
    protected $error;

    public function __construct($options = [])
    {
        $this->options = $options;
        $access_key_id =$this->options['oss_access_key_id'];
        $access_key_secret = $this->options['oss_access_key_secret'];
        $endpoint =$this->options['oss_endpoint'];
        try {

            $this->ossClient = new OssClient($access_key_id, $access_key_secret, $endpoint);

        } catch (OssException $e) {
            print $e->getMessage();
        }
    }

    public function create($file_name = '', $file_path = '')
    {
        try {
//            dd($file_path);
            $bucket = $this->options['oss_bucket'];
            $this->ossClient->putObject($bucket,$file_name, file_get_contents($file_path));
        } catch (\Exception $e) {
            throw  new \Exception('上传失败：阿里云上传策略配置有误');
        }
    }

    public function delete($file_name)
    {
        try {
            $this->ossClient->deleteObject($this->options['oss_bucket'], $file_name);
        } catch (OssException $e) {
            throw  new \Exception('删除有误：阿里云上传策略配置有误');
        }

        return true;
    }

  


}