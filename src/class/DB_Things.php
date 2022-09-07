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
        // $que1 = ltrim($que1, ',');

        $que2 = isset($things['thing']) ? ',:thing' : '';
        $que2 .= isset($things['good_thing_flag']) ? ',:good_thing_flag' : '';
        $que2 .= isset($things['good_thing_rank']) ? ',:good_thing_rank' : '';
        $que2 .= isset($things['bad_thing_flag']) ? ',:bad_thing_flag' : '';
        $que2 .= isset($things['bad_thing_level']) ? ',:bad_thing_level' : '';
        $que2 .= isset($things['bad_thing_approach']) ? ',:bad_thing_approach' : '';
        // $que2 = ltrim($que2, ',');

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
    public function thingShow($user_id)
    {
        $sql = 'SELECT';
        $sql .= ' id,thing,good_thing_flag,good_thing_rank,bad_thing_flag,bad_thing_level,bad_thing_approach,create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE is_deleted = 0 AND user_id=:user_id';
        $sql .= ' ORDER BY create_date_time DESC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rec;
    }

    /**
     * ログインしているユーザidのイイコト（未削除）を取得し表示する
     */
    public function goodThingShow($user_id)
    {
        $sql = 'SELECT';
        $sql .= ' id,thing,good_thing_flag,good_thing_rank,bad_thing_flag,bad_thing_level,bad_thing_approach,create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE is_deleted = 0 AND user_id=:user_id AND good_thing_flag=1';
        $sql .= ' ORDER BY create_date_time DESC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rec;
    }

    /**
     * ログインしているユーザidのナヤコト（未削除）を取得し表示する
     */
    public function badThingShow($user_id)
    {
        $sql = 'SELECT';
        $sql .= ' id,thing,good_thing_flag,good_thing_rank,bad_thing_flag,bad_thing_level,bad_thing_approach,create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE is_deleted = 0 AND user_id=:user_id AND bad_thing_flag=1';
        $sql .= ' ORDER BY create_date_time DESC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rec;
    }

    /**
     * ログインしているユーザidの削除済みデキゴトを取得し表示する
     */
    public function deletedThingShow($user_id)
    {
        $sql = 'SELECT';
        $sql .= ' id,thing,good_thing_flag,good_thing_rank,bad_thing_flag,bad_thing_level,bad_thing_approach,create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE is_deleted = 1 AND user_id=:user_id';
        $sql .= ' ORDER BY create_date_time DESC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

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
        $sql .= ' id,thing,good_thing_flag,good_thing_rank,bad_thing_flag,bad_thing_level,bad_thing_approach,create_date_time';
        $sql .= ' FROM things';
        $sql .= ' WHERE id=:id AND user_id=:user_id';
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
        $sql = 'UPDATE things SET is_deleted=:is_deleted WHERE id=:id AND user_id=:user_id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':is_deleted', 1, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * デキゴトを編集する
     */
    public function thingUpDate($edit_thing, $user_id, $thing)
    {
        // $que1 = isset($edit_thing['thing']) ? ',thing' : '';
        // $que1 .= isset($edit_thing['good_thing_flag']) ? ',good_thing_flag' : '';
        // $que1 .= isset($edit_thing['good_thing_rank']) ? ',good_thing_rank' : '';
        // $que1 .= isset($edit_thing['bad_thing_flag']) ? ',bad_thing_flag' : '';
        // $que1 .= isset($edit_thing['bad_thing_level']) ? ',bad_thing_level' : '';
        // $que1 .= isset($edit_thing['bad_thing_approach']) ? ',bad_thing_approach' : '';
        // $que1 = ltrim($que1, ',');

        // $que2 = isset($edit_thing['thing']) ? ':thing' : '';
        // $que2 .= isset($edit_thing['good_thing_flag']) ? ':good_thing_flag' : '';
        // $que2 .= isset($edit_thing['good_thing_rank']) ? ':good_thing_rank' : '';
        // $que2 .= isset($edit_thing['bad_thing_flag']) ? ':bad_thing_flag' : '';
        // $que2 .= isset($edit_thing['bad_thing_level']) ? ':bad_thing_level' : '';
        // $que2 .= isset($edit_thing['bad_thing_approach']) ? ':bad_thing_approach' : '';
        // $que2 = ltrim($que2, ',');

        $sql = 'UPDATE things';
        $sql .= ' SET';
        // $sql .= (isset($edit_thing['thing']) ? ' thing=' : '')(isset($edit_thing['thing']) ? ':thing,' : '');
        // $sql .= (isset($edit_thing['good_thing_flag']) ? ' good_thing_flag=' : '')(isset($edit_thing['good_thing_flag']) ?  ':good_thing_flag,' : '');
        // $sql .= (isset($edit_thing['good_thing_rank']) ? ' good_thing_rank=' : '')(isset($edit_thing['good_thing_rank']) ? ':good_thing_rank,' : '');
        // $sql .= (isset($edit_thing['bad_thing_flag']) ? ' bad_thing_flag=' : '')(isset($edit_thing['bad_thing_flag']) ? ' :bad_thing_flag,' : '');
        // $sql .= (isset($edit_thing['bad_thing_level']) ? ' bad_thing_level=' : '')(isset($edit_thing['bad_thing_level']) ? ':bad_thing_level,' : '');
        // $sql .= (isset($edit_thing['bad_thing_approach']) ? ' bad_thing_approach=' : '')(isset($edit_thing['bad_thing_approach']) ? ':bad_thing_approach' : '');

        $sql .= ' thing=:thing';
        $sql .= ',good_thing_flag=:good_thing_flag';
        $sql .= ',good_thing_rank=:good_thing_rank';
        $sql .= ',bad_thing_flag=:bad_thing_flag';
        $sql .= ',bad_thing_level=:bad_thing_level';
        $sql .= ',bad_thing_approach=:bad_thing_approach';

        $sql .= ' WHERE id=:id';
        $sql .= ' AND user_id=:user_id';

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

        // if (isset($edit_thing['thing']) == true) {
        //     $stmt->bindValue(':thing', $edit_thing['thing'], PDO::PARAM_STR);
        // }
        // if (isset($edit_thing['good_thing_flag']) == true) {
        //     $stmt->bindValue(':good_thing_flag', $edit_thing['good_thing_flag'], PDO::PARAM_INT);
        // }
        // if (isset($edit_thing['good_thing_rank']) == true) {
        //     $stmt->bindValue(':good_thing_rank', $edit_thing['good_thing_rank'], PDO::PARAM_INT);
        // }
        // if (isset($edit_thing['bad_thing_flag']) == true) {
        //     $stmt->bindValue(':bad_thing_flag', $edit_thing['bad_thing_flag'], PDO::PARAM_INT);
        // }
        // if (isset($edit_thing['bad_thing_level']) == true) {
        //     $stmt->bindValue(':bad_thing_level', $edit_thing['bad_thing_level'], PDO::PARAM_INT);
        // }
        // if (isset($edit_thing['bad_thing_approach']) == true) {
        //     $stmt->bindValue(':bad_thing_approach', $edit_thing['bad_thing_approach'], PDO::PARAM_STR);
        // }

        $stmt->execute();

        return true;
    }

    /**
     * デキゴトを編集するバックアップ
     */
    // public function thingUpDate($edit_thing, $user_id)
    // {
    //     $que1 = isset($edit_thing['thing']) ? ',thing' : '';
    //     $que1 .= isset($edit_thing['good_thing_flag']) ? ',good_thing_flag' : '';
    //     $que1 .= isset($edit_thing['good_thing_rank']) ? ',good_thing_rank' : '';
    //     $que1 .= isset($edit_thing['bad_thing_flag']) ? ',bad_thing_flag' : '';
    //     $que1 .= isset($edit_thing['bad_thing_level']) ? ',bad_thing_level' : '';
    //     $que1 .= isset($edit_thing['bad_thing_approach']) ? ',bad_thing_approach' : '';
    //     // $que1 = ltrim($que1, ',');

    //     $que2 = isset($edit_thing['thing']) ? ',:thing' : '';
    //     $que2 .= isset($edit_thing['good_thing_flag']) ? ',:good_thing_flag' : '';
    //     $que2 .= isset($edit_thing['good_thing_rank']) ? ',:good_thing_rank' : '';
    //     $que2 .= isset($edit_thing['bad_thing_flag']) ? ',:bad_thing_flag' : '';
    //     $que2 .= isset($edit_thing['bad_thing_level']) ? ',:bad_thing_level' : '';
    //     $que2 .= isset($edit_thing['bad_thing_approach']) ? ',:bad_thing_approach' : '';
    //     // $que2 = ltrim($que2, ',');

    //     $sql = 'UPDATE SET';
    //     $sql .= ' things (user_id' . $que1 . ')';
    //     $sql .= ' VALUES (:user_id' . $que2 . ')';

    //     $stmt = $this->dbh->prepare($sql);

    //     // SQL文の該当箇所に、変数の値を割り当て（バインド）する
    //     $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    //     if (isset($edit_thing['thing']) == true) {
    //         $stmt->bindValue(':thing', $edit_thing['thing'], PDO::PARAM_STR);
    //     }
    //     if (isset($edit_thing['good_thing_flag']) == true) {
    //         $stmt->bindValue(':good_thing_flag', $edit_thing['good_thing_flag'], PDO::PARAM_INT);
    //     }
    //     if (isset($edit_thing['good_thing_rank']) == true) {
    //         $stmt->bindValue(':good_thing_rank', $edit_thing['good_thing_rank'], PDO::PARAM_INT);
    //     }
    //     if (isset($edit_thing['bad_thing_flag']) == true) {
    //         $stmt->bindValue(':bad_thing_flag', $edit_thing['bad_thing_flag'], PDO::PARAM_INT);
    //     }
    //     if (isset($edit_thing['bad_thing_level']) == true) {
    //         $stmt->bindValue(':bad_thing_level', $edit_thing['bad_thing_level'], PDO::PARAM_INT);
    //     }
    //     if (isset($edit_thing['bad_thing_approach']) == true) {
    //         $stmt->bindValue(':bad_thing_approach', $edit_thing['bad_thing_approach'], PDO::PARAM_STR);
    //     }

    //     $stmt->execute();

    //     return true;
    // }

    /**
     * searchに入力した文字列がitem_name内に存在するか
     * あいまい検索する
     */
    public function dbSearch($get)
    {
        $sql = 'SELECT';
        $sql .= ' todo_items.id';
        $sql .= ',todo_items.user_id';
        $sql .= ',todo_items.item_name';
        $sql .= ',todo_items.registration_date';
        $sql .= ',todo_items.expire_date';
        $sql .= ',todo_items.finished_date';
        $sql .= ',todo_items.is_deleted';
        $sql .= ',users.family_name';
        $sql .= ',users.first_name';
        $sql .= ' FROM todo_items INNER JOIN users ON todo_items.user_id = users.id';
        $sql .= ' WHERE todo_items.is_deleted = 0';
        $sql .= ' AND (todo_items.item_name LIKE :get OR users.family_name LIKE :get OR users.first_name LIKE :get)';
        $sql .= ' ORDER BY todo_items.expire_date ASC, todo_items.finished_date ASC, todo_items.item_name ASC';

        $stmt = $this->dbh->prepare($sql);
        // あいまい検索用の変数はここで括る
        $stmt->bindValue(':get', '%' . $get . '%', PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * 削除する（削除フラグを立てる）
     */
    public function dbDelete($is_deleted, $id)
    {
        $sql = 'UPDATE todo_items SET is_deleted=:is_deleted WHERE todo_items.id=:id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':is_deleted', $is_deleted, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * 修正ボタンを押した
     */
    public function dbUpdate($post)
    {
        $sql = 'UPDATE todo_items';
        $sql .= ' SET';
        $sql .= ' item_name=:item_name';
        $sql .= ',user_id=:user_id';
        $sql .= ',expire_date=:expire_date';
        $sql .= ',finished_date=:finished_date';
        $sql .= ' WHERE todo_items.id =:id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':item_name', $post['item_name'], PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $post['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':expire_date', $post['expire_date'], PDO::PARAM_STR);
        $stmt->bindValue(':finished_date', $post['finished_date'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $post['item_id'], PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * 完了ボタンを押した
     */
    public function dbIsComp($post)
    {
        $sql = 'UPDATE todo_items';
        $sql .= ' SET';
        $sql .= ' finished_date=:finished_date';
        $sql .= ' WHERE todo_items.id =:id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':finished_date', $post['finished_date'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $post['item_id'], PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * csvファイルからUPDATEする
     */
    public function dbCsvUpdate(int $id, string $expire_date, string $item_name, int $is_completed)
    {
        $sql = 'UPDATE todo_items SET expire_date=:expire_date, item_name=:item_name, is_completed=:is_completed WHERE id=:id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':expire_date', $expire_date, PDO::PARAM_STR);
        $stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
        $stmt->bindValue(':is_completed', $is_completed, PDO::PARAM_INT);

        $stmt->execute();
    }
}
