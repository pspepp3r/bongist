<?php

class staff {

    public static function add($name, $email, $phone, $address, $role, $password, $photo = array())
    {
        global $db;

        $check = self::check_staff($name, 'name');

        if($check)
        {
            respond::alert('danger', '', 'Staff already exist!');
        }else {

            $upload = upload::add($photo, config::baseUploadStaffUrl(), true);
            $photo = $upload['file'];

            $staff = $db->query("INSERT INTO staff (name, email, phone, address, role, password, photo, timestamp) VALUES (:name, :email, :phone, :address, :role, :password, :photo, :timestamp)", array(
                'name'      => $name,
                'email'     => $email,
                'phone'     => $phone,
                'address'   => $address,
                'role'      => $role,
                'password'  => request::securePwd($password),
                'photo'     => $photo,
                'timestamp' => time()
            ));

            if($staff)
            {
                $staff_id = $db->lastInsertId();

                $activity = $db->query("INSERT INTO activities (staff_id, comment, timestamp) VALUES (:staff_id, :comment, :timestamp)", array(
                    'staff_id'  => $staff_id,
                    'comment'   => config::staffActivity(),
                    'timestamp' => time()
                ));

                if($activity)
                {
                    respond::alert('success', '', 'A new staff has been added successfully!');
                }
            }
        }
    }

    public static function all()
    {
        global $db;

        $staffs = $db->query("SELECT staff.*, role_type FROM staff LEFT JOIN staff_role ON role = staff_role.id WHERE role != 1");
        if($staffs > 0)
        {
            return $staffs;
        }else {
            respond::alert('error', '', 'There are no current staffs');
        }
    }

    public static function edit($id, $name, $email, $phone, $address, $photo = array())
    {
        global $db;

        if($photo['size'] > 0)
        {
            $file = $db->query("SELECT photo FROM staff WHERE name = :name", array(
                'name' => $name
            ));

            if($file != 'avatar.png')
            {
                upload::remove($file, config::baseUploadStaffUrl(), true);
            }

            $upload = upload::add($photo, config::baseUploadStaffUrl(), true);
            $photo = $upload['file'];
        }

        $editStaff = $db->query("UPDATE staff SET name = :name, email = :email, phone = :phone, address = :address, photo = :photo WHERE id = :id", array(
            'id'        => $id,
            'name'      => $name,
            'email'     => $email,
            'phone'     => $phone,
            'address'   => $address,
            'photo'     => $photo
        ));

        if($editStaff)
        {
            $staff_id = $db->lastInsertId();

            $activity = $db->query("INSERT INTO activities (staff_id, comment, timestamp) VALUES (:staff_id, :comment, :timestamp)", array(
                'staff_id'  => $staff_id,
                'comment'   => config::staffUpdateActivity(),
                'timestamp' => time()
            ));

            if($activity)
            {
                respond::alert('success', '', 'staff has been updated successfully');
            }else {
                respond::alert('error', '', 'Staff has not been updated');
            }
        }
    }

    public static function check_staff($value, $column, $id = null)
    {
        global $db;

        if($id == null)
        {
            $check = $db->query("SELECT * FROM staff WHERE $column = :value", array('value' => $value));
        }else {
            $check = $db->query("SELECT * FROM staff WHERE $column = :value AND id != :id", array('value' => $value));
        }
        if($check)
        {
            return $check;
        }
    }

    public static function remove($id, $staff_id)
    {
        global $db;

        $remove = $db->query("DELETE FROM staff WHERE id = :id", array('id' => $id));

        if($remove)
        {
            $activity = $db->query("INSERT INTO activities (staff_id, comment, timestamp) VALUES (:staff_id, :comment, :timestamp)", array(
                'staff_id'  => $staff_id,
                'comment'   => 'has just deleted a staff',
                'timestamp' => time()
            ));

            if($activity)
            {
                respond::alert('success', '', 'staff has been deleted successfully');
            }else {
                respond::alert('error', '', 'Staff has not been deleted');
            }
        }
    }

    public static function role()
    {
        global $db;

        $roles = $db->query("SELECT * FROM staff_role");

        if($roles)
        {
            return $roles;
        }
    }

    public static function details($name)
    {
        global $db;

        $details = $db->query("SELECT staff.*, role_type FROM staff LEFT JOIN staff_role ON role = staff_role.id WHERE name = :name", array('name' => $name));

        if(!empty($details))
        {
            return $details;
        }
    }

    public static function staff_orders($staff_id)
    {
        global $db;

        $staff_orders = $db->query("SELECT * FROM orders WHERE staff_id = :staff_id ORDER BY id DESC", array('staff_id' => $staff_id));

        return $staff_orders;
    }

    public static function staff_expenses($staff_id)
    {
        global $db;

        $staff_orders = $db->query("SELECT * FROM expenses WHERE staff_id = :staff_id ORDER BY id DESC", array('staff_id' => $staff_id));

        return $staff_orders;
    }

    public static function staff_activities($staff_id)
    {
        global $db;

        $staff_orders = $db->query("SELECT * FROM activities WHERE staff_id = :staff_id ORDER BY id DESC", array('staff_id' => $staff_id));

        return $staff_orders;
    }

  public static function change_password($new_password, $repeat_password) {
    global $db, $staff_id;

    $pwd = request::secureTxt($new_password);
    $repeat_pwd = request::secureTxt($repeat_password);

    if ($pwd != $repeat_pwd) {
      respond::alert('warning', '', "Confirmed password doesn't match new password");
    }else{
      $password = request::securePwd($new_password);

      $statement = "UPDATE staff SET password = :password WHERE id = :staff_id";
      $param = array(
        'password' => $password,
        'staff_id' => $staff_id
      );

      if ($db->query($statement, $param)) {
        respond::alert('success', '', 'Password successfully changed');
      }else{
        respond::alert('danger', '', 'Unable to change password');
      }

    }

  }
  // CHANGE PASSWORD
}
