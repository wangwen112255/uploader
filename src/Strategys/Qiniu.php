<?php

namespace Once\Uploader\Strategys;

use Once\Uploader\Contracts\UploadStrategy;
use PHPUnit\Framework\StaticAnalysis\HappyPath\AssertNotInstanceOf\A;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Upyun\Upyun;


class Qiniu implements UploadStrategy
{
    protected $manager;
    protected $auth;
    protected $options;
    protected $error;

    public function __construct($options = [])
    {
        try {
            $this->options = $options;
            $this->auth = new Auth($this->options['qiniu_access_key'], $this->options['qiniu_secret_key']);
            $this->manager = new UploadManager();
        }catch (Exception $e){
            throw new \Exception('七牛云上传创建失败');
        }

    }

    public function create($file_name = '', $file_path = '')
    {
        try {
            $token = $this->auth->uploadToken($this->options['qiniu_bucket']);
            list($ret, $err) = $this->manager->put($token, $file_name, file_get_contents($file_path));
            if ($err !== null) {
                throw new \Exception('上传失败请重试');
            }

        } catch (\Exception $e) {
            throw  new \Exception('七牛云配置有误');
        }


    }

    public function delete($pathname)
    {
        $err = $this->manager->delete($this->options['$manager'], $pathname);
        if ($err) {
            throw  new \Exception($err);

        }
    }


}