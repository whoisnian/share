# share
Upload and download files with PHP.

## Notice
* `.php` and `.html` files are not allowed to be uploaded. You can allow them in `Includes/function.php`.
* `sudo chmod -R 777 upload` to enable people to upload files.
* every file's name should be different from others.
* `php.ini` need to be changed in order to upload large files. You can change them as you want.
  * file_uploads = On
  * upload_max_filesize = 200M
  * post_max_size = 200M
  * max_execution_time = 600
  * max_input_time = 600
  * memory_limit = 200M

## Address
[http://share.whoisnian.com](http://share.whoisnian.com)
