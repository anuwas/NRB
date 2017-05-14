<?php

namespace app\models;
use app\models\DBUser;
use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

   /*  private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ]; */

    

    /**
     * @inheritdoc
     * 
     */
    private static function dbUsers(){
    	$dbusers=DBUser::find()->all();
    	$return=array();
    	foreach ($dbusers as $values){
    		
    		$return[]=array('id'=>$values->id,'username'=>$values->username,'password'=>$values->password,'authKey'=>$values->authKey,'accessToken'=>$values->accessToken);
    	}
    	return $return;
    }
    public static function findIdentity($id)
    {
    	$dbusers=User::dbUsers();
        return isset($dbusers[$id]) ? new static($dbusers[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	$dbusers=User::dbUsers();
    	
        foreach ($dbusers as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
    	$dbusers=User::dbUsers();
    	
        foreach ($dbusers as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
