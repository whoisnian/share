# share
Upload and download files with PHP.

## Notice
* `.php` and `.html` files are not allowed to be uploaded. You can allow them in `Includes/function.php`.
* `sudo chown -R http share && sudo chgrp -R http share` to enable apache to upload files.
* `sudo chmod 555 share` to avoid deleting files in directory `share` unexpectedly.
* Every file's name should be different from others.
* You can disable php engine in `upload` directory by adding this to `httpd.conf`. And don't forget to change the directory to yours.
  ```
  <Directory "/var/www/share/upload">
    php_flag engine off
  </Directory>
  ```
* `php.ini` need to be changed in order to upload large files. You can change them as you want. For example, 
  * `file_uploads = On`
  * `upload_max_filesize = 200M`
  * `post_max_size = 200M`
  * `max_execution_time = 600`
  * `max_input_time = 600`
  * `memory_limit = 200M`

## Address
[http://share.whoisnian.com](http://share.whoisnian.com)
