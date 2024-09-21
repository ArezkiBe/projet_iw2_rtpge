<?php

namespace App\Includes;

use App\Models\User;



class Functions {

    

    public function is_framework_installed () {

        $optionsJson = file_get_contents('./options.json');
        $optionsArray = json_decode($optionsJson, true);

        if ($optionsArray === null) {
            die ("Error decoding JSON in 'options' file.");
        } else {
            $isInstalled = $optionsArray['is_installed'];
            //var_dump($isInstalled);
            if (!$isInstalled) {
                header('Location: /install');
            }
        }
    }

    public function add_first_user ($username, $pwd, $email) {

        try{
            $optionsJson = file_get_contents('./options.json');
            $optionsArray = json_decode($optionsJson, true);
            $user = new User();
            $user->setLogin($username);
            $user->setPwd($pwd);
            $user->setEmail($email);
            $user->setRole(1);
            $user->save();

            $optionsArray["is_installed"] = true;
            $updatedJsonData = json_encode($optionsArray, JSON_PRETTY_PRINT);
            file_put_contents('./options.json', $updatedJsonData);
            
        }catch (\PDOException $exception){
            print_r($exception);
            return false;
        }

        return true;
    }

    public function deleteUser($email) {
        try {
            $sql = "DELETE FROM ".PREFIX."_user WHERE email = :email";
            $data = array("email" => $email);
            $user = new User();
            $user->select($sql, $data);
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public function createConstFile($host, $user, $username, $pwd) {
        try {
            var_dump("ici");
            if (file_exists("./Constantes.php")) {
                return false;
            }
            $content = '<?php
                define("DB_HOST", "'.$host.'");
                define("DB_NAME", "'.$user.'");
                define("DB_USERNAME", "'.$username.'");
                define("DB_PWD", "'.$pwd.'");';
            $path = './Constantes.php';
            file_put_contents($path, $content);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    function generateRandomString($length = 4) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $firstCharacter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $firstCharacterLength = strlen($firstCharacter);
        $randomString = $firstCharacter[rand(0, $firstCharacterLength - 1)];
        
        for ($i = 1; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomString;
    }
}
    

