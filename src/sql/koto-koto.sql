-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2022 年 9 月 29 日 11:36
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
-- データベース: `koto-koto`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `things`
--

CREATE TABLE `things` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'userのID',
  `thing` varchar(200) NOT NULL COMMENT 'デキゴト',
  `good_thing_flag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'イイコトフラグ',
  `good_thing_rank` varchar(10) DEFAULT NULL COMMENT 'イイコトの順位',
  `bad_thing_flag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'ヤナコトフラグ',
  `bad_thing_level` varchar(10) DEFAULT NULL COMMENT 'ヤナコトの強度',
  `bad_thing_approach` varchar(1000) DEFAULT NULL COMMENT 'ヤナコトの対処法',
  `is_deleted` bit(1) NOT NULL DEFAULT b'0' COMMENT '削除フラグ',
  `create_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='デキゴトが保存されるテーブル';

--
-- テーブルのデータのダンプ `things`
--

INSERT INTO `things` (`id`, `user_id`, `thing`, `good_thing_flag`, `good_thing_rank`, `bad_thing_flag`, `bad_thing_level`, `bad_thing_approach`, `is_deleted`, `create_date_time`, `update_date_time`) VALUES
(2, 2, 'あたし、フルマラソンを完走しようと心に決めたわ！', b'1', '3', b'0', '0', NULL, b'0', '2022-08-30 04:39:11', '2022-08-30 04:39:11'),
(3, 2, 'じょうねっつのあっかいバ〜ラ〜〜♪', b'1', '1', b'0', '0', NULL, b'0', '2022-08-30 04:40:55', '2022-08-30 04:40:55'),
(34, 1, '今日はかなり涼しい、エメが振らない事を祈る。\r\nエメじゃなくて雨。', b'0', '--', b'0', '--', '', b'0', '2022-09-08 00:57:33', '2022-09-08 05:02:32'),
(35, 1, 'これはイイコト', b'1', '2', b'0', '--', '削除済みでも編集は出来る', b'0', '2022-09-08 00:59:01', '2022-09-20 02:33:04'),
(36, 1, 'これはヤナコト', b'0', '--', b'1', '中', '時が解決するのだ…', b'0', '2022-08-08 00:59:35', '2022-08-08 00:59:35'),
(37, 1, 'これはどっちにも当てはまる', b'1', '1', b'0', '--', 'イイコトだけにした', b'1', '2022-09-08 01:00:01', '2022-09-23 05:46:23'),
(38, 1, '日付で表示範囲を選択出来るようになった。\r\nま、〇〇以降で表示ってだけだけど。', b'1', '1', b'0', '--', '', b'0', '2022-09-09 05:32:09', '2022-09-09 05:32:09'),
(39, 1, 'ダルいしちょっと痛いな…関節痛？', b'0', '--', b'1', '弱', '時が過ぎゆくのを待つべし', b'0', '2022-09-12 01:10:56', '2022-09-12 01:10:56'),
(40, 1, 'ログイン出来るようになったぞ！不用意にログインしてない時の処理とか入れてるんじゃないよ！', b'1', '1', b'0', '--', '', b'0', '2022-09-15 01:15:11', '2022-09-15 01:15:11'),
(41, 1, '前途多難すぎるな。', b'0', '--', b'1', '強', 'ただでさえ時間がないのに。', b'0', '2022-09-15 05:34:28', '2022-09-15 05:34:28'),
(42, 2, 'よし！ガバガバ本人確認問題解決やろ！', b'1', '1', b'0', '--', '', b'0', '2022-09-16 02:09:06', '2022-09-16 02:09:06'),
(43, 7, '退会処理した人のデキゴト', b'0', '--', b'1', '弱', 'どうなるか…', b'0', '2022-09-16 03:50:47', '2022-09-16 03:50:47'),
(44, 1, 'SQL文の AND 忘れがち問題', b'0', '--', b'1', '弱', 'たまにしか書かないからね…毎回書き方忘れた頃に書く必要が出てくるんだね(-_-;)', b'0', '2022-09-16 05:11:39', '2022-09-16 05:11:39'),
(45, 1, 'bootstrapのグリッドシステムで、ある程度思った通りに動かせたな。', b'1', '2', b'0', '--', '', b'0', '2022-09-20 01:05:21', '2022-09-20 01:05:21'),
(46, 1, '今日は超涼しくなってる〜いいよいいよ！\r\nダブルクォートで括る必要はあるのか？\r\n無くても出来そうだけど？', b'1', '1', b'0', '--', '', b'0', '2022-09-20 01:06:02', '2022-09-20 04:14:56'),
(47, 1, 'デキゴト登録の完了画面はない方がスマートだな。\r\n今回はそこまでやらないけど。', b'1', '3', b'0', '--', '', b'0', '2022-09-20 01:45:26', '2022-09-20 02:34:31'),
(48, 1, 'test2', b'0', '--', b'1', '弱', '削除して、編集後に元に戻してみる', b'0', '2022-09-20 05:48:10', '2022-09-23 05:47:37'),
(49, 1, '$thingってなんぞ？', b'0', '--', b'1', '弱', '編集の時に使用されているものかな？', b'0', '2022-09-21 01:18:49', '2022-09-21 05:55:31'),
(50, 8, 'なんか再現できないエラーが出るとやだなぁ…', b'0', '--', b'1', '中', 'デバッグ命！なのか？', b'0', '2022-09-21 01:37:55', '2022-09-21 01:37:55'),
(51, 1, '改めてイイコト、ヤナコトどっちもあるパターンをテスト', b'1', '3', b'1', '弱', '縮まった時が問題。さて、どうなる？', b'0', '2022-09-22 05:48:22', '2022-09-22 05:48:22'),
(52, 1, '今日は雨だし、寒いかと思いきや、ジメジメでムシムシ…', b'0', '--', b'1', '弱', '界王拳を3倍まで上げるしかねぇ！', b'0', '2022-09-23 00:52:12', '2022-09-23 00:52:12'),
(53, 1, '今週でひとまず完成させる事が出来そうだぞ！？', b'1', '2', b'0', '--', '', b'0', '2022-09-26 00:52:56', '2022-09-26 00:52:56'),
(54, 10, 'デキゴトは、空のまま登録は出来ないようにする。そうしておけば、対処法だけ入力されたとしても、登録は出来ないはず', b'0', '--', b'0', '--', '', b'1', '2022-09-26 06:02:49', '2022-09-27 03:55:16'),
(55, 10, 'things/edit/successのレイアウトを見直し', b'0', '--', b'1', '弱', 'レイアウトの修正漏れ', b'0', '2022-09-26 06:14:50', '2022-09-26 06:14:50'),
(56, 10, 'これで値がない場合の登録は防げるはず。', b'1', '2', b'0', '--', '', b'0', '2022-09-27 01:26:03', '2022-09-27 02:31:24'),
(57, 10, '編集画面のレイアウトも修正', b'1', '3', b'0', '--', '', b'0', '2022-09-27 02:20:18', '2022-09-27 02:49:09'),
(58, 10, '試しにサクセスページを無くして見るテスト', b'1', '1', b'0', '--', 'やっぱりこの方が快適じゃない？', b'0', '2022-09-27 02:42:35', '2022-09-27 02:42:56'),
(59, 1, 'そろそろ提出の時が来たか！？', b'1', '1', b'0', '--', '', b'0', '2022-09-27 06:06:46', '2022-09-27 06:06:46'),
(60, 12, '今日は眼鏡っ娘です', b'1', '1', b'0', '--', '黒縁メガネも持っています！', b'0', '2022-09-28 01:45:43', '2022-09-28 01:46:37'),
(61, 1, 'いよいよ提出。\r\nどれだけのダメ出しが来るか、腹を括って置かなければ((&gt;д&lt;;))', b'1', '1', b'0', '--', '', b'0', '2022-09-28 02:43:08', '2022-09-28 02:43:08');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL COMMENT 'ユーザ名',
  `family_name` varchar(20) NOT NULL COMMENT '姓',
  `first_name` varchar(20) NOT NULL COMMENT '名',
  `birth_date` date NOT NULL COMMENT '生年月日',
  `user_mail_address` varchar(255) NOT NULL COMMENT 'メールアドレス',
  `pass` varchar(255) NOT NULL COMMENT 'パスワード',
  `is_deleted` bit(1) NOT NULL DEFAULT b'0' COMMENT '削除フラグ',
  `create_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='koto-kotoの利用者テーブル';

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `user_name`, `family_name`, `first_name`, `birth_date`, `user_mail_address`, `pass`, `is_deleted`, `create_date_time`, `update_date_time`) VALUES
(1, 'hatano', '波多野', '友哉', '1983-01-26', 'g@mail', '$2y$10$2Tuq2DmDBVSYjTsHjj2TyuwxWMPkQxtg9V9OgSfFNjc9eI7ChHlne', b'0', '2022-08-17 06:11:45', '2022-08-25 01:27:55'),
(2, 'okamoto', '岡本', 'セリアンティーヌ', '2000-07-07', 'mame@mail', '$2y$10$wlNPnCGxVFBOpq7vg7DrPuUcW946UY/1YVqUNzs01a1e6LnSrUHBS', b'0', '2022-08-17 06:24:05', '2022-09-16 02:07:49'),
(3, 'sakagami', '坂上', 'タランティーノ', '1970-10-20', 'y@mail.com', '$2y$10$cRTRWKWtVEhIg92LG2ocxOqDpiJoUg8nRO8w1t99YsrJmOy/rSS.6', b'0', '2022-08-18 04:40:58', '2022-08-18 04:40:58'),
(7, 'k', 'k', 'k', '2022-01-01', 'k@k', '$2y$10$ESbd1QnWg8dOdR4XDrw2J.foDs/JJGQlypIMjPnwzw5IyhOxrHChS', b'1', '2022-09-15 04:08:05', '2022-09-16 03:55:34'),
(8, 'm', 'm', 'm', '2018-05-05', 'm@m', '$2y$10$J4RcYb2/U1LfEZKPUTHI9.xGGucr4syTeDNKQ7xTnrRWsVijNZ7f6', b'1', '2022-09-16 05:34:45', '2022-09-23 06:03:33'),
(9, 'inari', 'i', 'i', '2021-03-04', 'i@i', '$2y$10$YhlUwkcX9g25ZNNL8.Q6su658WprLMbW80bsPNsabsvcfoCyDy3K2', b'1', '2022-09-23 06:12:58', '2022-09-26 04:09:42'),
(10, '最終確認者', 'z', 'z', '1999-10-15', 'z@z', '$2y$10$zGZTqO.xKqEi3EDZsrhr3.vz0dWlhE5lu2BK9.H.f5vD8jd7lv45i', b'0', '2022-09-26 05:31:18', '2022-09-26 05:31:18'),
(11, 'test', 'もう一度', 'テストやん', '2022-01-01', 'test@t', '$2y$10$y6vmRZVARGoiTGkVv1K3VuHGNbK9EA2tWxcmuMsjmP6KmG12zkIym', b'1', '2022-09-27 00:51:49', '2022-09-27 00:52:45'),
(12, 'おかもとせりな', '岡本', 'セリアンティーナ', '2009-05-17', 'okamoto@mail', '$2y$10$6AzM37oa/z4ehhrSi6LwY.SWOOjwwqho4p4eGyDClLEzgKiiZAuvW', b'0', '2022-09-28 01:44:08', '2022-09-28 01:44:08');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `things`
--
ALTER TABLE `things`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_users_id_user_id` (`user_id`) USING BTREE COMMENT 'usersのidと紐付けている';

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_mail_address` (`user_mail_address`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `things`
--
ALTER TABLE `things`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `things`
--
ALTER TABLE `things`
  ADD CONSTRAINT `things_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
