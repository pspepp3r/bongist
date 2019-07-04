<?php

class staff {

    public static function add($name, $email, $phone, $address, $role, $password, $photo = array())
    {
        global $db;

        $check = staff::check_staff();

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
                    'comment'   => 'was just added as a staff',
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

        $staffs = $db->query("SELECT * FROM staff");
        if($staffs > 0)
        {
            return $staffs;
        }else {
            respond::alert('error', '', 'There are no current staffs');
        }
    }

    public static function edit($id, $name, $email, $phone, $address)
    {
        global $db;

        $editStaff = $db->query("UPDATE staff SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id", array(
            'id'        => $id,
            'name'      => $name,
            'email'     => $email,
            'phone'     => $phone,
            'address'   => $address,
        ));

        if($editStaff)
        {
            respond::alert('success', '', 'Staff has been updated successfully');
        }else {
            respond::alert('error', '', 'Staff has not been updated');
        }
    }

    public static function check_staff()
    {
        global $db;

        $check = $db->query("SELECT name FROM staff");
        if($check)
        {
            return $check;
        }
    }
}