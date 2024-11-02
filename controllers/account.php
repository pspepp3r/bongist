<?php

class account {

    public static function login($email, $password) {

        global $db;

        $param = array(
            'email' => request::secureTxt($email),
        );

        $account = $db->query("SELECT * FROM staff WHERE email = :email", $param, false);

        if (!$account) {
            respond::alert('warning', '', 'Invalid email address');
            return false;
        }
            $account_pwd = $account['password'];
            $suspend = $account['suspend'];

            $pwd = crypt($password, $account_pwd);

            if ($account_pwd != $pwd) {
                respond::alert('warning', '', 'Invalid account password');
                return false;
            }

            if ($suspend) {
                respond::alert('warning', 'Account Suspended!', 'Your account has been suspended');
                return false;
            }


            $_SESSION['logged_staff'] = $email;
            if (isset($_SESSION['redirect_page'])) {
                $page = $_SESSION['redirect_page'];
                header('location: '.$page);
            }else {
                header('location:admin/dashboard');
            }

    }// LOGIN METHOD

    public static function send_code($email) {
        global $db;

        $statement = "SELECT * FROM accounts WHERE email = :email";
        $account = $db->query($statement, array('email' => $email), false);

        if (count($account) > 0) {
            $name = $account['name'];
            $v_code = request::randomString();

            $param = array(
                'email' => $email,
                'v_code' => $v_code
            );
            $statement = "UPDATE accounts SET verification_code = :v_code WHERE email = :email";

            if ($db->query($statement, $param)) {

                $from = config::email();
                $sender = config::name();
                $to = $email;
                $subject = "Account Verification";

                $msg = '<p style="color: #3E4095; font-size: 28px;"><span><b style="color: #288feb;">One more step, '.$name.'</b></span></p>
                <p>
                <p style="color: #000000; font-size: 22px;">Click on the button below to verify your account with us</p>
                </p><br>
                <p>
                    <a href="http://localhost/bongist/account'.$v_code.'" style="background-color: #288feb; border-color: #288feb!important; padding: 15px; margin-top: 20px; color: #fff; border-radius: 4px; text-decoration: none; font-size: 18px;"><b>Verify Account</b></a>
                </p>
                <p style="margin-top: 30px;">
                    Or<br><br>
                    Copy and paste the link below on your browser to verify your account<br>
                    <a href="http://localhost/bongist/account'.$v_code.'"><b>https://ctifund.biz/verify/'.$v_code.'</b></a>
                </p>';

                mail::send($from, $sender, $to, $subject, $msg);

                respond::alert('success', '', 'Verification mail successfully sent to '.$email);
            }else {
                respond::alert('warning', '', 'Unable to send verification mail to '.$email);
            }

        }else {
            respond::alert('warning', '', 'Email address does not exist');
        }

    }// RESEND VERIFICATION MAIL

    public static function forgot_password($email) {
        global $db;

        if (self::check_email($email)) {

            respond::alert('warning', '', 'Email Address does not exist');

        }else {

            $reset_code = request::randomString();

            $param = array(
                'email' => request::secureTxt($email),
                'password_reset' => $reset_code
            );
            $statement = "UPDATE staff SET password_reset = :password_reset WHERE email = :email";

            if ($db->query($statement, $param)) {

                $from = config::email();
                $subject = "Password Reset";
                $sender = config::name();
                $url = config::base().'admin/reset-password/'.$reset_code;

                $msg = '<p>
                       Someone requested that the password be reset for your account
                     </p>
                     <p>
                       If this was a mistake, just ignore this email and nothing will happen.
                     </p>
                     <p>
                       To reset your password, visit the following address:
                     </p>
                     <p>
                       <a href="'.$url.'">'.$url.'</a>
                     </p>
                     <p>
                       For any requests, please contact <a href="mailto:'.$from.'">'.$from.'</a>
                     </p>';

                mail::send($from, $sender, $email, $subject, $msg);

                respond::alert('success', 'Password reset link sent!', 'A password reset mail has been successfully sent to '.$email);
            }else {
                respond::alert('warning', '', 'Unable to send a password reset mail');
            }

        }

    }// ACCOUNT FORGOT PASSWORD

    public static function change_password($username, $new_password, $repeat_password) {
        global $db;

        $pwd = request::secureTxt($new_password);
        $repeat_pwd = request::secureTxt($repeat_password);

        if ($pwd != $repeat_pwd) {
            respond::alert('warning', 'Update Error!', "Repeated password doesn't match new password");
        }else{
            $password = request::securePwd($new_password);

            $statement = "UPDATE accounts SET password = :password WHERE username = :username";
            $param = array(
                'password' => $password,
                'username' => $username
            );

            if ($db->query($statement, $param)) {
                respond::alert('success', 'Update Success!', 'Password successfully changed');
            }else{
                respond::alert('danger', 'Update Error!', 'Unable to change password');
            }

        }

    }
    // CHANGE PASSWORD

    static function check_password($password, $confirm_password) {
        if ($password == $confirm_password) {
            return true;
        }else {
            return false;
        }
    }// CONFIRM PASSWORD

    static function check_username($username) {
        global $db;

        $user = $db->query("SELECT * FROM accounts WHERE username = :username", array('username' => $username), false);
        if ($user) {
            return $user;
        }else {
            return false;
        }

    }// CHECK USERNAME

    public static function fetch_username($email) {
        global $db;

        $statement = "SELECT * FROM accounts WHERE email = :email";
        $account = $db->query($statement, array('email' => $email), false);

        if (count($account) > 0) {
            return $account['username'];
        }else {
            return false;
        }

    }// GET USERNAME OF ACCOUNT

    static function check_email($email) {
        global $db;

        $statement = "SELECT email FROM staff WHERE email = :email";
        $param = array(
            'email' => $email
        );

        $user = $db->query($statement, $param);

        if (count($user) > 0) {
            return false;
        }else {
            return true;
        }

    }// CHECK USERNAME

    public static function update($username, $name, $phone, $photo = array()) {
        global $db;

        if ($photo['size'] > 0) {

            $file = $db->single("SELECT photo FROM accounts WHERE username = :username", array('username' => $username));

            if ($file != 'avatar.png') {
                upload::remove($file, config::baseUploadProfileUrl());
            }

            $upload = upload::add($photo, config::baseUploadProfileUrl(), true);
            $photo = $upload['file'];

            $db->query("UPDATE accounts SET photo = :photo WHERE username = :username", array('photo' => $photo, 'username' => $username));

            $photo = config::baseUploadProfileUrl().$photo;

            ?>
            <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
            <script>
                $(document).ready( function() {
                    $('.u-sidebar--account__toggle-img').attr('src', '<?php echo $photo; ?>');
                });
            </script>
            <?php

        }

        if ($db->query("UPDATE accounts SET fname = :name, phone = :phone WHERE username = :username", array(
            'name' => $name,
            'phone' => $phone,
            'username' => $username
        ))) {
            respond::alert('success', 'Update Success!', 'Profile successfully updated');
        }else {
            respond::alert('danger', 'Update Error!', 'Unable to update profile');
        }

    }

    public static function photo() {
        global $db;
        $username = $_SESSION['customer'];
        $photo = $db->single("SELECT photo FROM accounts WHERE username = :username", array('username' => $username));
        return config::baseUploadProfileUrl().$photo;
    }

    public static function getDetails($username) {
        global $db;
        $user = $db->query("SELECT * FROM accounts WHERE username = :username", array('username' => $username), false);
        return $user;
    }


}
