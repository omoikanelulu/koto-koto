<?php
class DB_Users extends DB_Base
{
    /**
     * DBへ接続するコンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 一覧を取得しreturnする
     * @param int 0=未削除 1=削除済み
     */
    public function allSelect($int): array
    {
        $sql = 'SELECT';
        $sql .= ' id';
        $sql .= ',user_name';
        $sql .= ',family_name';
        $sql .= ',first_name';
        $sql .= ',birth_date';
        $sql .= ',user_mail_address';
        $sql .= ',pass';
        $sql .= ',is_deleted';
        $sql .= ',create_date_time';
        $sql .= ',update_date_time';
        $sql .= ' FROM users';
        $sql .= ' WHERE is_deleted = :int';
        $sql .= ' ORDER BY id ASC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':int', $int, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 特定の1レコードを取得する
     */
    public function pick_one($id): array
    {
        $sql = 'SELECT';
        $sql .= ' id';
        $sql .= ',user';
        $sql .= ',family_name';
        $sql .= ',first_name';
        $sql .= ',is_admin';
        $sql .= ',is_deleted';
        $sql .= ' FROM users';
        $sql .= ' WHERE is_deleted = 0 AND id = :id';
        $sql .= ' ORDER BY id ASC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * DBのuserに重複があるか確認
     * @param string $user
     * @return bool
     * true 重複あり false 重複なし
     */
    public function dbDupUser(string $user): bool
    {
        $sql = 'SELECT * FROM users WHERE user=:user';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt->execute();
        // DBに存在したレコードが入る
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($rec)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * DBのusersテーブルからuserを探す
     * @return $rec 該当したレコードが入る
     */
    public function dbFindUser($user)
    {
        $sql = 'SELECT * FROM users WHERE user=:user';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user', $user['user'], PDO::PARAM_STR);
        $stmt->execute();
        // 該当したレコードが入る
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        // 見つからなかった時のメッセージ
        if (empty($rec)) {
            $_SESSION['err']['msg'] = 'ご登録されていないようです';

            // $_SESSION['loginFailure']++;
            header('Location:../login/index.php');
            exit();
        } else {
            // 本人確認
            $result = password_verify($user['pass'], $rec['pass']);
            if ($result) {
                $_SESSION['user'] = $rec;
                unset($_SESSION['err']['msg']);
                header('Location:../todo/index.php');
                exit();
            } else {
                $_SESSION['err']['msg'] = 'IDかパスワードが間違っています';

                // $_SESSION['loginFailure']++;

                header('Location:../login/index.php');
                exit();
            }
        }
    }

    /**
     * データベースに、ユーザ情報を登録する
     * @param array $data
     * @return :bool
     */
    public function userAdd($data): bool
    {
        // passをハッシュ化する
        $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

        $sql = 'INSERT INTO';
        $sql .= ' users (user_name, family_name, first_name, birth_date, user_mail_address, pass)';
        $sql .= ' VALUES(:user_name, :family_name, :first_name, :birth_date, :user_mail_address, :pass)';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_name', $data['user_name'], PDO::PARAM_STR);
        $stmt->bindValue(':family_name', $data['family_name'], PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $data['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':birth_date', $data['birth_date_year'] . '-' . $data['birth_date_month'] . '-' . $data['birth_date_day'], PDO::PARAM_STR);
        $stmt->bindValue(':user_mail_address', $data['user_mail_address'], PDO::PARAM_STR);
        $stmt->bindValue(':pass', $data['pass'], PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    /**
     * ユーザ情報の更新
     *
     * @return true
     */
    public function userUpdate($post)
    {
        $sql = 'UPDATE users SET';
        $sql .= ' user=:user,';
        // $sql .= ' pass=:pass';
        $sql .= ' family_name=:family_name';
        $sql .= ' ,first_name=:first_name';
        $sql .= ' ,is_admin=:is_admin';
        $sql .= ' ,is_deleted=:is_deleted';
        $sql .= ' WHERE id=:id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user', $post['user'], PDO::PARAM_STR);
        // $stmt->bindValue(':pass', $post['pass'], PDO::PARAM_STR);
        $stmt->bindValue(':family_name', $post['family_name'], PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $post['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':is_admin', $post['is_admin'], PDO::PARAM_INT);
        $stmt->bindValue(':is_deleted', $post['is_deleted'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $post['id'], PDO::PARAM_INT);

        $stmt->execute();

        return true;
    }

    /**
     * 論理削除する（削除フラグを立てる）
     *
     * @param INT $is_deleted 1を入れるとフラグが立つ
     * @param INT $id 削除対象のid
     */
    public function deleted_flag_on($is_deleted, $id)
    {
        $sql = 'UPDATE users SET is_deleted=:is_deleted WHERE users.id=:id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':is_deleted', $is_deleted, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * 会員情報削除
     * 物理削除
     */
    public function dbDelete()
    {
        $sql = 'DELETE FROM users WHERE(:name, :pass)';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':pass', $_POST['pass'], PDO::PARAM_STR);
        // $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);

        $stmt->execute();
    }
}
