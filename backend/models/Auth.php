<?php
require_once './config/database.php';
require_once './vendor/autoload.php';
use \Firebase\JWT\JWT;

class Auth {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        $query = "SELECT id, name, email, password FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $token = $this->createToken($user);
            return $token;
        }
        return null;
    }

    private function createToken($user) {
        $secret_key = "jasdklfjaslkdfjasl;dkjf;alskdjflaksdjfl;asdjflasdjflaskdfjlasdjfakl;sdfjla;sdjfasldfjasldfjlskf";
        $issuer_claim = "THE_ISSUER"; // this can be the servername
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 10; //not before in seconds
        $expire_claim = $issuedat_claim + 3600; // expire time in seconds
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $user['id'],
                "name" => $user['name'],
                "email" => $user['email']
            ));

        $jwt = JWT::encode($token, $secret_key,"HS256");
        return $jwt;
    }
}
