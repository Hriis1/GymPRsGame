<?php
require_once __DIR__ . "/../utils/dbUtils.php";
class UserService
{
    //public
    /**
     * @return 1 - success, -1  = invalid username length, -2  = invalid email, -3  = password too short, -4  = passwords do not match, -5  = email already taken 
     * */
    static public function register(string $username, string $email, string $pass, string $passConf, mysqli $mysqli): int
    {
        //vars
        $usernameLen = strlen($username);
        $passLen = strlen($pass);
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        $emailEscaped = $mysqli->real_escape_string($email);

        //validate 
        //input validation
        if ($usernameLen < 3 || $usernameLen > 20) //invalid username len
            return -1;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) //invalid email
            return -2;

        if ($passLen < 8) //invalid pass
            return -3;

        if ($pass != $passConf) //pass dont match
            return -4;

        //db validation
        if (getCountFromDB("users", "WHERE email = '$emailEscaped'", $mysqli) != 0) //email is taken
            return -5;

        //insert in db
        $stmt = $mysqli->prepare("INSERT INTO users (username, email, pass) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPass);
        $stmt->execute();
        $stmt->close();

        return 1;
    }

    //private
    private function __construct()
    {
    }
}