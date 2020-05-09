###参数字段命名须知
-   阿里云
    oss_bucket  

    oss_access_key_secret

    oss_access_key_id

    oss_cdn_domain
-   又拍云 

      upyun_service_name (服务名称)
      
      upyun_operator_name（操作员）
      
      upyun_operator_password（操作密码）
      
      upyun_cdn_domain（加速域名）

-   七牛云

    qiniu_bucket(bucket名字)
    
    qiniu_secret_key
    
    qiniu_access_key
    
    qiniu_cdn_domain
    
 ###简单使用
```php
//七牛云加速 
    $config=[
     'qiniu_bucket'=>'',
       
      'qiniu_secret_key'=>'',
       
      'qiniu_access_key'=>'',
       
      'qiniu_cdn_domain'=>'',

       'strategy'=>'qiniu
    ];
    try{
    //pathname文件保存名称
    //file_path文件临时路径，
    Uploader::config($config)->createFile($pathname, $file_path);
    
    //上传成功返回$pathname值
    }catch(){

}                           



```
 

