CakePHP AWS S3 Plugin by Mike Smullin <mike@smullindesign.com>
============

** Lets you use AWS S3 within the CakePHP environment via datasource to third-party library. **

Installation & Usage
------------

Place this directory in your plugins dir:

    ./app/plugins/amazon_s3/

Update your ./app/config/database.php with a reference to the plugin datasource:

    var $amazon_s3 = array(
      'datasource' => 'AmazonS3.AmazonS3',
      'access_key' => 'YOUR_ACCESS_KEY_HERE',
      'secret_key' => 'YOUR_SECRET_KEY_HERE'
    );

Create a new model referencing this database configuration:

e.g. in ./app/models/amazon_s3_bucket1.php:

    class AmazonS3Bucket1 extends AppModel {
      var $useDbConfig = 'amazon_s3',
          $useTable    = false,
          $bucket      = 'bucket1';
    }

Now reference from your controller action like any other model:

    try {
      $this->loadModel('AmazonS3Bucket1');
      $this->AmazonS3Bucket1->init(); // necessary for now; maybe not in the future
      $this->AmazonS3Bucket1->putObjectFile('/tmp/image.jpg', $this->AmazonS3Bucket1->bucket, 'public_image_url.jpg', S3::ACL_PUBLIC_READ);
    } catch (Exception $e) {
      die('Failed to move image to public CDN.');
    }

See third-party S3 library documentation in plugin ./vendors/php-amazon-s3/README.txt for further details:

Credits
------------

CakePHP-AWS-S3-Plugin is written by Mike Smullin and is released under the WTFPL.

S3 library is written by Donovan Schönknecht see http://undesigned.org.za/2007/10/22/amazon-s3-php-class
