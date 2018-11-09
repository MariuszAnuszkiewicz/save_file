<?php namespace MariuszAnuszkiewicz\classes;

class Run
{
  
    public static function initGetSaveFile()
    {
        $status = null;
        $data = null;
        $content = null;
        $numArgs = func_num_args();
        $argList = func_get_args();
        $sendDataObj = new SendData();

        for ($i = 1; $i < $numArgs - 1; ++$i) {
           $content[] = $argList[$i];
        }
        $data['members'] = array(
           array(join(", ", $content))
        );
        $formattedData = json_encode($data);
        $status = false;

        try {
            if ($argList[0] == "Wyślij") {
                $file = preg_match('/data.json/', $argList[$numArgs - 1]) ? $argList[$numArgs - 1] : null;
                if ($sendDataObj->sendProcess($file, $formattedData) == true) {
                    $status = true;
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . "The exception code is: " . $e->getCode();
        }
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
                $userRegisterObj->register($validateObj->validateUsername($username), $email, $validateObj->validatePassword($password));
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
                $userLoginObj->login($email, $validateObj->validatePassword($password));
            }
        }
    }

    public static function logout()
    {
        $getUserLoginObj = new UserLogin();
        $getUserLoginObj->logout();
    }
}