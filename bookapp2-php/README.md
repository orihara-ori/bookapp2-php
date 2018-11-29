
# setup
```
sudo apt-get update
sudo apt-get install nginx php-fpm -y
sudo apt-get install mysql-server mysql-client -y
sudo apt-get install php-mysql php-mbstring -y
```

# 開発環境用のDB,テーブル,ユーザーを作成
- mysqlにrootでログインしapplication.sqlを読み込む
- 作成されるユーザー名はappuser、パスワードの初期値は12345
```
mysql -u root -p
source /vagrant/bookapp2-php/application.sql
```

# DB準備
- config.php.default を config.php にコピー
- パスワードを変更した場合は手元のmysqlの物に書き換える
```
cp config.php.default config.php
```
