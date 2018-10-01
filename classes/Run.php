<?php namespace MariuszAnuszkiewicz\classes\Run;

use MariuszAnuszkiewicz\classes\SendData\SendData;
use MariuszAnuszkiewicz\classes\GetData\GetData;
use MariuszAnuszkiewicz\classes\UserRegister\UserRegister;
use MariuszAnuszkiewicz\classes\UserLogin\UserLogin;
use MariuszAnuszkiewicz\classes\ValidateRegisterInput\ValidateRegisterInput;
use MariuszAnuszkiewicz\classes\ValidateLoginInput\ValidateLoginInput;

class Run
{
    const FILE = "./web/uploads/data.json";

    public static function initGetSaveFile()
    {
        $status = null;
        $numArgs = func_num_args();
        $argList = func_get_args();
        $sendDataObj = new SendData();
        $data = null;
        $content = null;
           for ($i = 1; $i < $numArgs; ++$i) {
               $content[] = $argList[$i];
           }
        $data['members'] = array(
            array(join(", ", $content))
        );
        $formattedData = json_encode($data);
        $status = false;
        try {
            if ($argList[0] == "Wyślij") {
                if ($sendDataObj->sendProcess($formattedData) == true) {
                    $status = true;
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . "The exception code is: " . $e->getCode();
        }
        $getDataObj = new GetData();
        $getDataObj->getReadingProcess();
        return $status;
    }

    public static function initRegisterUser()
    {
        $validateObj = new ValidateRegisterInput();
        $inputs = [
            'username' => isset($_POST['username']) ? $_POST['username'] : null,
            'email' => isset($_POST['email']) ? $_POST['email'] : null,
            'password' => isset($_POST['password']) ? $_POST['password'] : null,
            'confirm' => isset($_POST['confirm']) ? $_POST['confirm'] : null,
            'submit' => isset($_POST['submit_register']) ? $_POST['submit_register'] : null
        ];

        $submit = $inputs['submit'];
        $username = $validateObj->validateLength($inputs['username'], $submit);
        $email = $validateObj->validateEmail($inputs['email'], $submit);
        $password = $validateObj->validateLength($inputs['password'], $submit);


        if (isset($submit)) {
            $userRegisterObj = new UserRegister();
            if ($userRegisterObj->register($username, $email, $password) == true) {
                $userRegisterObj->register($username, $email, $password);
            } else {
                exit;
            }
        }
    }

    public static function initLoginUser()
    {
        $validateObj = new ValidateLoginInput();
        $inputs = [
            'email' => isset($_POST['email']) ? $_POST['email'] : null,
            'password' => isset($_POST['password']) ? $_POST['password'] : null,
            'submit' => isset($_POST['submit_login']) ? $_POST['submit_login'] : null
        ];

        $submit = $inputs['submit'];
        $email = $validateObj->validateEmail($inputs['email'], $submit);
        $password = $validateObj->validateLength($inputs['password'], $submit);

        if (isset($submit)) {
            $userLoginObj = new UserLogin();
            if ($userLoginObj->login($email, $password) == true) {
                $userLoginObj->login($email, $password);
            } else {
                exit;
            }
        }
    }

    public static function logout()
    {
        $getUserLoginObj = new UserLogin();
        $getUserLoginObj->logout();
    }
}