<?php


namespace Once\Uploader\Strategys;


use Once\Uploader\Contracts\UploadStrategy;
use OSS\OssClient;

class Local implements UploadStrategy
{
    /**
     * 根目录路径(结尾加斜杠)
     */
    protected $rootPath = null;

    protected $uploadPath = null;
    /**
     * 当前储存策略参数
     *
     * @var array
     */
    protected $options = [];

    /**
     * 错误信息
     *
     * @var null
     */
    protected $error = null;

    /**
     * Driver constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->rootPath = $_SERVER['DOCUMENT_ROOT'];
        $this->options = $options;
        $upload_dir='upload';
        if(isset($this->options['upload_dir'])){
            $upload_dir=$this->options['upload_dir'];
        }

        $this->uploadPath =$this->rootPath.DIRECTORY_SEPARATOR.$upload_dir.DIRECTORY_SEPARATOR;
    }

    /*  *
     * 创建本地文件
     *
     * @param $pathname 文件路径加文件名
     * @param $file     文件资源路径
     *
     * @return bool
     */
    public function create($file_name, $file_path)
    {
        $path = $this->uploadPath.dirname($file_name);
        if (true === $this->checkPath($path)) {
            if (move_uploaded_file($file_path,  $path.DIRECTORY_SEPARATOR.basename($file_name))) {
                return true;
            }
        }
        throw  new \Exception('上传失败');

    }

    /**
     * 删除本地文件
     *
     * @param $pathname 文件路径加文件名
     *
     * @return bool
     */
    public function delete($pathname)
    {
        $delete = @unlink($this->uploadPath.ltrim($pathname, DIRECTORY_SEPARATOR));
        dd($delete);
        if (!$delete) {
            throw  new \Exception('删除有误');
        }


    }



    /**
     * 检测目录是否可写，不存在则创建
     *
     * @param $path 路径
     *
     * @return bool
     */
    protected function checkPath($path)
    {
        if (is_dir($path)) {
            return true;
        }

        if (mkdir($path, 0755, true)) {
            return true;
        }
        throw  new \Exception('目录['.$path.']无写入权限');

    }


}