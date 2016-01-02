<?php

namespace app\models;

//app\models\gii\Users is the model generated using Gii from users table

use app\models\Usuario as DbUser;

class User extends \yii\base\Object implements \yii\web\IdentityInterface {

public $id;
public $username;
public $password;
public $inventario;
public $contabilidad;
public $authKey;
public $accessToken;
public $email;
public $phone_number;
public $user_type;

/**
 * @inheritdoc
 */

public static function tableName()
    {
        return 'usuario';
    }
    
public static function findIdentity($id) {
    $dbUser = DbUser::find()
            ->where([
                "id" => $id
            ])
            ->one();
    if (!count($dbUser)) {
        return null;
    }
    return new static($dbUser);
}

/**
 * @inheritdoc
 */
public static function findIdentityByAccessToken($token, $userType = null) {

    $dbUser = DbUser::find()
            ->where(["accessToken" => $token])
            ->one();
    if (!count($dbUser)) {
        return null;
    }
    return new static($dbUser);
}

/**
 * Finds user by username
 *
 * @param  string      $username
 * @return static|null
 */
public static function findByUsername($username) {
    $dbUser = DbUser::find()
            ->where([
                "username" => $username
            ])
            ->one();
    if (!count($dbUser)) {
        return null;
    }
    return new static($dbUser);
}

/**
 * @inheritdoc
 */
public function getId() {
    return $this->id;
}
public function getInventario() {
    return $this->inventario;
}
public function getContabilidad() {
    return $this->inventario;
}
public function getUsername() {
    return $this->username;
}



/**
 * @inheritdoc
 */
public function getAuthKey() {
    return $this->authKey;
}

/**
 * @inheritdoc
 */
public function validateAuthKey($authKey) {
    return $this->authKey === $authKey;
}

/**
 * Validates password
 *
 * @param  string  $password password to validate
 * @return boolean if password provided is valid for current user
 */
public function validatePassword($password) {
    return $this->password === $password;
}

}

