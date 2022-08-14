-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2022 年 8 月 15 日 07:53
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: koto-koto
--

-- --------------------------------------------------------

--
-- テーブルの構造 things
--

CREATE TABLE things (
  id int(11) NOT NULL,
  user_id int(11) NOT NULL COMMENT 'userのID',
  thing varchar(200) NOT NULL COMMENT 'デキゴト',
  good_thing_flag bit(1) NOT NULL COMMENT 'イイコトフラグ',
  good_thing_ranking tinyint(10) NOT NULL COMMENT 'イイコトの順位',
  bad_thing_flag bit(1) NOT NULL COMMENT 'ヤナコトフラグ',
  bad_thing_level tinyint(10) NOT NULL COMMENT 'ヤナコトの強度',
  bad_thing_approach varchar(1000) NOT NULL COMMENT 'ヤナコトの対処法',
  is_deleted bit(1) NOT NULL COMMENT '削除フラグ',
  create_date_time timestamp NOT NULL DEFAULT current_timestamp(),
  update_date_time timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='デキゴトが保存されるテーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 users
--

CREATE TABLE users (
  id int(11) NOT NULL,
  user_name varchar(50) NOT NULL COMMENT 'ユーザ名',
  family_name varchar(20) NOT NULL COMMENT '姓',
  first_name varchar(20) NOT NULL COMMENT '名',
  birth_date date NOT NULL COMMENT '生年月日',
  user_mail_address varchar(255) NOT NULL COMMENT 'メールアドレス',
  pass varchar(255) NOT NULL COMMENT 'パスワード',
  is_deleted bit(1) NOT NULL DEFAULT b'0' COMMENT '削除フラグ',
  create_date_time timestamp NOT NULL DEFAULT current_timestamp(),
  update_date_time timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='koto-kotoの利用者テーブル';

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス things
--
ALTER TABLE things
  ADD PRIMARY KEY (id),
  ADD KEY IX_users (user_id) USING BTREE COMMENT 'usersのidと紐付けている';

--
-- テーブルのインデックス users
--
ALTER TABLE users
  ADD PRIMARY KEY (id);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT things
--
ALTER TABLE things
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT users
--
ALTER TABLE users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 things
--
ALTER TABLE things
  ADD CONSTRAINT things_user_id_foreign FOREIGN KEY (user_id) REFERENCES `users` (id);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
