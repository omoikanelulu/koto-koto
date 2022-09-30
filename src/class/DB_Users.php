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
     * ログイン処理
     * 入力されたメールアドレスを元にDBのusersテーブルからuserのレコードを探す
     */
    public function userLogin($post)
    {
        $rec = '';

        $sql = 'SELECT *';
        $sql .= ' FROM users';
        $sql .= ' WHERE';
        $sql .= ' user_mail_address = :user_mail_address';
        $sql .= ' AND is_deleted = 0';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user_mail_address', $post['user_mail_address'], PDO::PARAM_STR);
        $stmt->execute();

        // 該当したレコードが入る
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        // 結果を取得
        return $rec;
    }

    /**
     * データベースに、ユーザを新規登録する
     * @param array $data
     * @return :bool
     */
    public function userAdd($data): bool
    {
        // passをハッシュ化する
        $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

        $sql = 'INSERT INTO';
        $sql .= ' users (user_name, family_name, first_name, birth_date, user_mail_address, pass)';
        $sql .= ' VALUES (:user_name, :family_name, :first_name, :birth_date, :user_mail_address, :pass)';

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
     * ユーザ情報の編集、更新
     */
    public function userUpdate($edit_user_data, $login_user)
    {
        isset($edit_user_data['pass']) ? $edit_user_data['pass'] = password_hash($edit_user_data['pass'], PASSWORD_DEFAULT) : '';

        // クエリを$queに代入する
        $que = isset($edit_user_data['user_name']) ? ',user_name = :user_name' : '';
        $que .= isset($edit_user_data['pass']) ? ',pass = :pass' : '';
        $que .= isset($edit_user_data['user_mail_address']) ? ',user_mail_address = :user_mail_address' : '';

        // クエリの最左に来る','を除去する
        $que = ltrim($que, ',');

        $sql = 'UPDATE users SET ';
        $sql .= $que;
        $sql .= ' WHERE id = :id';

        $stmt = $this->dbh->prepare($sql);
        // バインドが必要なプレースメントだけににバインドするように、if文でbindValueをするかしないか判定する
        if (isset($edit_user_data['user_name']) == true) {
            $stmt->bindValue(':user_name', $edit_user_data['user_name'], PDO::PARAM_STR);
        }
        if (isset($edit_user_data['pass']) == true) {
            $stmt->bindValue(':pass', $edit_user_data['pass'], PDO::PARAM_STR);
        }
        if (isset($edit_user_data['user_mail_address']) == true) {
            $stmt->bindValue(':user_mail_address', $edit_user_data['user_mail_address'], PDO::PARAM_STR);
        }
        $stmt->bindValue(':id', $login_user['id'], PDO::PARAM_INT);

        $stmt->execute();

        return true;
    }

    /**
     * 論理削除する（削除フラグを立てる）
     * @param INT $is_deleted 「1」を入れるとフラグが立つ
     * @param INT $login_user 削除対象のid
     */
    public function deletedFlagOn($login_user)
    {
        $sql = 'UPDATE users';
        $sql .= ' SET is_deleted = 1';
        $sql .= ' WHERE users.id = :id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $login_user['id'], PDO::PARAM_INT);

        $stmt->execute();

        return true;
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
        $sql .= ' WHERE';
        $sql .= ' is_deleted = :int';
        $sql .= ' ORDER BY id ASC';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':int', $int, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
