<?php


namespace Once\Uploader;


use Illuminate\Contracts\Config\Repository;

class Uploader
{
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function create()
    {

        $options = $this->config->get('uploader.options');

        return $options;
//        dd( $options);
//       echo  ('create');
    }
}