<?php


class gallery {

    public static function add($id, $files = array()) {
        global $db;

        $status = false;


        foreach ($files["tmp_name"] as $file) {

            $upload = upload::multiple($file, config::baseUploadProductGalleryUrl(), true);
            $image = $upload['file'];

            if ($db->query("INSERT INTO product_gallery (product_id, image) VALUES (:id, :image)", array('id' => $id, 'image' => $image))) {
                $status = true;
            }else {
                $status = false;
            }

        }

        if ($status) {
            respond::alert('success', '', 'Images successfully added to product gallery');
        }else {
            respond::alert('warning', '', 'Unable to add all images to product gallery');
        }

    }// Add images to gallery

    public static function all($id) {
        global $db;

        $gallery = $db->query("SELECT * FROM product_gallery WHERE product_id = :id ORDER BY id DESC", array('id' => $id));

        if (count($gallery) > 0) {
            return $gallery;
        }else {
            return false;
        }

    }// Get all images in gallery

    public static function remove($id) {
        global $db;

        $image = $db->single("SELECT image FROM product_gallery WHERE id = :id", array('id' => $id));

        upload::remove($image, config::baseUploadProductGalleryUrl());

        $remove = $db->query("DELETE FROM product_gallery WHERE id = :id", array('id' => $id));

        if ($remove) {
            respond::alert('success', '', 'Image successfully removed from product gallery');
        }else {
            respond::alert('danger', '', 'Unable to remove this image from product gallery');
        }

    }

}