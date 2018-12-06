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

create table users (
    id int auto_increment not null,
    name varchar(20) not null,
    password varchar(255) not null,
    primary key (id)
);

alter table notes add (
    user_id int not null,
    parent_id int,
    created_at datetime not null default current_timestamp -- 日本時間ではない
);