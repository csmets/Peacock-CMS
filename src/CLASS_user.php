<?php

class User{

  private static $_user;
  private static $_userArray = array();

  public function __construct($user){
    self::$_user = $user;
    $query = "SELECT * FROM users WHERE username='$user'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    self::$_userArray = $get_data;
  }

  public function checkUser(){
    $user = self::$_user;
    $userData = self::$_userArray['username'];
    if ($userData != null){
      if (strtolower($userData) == strtolower($user))
        {
            return true;
        }else{
            header("location:accessviolation.php");
        }
        $db->close();
    }
    else{
       header("location:accessviolation.php");
    }
  }

  public static function fetchId(){
    return self::$_userArray['id'];
  }

  public static function fetchFirstName(){
    return self::$_userArray['firstname'];
  }

  public static function fetchLastName(){
    return self::$_userArray['lastname'];
  }

  public static function fetchEmail(){
    return self::$_userArray['email'];
  }

  public static function fetchEditorType(){
    return self::$_userArray['editortype'];
  }

  public static function fetchAccType(){
    return self::$_userArray['acctype'];
  }

  public static function fetchAvatar(){
    return self::$_userArray['profileimg'];
  }

}
