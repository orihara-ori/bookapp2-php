CREATE DATABASE bookapp DEFAULT CHARACTER SET UTF8;

-- appuser(password:12345)を作成
GRANT ALL PRIVILEGES ON bookapp.* TO appuser@localhost IDENTIFIED BY '12345';

use bookapp;

create table notes (
    id int auto_increment not null,
    content text not null,
    genre varchar(20) not null,
    primary key (id)
);