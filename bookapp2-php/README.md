
# setup
```
sudo apt-get update
sudo apt-get install nginx php-fpm -y
sudo apt-get install mysql-server mysql-client -y
sudo apt-get install php-mysql php-mbstring -y
```

# DB準備
- config.php.default を config.php にコピーして、パスワードは手元のmysqlの物に書き換える
```
cp config.php.default config.php
```
