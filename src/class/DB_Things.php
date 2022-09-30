<?php
class DB_Things extends DB_Base
{
    /**
     * DBへ接続するコンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * thingsを追加する
     * @param array $things
     * デキゴト登録から送信されたデータ
     */
    public function thingsAdd($things, $user_id)
    {
        $que1 = isset($things['thing']) ? ',thing' : '';
        $que1 .= isset($things['good_thing_flag']) ? ',good_thing_flag' : '';
        $que1 .= isset($things['good_thing_rank']) ? ',good_thing_rank' : '';
        $que1 .= isset($things['bad_thing_flag']) ? ',bad_thing_flag' : '';
        $que1 .= isset($things['bad_thing_level']) ? ',bad_thing_level' : '';
        $que1 .= isset($things['bad_thing_approach']) ? ',bad_thing_approach' : '';

        $que2 = isset($things['thing']) ? ',:thing' : '';
        $que2 .= isset($things['good_thing_flag']) ? ',:good_thing_flag' : '';
        $que2 .= isset($things['good_thing_rank']) ? ',:good_thing_rank' : '';
        $que2 .= isset($things['bad_thing_flag']) ? ',:bad_thing_flag' : '';
        $que2 .= isset($things['bad_thing_level']) ? ',:bad_thing_level' : '';
        $que2 .= isset($things['bad_thing_approach']) ? ',:bad_thing_approach' : '';

        $sql = 'INSERT INTO';
        $sql .= ' things (user_id' . $que1 . ')';
        $sql .= ' VALUES (:user_id' . $que2 . ')';

        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        if (isset($things['thing']) == true) {
            $stmt->bindValue(':thing', $things['thing'], PDO::PARAM_STR);
        }
        if (isset($things['good_thing_flag']) == true) {
            $stmt->bindValue(':good_thing_flag', $things['good_thing_flag'], PDO::PARAM_INT);
        }
        if (isset($things['good_thing_rank']) == true) {
            $stmt->bindValue(':good_thing_rank', $things['good_thing_rank'], PDO::PARAM_STR);
        }
        if (isset($things['bad_thing_flag']) == true) {
            $stmt->bindValue(':bad_thing_flag', $things['bad_thing_flag'], PDO::PARAM_INT);
        }
        if (isset($things['bad_thing_level']) == true) {
            $stmt->bindValue(':bad_thing_level', $things['bad_thing_level'], PDO::PARAM_STR);
        }
        if (isset($things['bad_thing_approach']) == true) {
            $stmt->bindValue(':bad_thing_approach', $things['bad_thing_approach'], PDO::PARAM_STR);
        }

        $stmt->execute();

        return true;
    }

    /**
     * ログインしているユーザidのデキゴト（未削除）を取得し表示する
     */
    public function thingShow($user_id, $search_date)
    {
        $sql = 'SELECT';
        $sql .= ' id';
        $sql .= ',thing';
        $sql .= ',good_thing_flag';
        $sql .= ',good_thing_rank';
        $sql .= ',bad_thing_flag';
        $sql .= ',bad_thing_level';
        $sql .= ',bad_thing_approach';
        $sql .= ',create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE';
        $sql .= ' is_deleted = 0';
        $sql .= ' AND user_id = :user_id';
        $sql .= ' AND create_date_time >= :search_date';
        $sql .= ' ORDER BY create_date_time DESC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindValue(':search_date', $search_date, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rec;
    }

    /**
     * ログインしているユーザidのイイコト（未削除）を取得し表示する
     */
    public function goodThingShow($user_id, $search_date)
    {
        $sql = 'SELECT';
        $sql .= ' id';
        $sql .= ',thing';
        $sql .= ',good_thing_flag';
        $sql .= ',good_thing_rank';
        $sql .= ',bad_thing_flag';
        $sql .= ',bad_thing_level';
        $sql .= ',bad_thing_approach';
        $sql .= ',create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE';
        $sql .= ' is_deleted = 0';
        $sql .= ' AND user_id = :user_id';
        $sql .= ' AND good_thing_flag = 1';
        $sql .= ' AND create_date_time >= :search_date';
        $sql .= ' ORDER BY create_date_time DESC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindValue(':search_date', $search_date, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rec;
    }

    /**
     * ログインしているユーザidのナヤコト（未削除）を取得し表示する
     */
    public function badThingShow($user_id, $search_date)
    {
        $sql = 'SELECT';
        $sql .= ' id';
        $sql .= ',thing';
        $sql .= ',good_thing_flag';
        $sql .= ',good_thing_rank';
        $sql .= ',bad_thing_flag';
        $sql .= ',bad_thing_level';
        $sql .= ',bad_thing_approach';
        $sql .= ',create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE';
        $sql .= ' is_deleted = 0';
        $sql .= ' AND user_id = :user_id';
        $sql .= ' AND bad_thing_flag = 1';
        $sql .= ' AND create_date_time >= :search_date';
        $sql .= ' ORDER BY create_date_time DESC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindValue(':search_date', $search_date, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rec;
    }

    /**
     * ログインしているユーザidの削除済みデキゴトを取得し表示する
     */
    public function deletedThingShow($user_id, $search_date)
    {
        $sql = 'SELECT';
        $sql .= ' id';
        $sql .= ',thing';
        $sql .= ',good_thing_flag';
        $sql .= ',good_thing_rank';
        $sql .= ',bad_thing_flag';
        $sql .= ',bad_thing_level';
        $sql .= ',bad_thing_approach';
        $sql .= ',create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE';
        $sql .= ' user_id = :user_id';
        $sql .= ' AND is_deleted = 1';
        $sql .= ' AND create_date_time >= :search_date';
        $sql .= ' ORDER BY create_date_time DESC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindValue(':search_date', $search_date, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rec;
    }

    /**
     * 選択したidのデキゴト（未削除）を取得し表示する
     */
    public function thingSelect($id, $user_id)
    {
        $sql = 'SELECT';
        $sql .= ' id';
        $sql .= ',thing';
        $sql .= ',good_thing_flag';
        $sql .= ',good_thing_rank';
        $sql .= ',bad_thing_flag';
        $sql .= ',bad_thing_level';
        $sql .= ',bad_thing_approach';
        $sql .= ',create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE id = :id';
        $sql .= ' AND user_id = :user_id';
        $sql .= ' ORDER BY create_date_time DESC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rec;
    }

    /**
     * 削除フラグを1にUPDATEする
     */
    public function thingDelete($id, $user_id)
    {
        $sql = 'UPDATE things';
        $sql .= ' SET';
        $sql .= ' is_deleted = :is_deleted';
        $sql .= ' WHERE id = :id';
        $sql .= ' AND user_id = :user_id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':is_deleted', 1, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * 削除フラグを0にUPDATEする
     */
    public function thingUndo($id, $user_id)
    {
        $sql = 'UPDATE things';
        $sql .= ' SET is_deleted = :is_deleted';
        $sql .= ' WHERE id = :id';
        $sql .= ' AND user_id = :user_id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':is_deleted', 0, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * デキゴトを編集する
     */
    public function thingUpDate($edit_thing, $user_id, $thing)
    {
        $sql = 'UPDATE things';
        $sql .= ' SET';
        $sql .= ' thing = :thing';
        $sql .= ',good_thing_flag = :good_thing_flag';
        $sql .= ',good_thing_rank = :good_thing_rank';
        $sql .= ',bad_thing_flag = :bad_thing_flag';
        $sql .= ',bad_thing_level = :bad_thing_level';
        $sql .= ',bad_thing_approach = :bad_thing_approach';
        $sql .= ' WHERE id = :id';
        $sql .= ' AND user_id = :user_id';

        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':id', $edit_thing['get_id'], PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':thing', isset($edit_thing['thing']) == true ? $edit_thing['thing'] : $thing['thing'], PDO::PARAM_STR);
        $stmt->bindValue(':good_thing_flag', isset($edit_thing['good_thing_flag']) == true ? $edit_thing['good_thing_flag'] : $thing['good_thing_flag'], PDO::PARAM_INT);
        $stmt->bindValue(':good_thing_rank', isset($edit_thing['good_thing_rank']) == true ? $edit_thing['good_thing_rank'] : $thing['good_thing_rank'], PDO::PARAM_STR);
        $stmt->bindValue(':bad_thing_flag', isset($edit_thing['bad_thing_flag']) == true ? $edit_thing['bad_thing_flag'] : $thing['bad_thing_flag'], PDO::PARAM_INT);
        $stmt->bindValue(':bad_thing_level', isset($edit_thing['bad_thing_level']) == true ? $edit_thing['bad_thing_level'] : $thing['bad_thing_level'], PDO::PARAM_STR);
        $stmt->bindValue(':bad_thing_approach', isset($edit_thing['bad_thing_approach']) == true ? $edit_thing['bad_thing_approach'] : $thing['bad_thing_approach'], PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }
}
