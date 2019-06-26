<?php
/**
 * Created by IntelliJ IDEA.
 * User: psalm29
 * Date: 19/09/2017
 * Time: 2:16 PM
 */

class customer {

	public static function register($fname, $lname, $email, $password) {
		global $db;

		if ($fname == '' || $lname == '' || $email == '' || $password == '') {
			respond::alert('danger', '', 'All fields are required!');
			return false;
		}

        $user = $db->single("SELECT email FROM accounts WHERE email = :email", array('email' => $email));
		if ($user) {
            respond::alert('warning', '', 'Email address already exist');
		    return false;
        }


        $v_code = request::hashString(rand(56775, 99999));

        $statement = "INSERT INTO accounts (fname, lname, email, password, timestamp) VALUES (:fname, :lname, :email, :password, :timestamp)";
        $param = array(
            'fname' => request::secureTxt($fname),
            'lname' => request::secureTxt($lname),
            'email' => request::secureTxt($email),
            'password' => request::securePwd($password),
            'timestamp' => time(),
        );

        if ($db->query($statement, $param)) {


            $from = config::email();
            $sender = config::name();
            $to = $email;
            $subject = "Welcome to ".config::name();
            $url = config::base().'verify/'.$v_code;

            $msg = '<p style="color: #3E4095; font-size: 28px;"><span><b style="color: #288feb;">One more step, '.$name.'</b></span></p>
                <p>
                <p style="color: #000000; font-size: 22px;">Click on the button below to verify your account with us</p>
                </p><br>
                <p>
                    <a href="'.$url.'" style="background-color: #288feb; border-color: #288feb!important; padding: 15px; margin-top: 20px; color: #fff; border-radius: 4px; text-decoration: none; font-size: 18px;"><b>Verify Account</b></a>
                </p>
                <p style="margin-top: 30px;">
                    Or<br><br>
                    Copy and paste the link below on your browser to verify your account<br>
                    <a href="'.$url.'"><b>'.$url.'</b></a>
                </p>';

            mail::send($from, $sender, $to, $subject, $msg);

            respond::alert('success', '', 'Account successfully created!');
        }else {
            respond::alert('danger', '', 'Unable to create account!');
        }



	}

	public static function login($email, $password) {

		global $db;

		$param = array(
			'email' => request::secureTxt($email)
		);

		$account = $db->query("SELECT * FROM accounts WHERE email = :email", $param, false);

		if (!$account) {
            respond::alert('warning', '', 'Invalid email address');
            return false;
		}

        $account_pwd = $account['password'];
        $email = $account['email'];
        $suspend = $account['suspend'];

        $pwd = crypt($password, $account_pwd);

        if ($account_pwd != $pwd) {
            respond::alert('warning', '', 'Invalid account password');
            return false;
        }

        if ($suspend == 1) {
            respond::alert('warning', 'Account Suspended!', 'Your account has been suspended');
            return false;
        }

        $_SESSION['logged_user'] = $email;
        header('location: ../account/orders');


	}// LOGIN METHOD


	public static function forgot_password($email) {
		global $db;

		if (!self::check($email)) {

			respond::alert('warning', '', 'Email Address does not exist');

		}else {

			$reset_code = request::randomString();

			$param = array(
				'email' => request::secureTxt($email),
				'password_reset' => $reset_code
			);
			$statement = "UPDATE accounts SET password_reset = :password_reset WHERE email = :email";

			if ($db->query($statement, $param)) {

				$username = self::fetch_username($email);

				$from = config::email();
				$subject = "Password Reset";
				$sender = config::name();
                $url = config::base().'reset-password/'.$reset_code;

				$msg = '<p>
                       Someone requested that the password be reset for the following account:
                     </p>
                     <p>
                       Username: '.$username.'
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

	public static function change_password($email, $old_password, $new_password, $repeat_password) {
		global $db;

        $account = self::check($email);

        $account_pwd = $account['password'];

        $pwd = crypt($old_password, $account_pwd);

        if ($account_pwd != $pwd) {
            respond::alert('warning', '', 'Incorrect old password');
            return false;
        }

		$pwd = request::secureTxt($new_password);
		$repeat_pwd = request::secureTxt($repeat_password);

		if ($pwd != $repeat_pwd) {
			respond::alert('warning', '', "Repeated password doesn't match new password");
		}else{
			$password = request::securePwd($new_password);

			$statement = "UPDATE accounts SET password = :password WHERE email = :email";
			$param = array(
				'password' => $password,
				'email' => $email
			);

			if ($db->query($statement, $param)) {
				respond::alert('success', '', 'Password successfully changed');
			}else{
				respond::alert('danger', '', 'Unable to change password');
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

	static function check($value, $column, $id = null) {
		global $db;

    $param = array(
      'value' => $value
    );
		if ($id == null) {
      $statement = "SELECT * FROM customers WHERE $column = :value";
    }else {
      $statement = "SELECT * FROM customers WHERE $column = :value AND id != :id";
      $param['id'] = $id;
    }

		$user = $db->query($statement, $param, false);

		if ($user) {
			return $user;
		}else {
			return false;
		}

	}// CHECK USERNAME

	public static function update($email, $fname, $lname, $phone, $photo = array()) {
		global $db;

        if ($photo['size'] > 0) {

            $file = $db->single("SELECT photo FROM accounts WHERE email = :email", array('email' => $email));

            if ($file != 'avatar.png') {
                upload::remove($file, config::baseUploadProfileUrl());
            }

            $upload = upload::add($photo, config::baseUploadProfileUrl(), true);
            $photo = $upload['file'];

            $db->query("UPDATE accounts SET photo = :photo WHERE email = :email", array('photo' => $photo, 'email' => $email));

        }

		if ($db->query("UPDATE accounts SET fname = :fname, lname = :lname, phone = :phone WHERE email = :email", array(
			'fname' => $fname,
			'lname' => $lname,
			'phone' => $phone,
			'email' => $email
		))) {
			respond::alert('success', '', 'Account profile successfully updated');
		}else {
			respond::alert('danger', '', 'Unable to update profile');
		}

	}

	public static function photo() {
	    global $db;
	    $username = $_SESSION['customer'];
	    $photo = $db->single("SELECT photo FROM accounts WHERE username = :username", array('username' => $username));
        return config::baseUploadUrl().$photo;
    }

    public static function orders($customer_id) {
	    global $db;

        $orders = $db->query("SELECT * FROM orders LEFT JOIN order_status ON status = order_status.id WHERE customer_id = :id ORDER BY orders.id DESC", array('id' => $customer_id));

        return $orders;

    }

    public static function order($order_id) {
	    global $db;

	    $order = $db->query("SELECT * FROM orders LEFT JOIN order_status ON status = order_status.id WHERE orders.order_id = :order_id", array('order_id' => $order_id), false);

	    if ($order) {
	        return $order;
        }else {
	        return false;
        }

    }

    public static function address($email, $country, $state, $city, $address) {
	    global $db;

	    $update = $db->query("UPDATE customers SET country = :country, state = :state, city = :city, address = :address WHERE email = :email", array(
	            'country' => $country,
	            'state' => $state,
	            'city' => $city,
	            'address' => $address,
	            'email' => $email
        ));

	    if ($update) {
            respond::alert('success', '', 'Address successfully updated');
        }else {
            respond::alert('danger', '', 'Unable to update address');
        }

    }

    public static function all() {
	    global $db;

	    $users = $db->query("SELECT * FROM customers ORDER BY id DESC");

	    if (count($users)) {
	        return $users;
        }else {
	        return false;
        }

    }// FETCH ALL USERS

  public static function add($name, $email, $phone, $address) {
	  global $db;

	  $check_email = self::check($email, 'email');

	  if ($check_email) {
	    respond::alert('warning', '', 'Customer with the same email address already exist');
	    return false;
    }

    $check_phone = self::check($phone, 'phone');

    if ($check_phone) {
      respond::alert('warning', '', 'Customer with the same phone number already exist');
      return false;
    }

    $insert = $db->query("INSERT INTO customers (name, email, phone, address, timestamp) VALUES (:name, :email, :phone, :address, :now)", array(
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'address' => $address,
      'now' => time()
    ));

    if ($insert) {
      respond::alert('success', '', 'Customer successfully added');
    }else {
      respond::alert('danger', '', 'Unable top add customer');
    }

  }// Add new customer

  public static function edit($id, $name, $email, $phone, $address) {
    global $db;

    $check_email = self::check($email, 'email', $id);

    if ($check_email) {
      respond::alert('warning', '', 'Customer with the same email address already exist');
      return false;
    }

    $check_phone = self::check($phone, 'phone', $id);

    if ($check_phone) {
      respond::alert('warning', '', 'Customer with the same phone number already exist');
      return false;
    }

    $insert = $db->query("UPDATE customers SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id", array(
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'address' => $address,
      'id' => $id
    ));

    if ($insert) {
      respond::alert('success', '', 'Customer successfully added');
    }else {
      respond::alert('danger', '', 'Unable top add customer');
    }

  }// Add new customer

}
