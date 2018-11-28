-- mysql ユーザー名:appuser データベース名:bookapp
-- ログインして source application.sql で読み込み

CREATE DATABASE bookapp DEFAULT CHARACTER SET UTF8;

use bookapp;

create table notes (
    id int auto_increment not null,
    content text not null,
    genre varchar(20) not null,
    primary key (id)
);