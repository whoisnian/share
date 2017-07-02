# share
Upload and download files with PHP.
## Notice
* `.php` and `.html` files are not allowed to be uploaded.
* `sudo chmod -R 777 upload` to enable people to upload files.
* every file's name should be different from others.
* `php.ini` need to be changed in order to upload large files.
  * file_uploads = On
  * upload_max_filesize = 200M
  * post_max_size = 200M
  * max_execution_time = 600
  * max_input_time = 600
  * memory_limit = 200M


## Address
[https://whitewings.cn/share/](https://whitewings.cn/share/)

## Environment
```
> CentOS   --- 7.2.1511
> Apache   --- 2.4.6
> MariaDB  --- 5.5.52
> PHP      --- 5.4.16
```
[How to create this environment ?](https://whoisnian.com/2017/04/23/LAMP%E7%8E%AF%E5%A2%83%E6%90%AD%E5%BB%BA/)
