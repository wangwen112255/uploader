<?php


namespace Once\Uploader\Contracts;


interface UploadStrategy
{
    public function __construct($options =[]);
    public function create($file_name,$file_path);
    public function delete($file_name);



}