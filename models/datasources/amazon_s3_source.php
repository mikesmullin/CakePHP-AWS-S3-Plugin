<?php

/**
 * Amazon Simple Storage Service (S3) Source.
 * Provides a way to interact with Amazon's Content Distribution Network (CDN)
 * servers.
 */

class AmazonS3Source extends DataSource {
  private $s3 = null;

  public function __construct($config = array()) {
    // import the Amazon S3 Client library
    App::import('Vendor', 'AmazonS3.S3', array('file' => 'php-amazon-s3'. DS .'S3.php'));

    // intialize with credentials from ./config/database.php
    $this->s3 = new S3($config['access_key'], $config['secret_key']);

    return parent::__construct($config);
  }

  public function query($method, $args, &$model) {
    if ($method == 'init') return;
    return call_user_func_array(array($this->s3, $method), $args);
  }

}
