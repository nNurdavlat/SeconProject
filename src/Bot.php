<?php
 require "src/DB.php";
class Bot
{
    const API_URL = 'https://api.telegram.org/bot';
    private $token = '7332373576:AAH7nrAUXrFY7uf-Z0cQ5YiqZ-3fuCM_z2s';

    public function makeRequest($method, $data = []){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::API_URL . $this->token . '/' . $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        var_dump($response);
    }

    public function saveUser($user_id, $username): bool
    {
        if ($this->getUser_id($user_id)) {
            return false;
        }
        $query = "INSERT INTO tg_users (user_id, username) VALUES (:user_id, :username)";
        $db = new DB(); // DB ga ulanib oladi. Axir unga yiozish kerakku.
        return $db->conn->prepare($query)->execute([
            ':user_id' => $user_id,
            ':username' => $username
        ]);
    }

    public function getUser_id($user_id):bool|array {
        $query = "SELECT * FROM tg_users WHERE user_id = :user_id";
        $db = new DB();
        $stmt = $db->conn->prepare($query);
        $stmt->execute([
            ':user_id' => $user_id
        ]);
        return $stmt->fetch();
    }
}






