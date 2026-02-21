<?php
require_once __DIR__ . "/../config/sessionConfig.php";
require_once __DIR__ . "/../config/dbConfig.php";
require_once __DIR__ . "/../utils/dbUtils.php";
class UserService
{
    //public
    /**
     * @return 1 - success, -1  = invalid username length, -2  = invalid email, -3  = password too short, -4  = passwords do not match, -5  = email already taken 
     * */
    static public function registerUser(string $username, string $email, string $pass, string $passConf, mysqli $mysqli): int
    {
        //vars
        $usernameLen = strlen($username);
        $passLen = strlen($pass);
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        //escape
        $email = $mysqli->real_escape_string($email);
        $username = $mysqli->real_escape_string($username);

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
        if (getCountFromDB("users", "WHERE username = '$username'", $mysqli) != 0) //username is taken
            return -5;

        if (getCountFromDB("users", "WHERE email = '$email'", $mysqli) != 0) //email is taken
            return -6;

        //insert in db
        $stmt = $mysqli->prepare("INSERT INTO users (username, email, pass) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPass);
        $stmt->execute();
        $newUserId = $stmt->insert_id;
        $stmt->close();

        //Log in the new user
        self::logInUser($newUserId, false, $mysqli);

        return 1;
    }

    static public function logOutUser(mysqli $mysqli)
    {
        //user id
        $userId = $_SESSION["user_id"] ?? null;

        if ($userId) { //if there was a logged in user
            //Unset cookie
            setcookie("gym_pbs_remember_token", "", time() - 3600, "/");

            //remove the remember token from db
            $stmt = $mysqli->prepare("UPDATE users SET remember_token = '' WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->close();

            //log out user
            unset($_SESSION["user_id"]);
        }
    }

    static public function getLoggedInUser(mysqli $mysqli)
    {
        //Check if user is logged in with session or remember token
        $userId = (int) ($_SESSION["user_id"] ?? 0);
        $user = null;
        if ($userId) { //if the session var was set
            $user = getFromDBByID("users", $userId, $mysqli);
            return $user;
        }

        if (isset($_COOKIE["gym_pbs_remember_token"]) && $_COOKIE["gym_pbs_remember_token"] !== "") { //if the cookie was set

            //get the hashed token
            $userRememberToken = $_COOKIE["gym_pbs_remember_token"];
            $hash = hash('sha256', $userRememberToken);

            //check if user with this token exists
            $stmt = $mysqli->prepare("SELECT id FROM users WHERE remember_token = ? AND remember_token != ''");
            $stmt->bind_param("s", $hash);
            $stmt->execute();
            $stmt->bind_result($userId);

            //if a user was found log in and return it
            if ($stmt->fetch()) {
                $stmt->close();
                self::logInUser($userId, false, $mysqli);
                $user = getFromDBByID("users", $userId, $mysqli);
                return $user;
            }
            $stmt->close();
        }

        //user wasnt found
        return null;
    }

    //private
    private function __construct()
    {
    }

    static private function logInUser(int $userId, bool $remember, mysqli $mysqli): void
    {
        if ($remember)
            self::rememberUser($userId, $mysqli);

        $_SESSION["user_id"] = $userId;
    }

    /** 
     * remember user for 1 year 
     */
    static function rememberUser(int $userId, mysqli $mysqli): void
    {
        //Generate and hash token
        $token = bin2hex(random_bytes(32));
        $hash = hash('sha256', $token);

        //save the hashed token in db
        $stmt = $mysqli->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
        $stmt->bind_param("si", $hash, $userId);
        $stmt->execute();
        $stmt->close();

        //if https only allow cookie for https otherwise dont
        $secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

        //set cookie with the token
        setcookie("gym_pbs_remember_token", $token, time() + (86400 * 365), "/", "", $secure, true);
    }
}