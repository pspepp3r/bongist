<?php

/**
 * UPLOAD CLASS
 */
class upload {

    public static function check($image) {


        $uploadOk = 1;
        $imageFileType = pathinfo($image["name"],PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        $check = getimagesize($image["tmp_name"]);
        if($check != false) {

            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            $response = array(
                'status' => false,
                'message' => "File is not an image"
            );

            return $response;
        }

        // Check file size
        if ($image["size"] > 10000000) {
            $uploadOk = 0;
            $response = array(
                'status' => false,
                'message' => "Sorry, your file is too large. Maximum of 10mb"
            );

            return $response;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {

            $uploadOk = 0;
            $response = array(
                'status' => false,
                'message' => "Sorry, only JPG, JPEG, PNG & GIF files are allowed"
            );

            return $response;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {

            $response = array(
                'status' => true,
                'message' => "File is good to upload"
            );

            return $response;
            // if everything is ok, try to upload file
        }

    }// CHECK FILE FOR UPLOAD

    public static function add($image, $target_dir, $compress = false) {

        $rand = rand(11113, 99994);

        $file = request::hashString($rand).'.jpg';
        $target_file = $target_dir.$file;

        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            $response = array(
                'status' => true,
                'message' => "File successfully uploaded",
                'file' => $file
            );

            if ($compress == true) {
                request::compress($target_file, $target_file);
            }

        }else {
            $response = array(
                'status' => false,
                'message' => "Unable to upload file"
            );
        }

        return $response;

    }

    public static function multiple($image, $target_dir, $compress = false) {

        $rand = rand(11113, 99994);

        $file = request::hashString($rand).'.jpg';
        $target_file = $target_dir.$file;

        if (move_uploaded_file($image, $target_file)) {
            $response = array(
                'status' => true,
                'message' => "File successfully uploaded",
                'file' => $file
            );

            if ($compress == true) {
                request::compress($target_file, $target_file);
            }

        }else {
            $response = array(
                'status' => false,
                'message' => "Unable to upload file"
            );
        }

        return $response;

    }

    public static function remove($file, $target_dir) {
        $source = $target_dir.$file;
        if ($file == '') {
            return true;
        }else {

            if (file_exists($source)) {

                if (unlink($source)) {
                    return true;
                }else {
                    return false;
                }

            }else {
                return false;
            }

        }
    }

}
