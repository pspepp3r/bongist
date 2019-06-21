<?php


class slider {

    public static function all() {
        global $db;

        $categories = $db->query("SELECT * FROM sliders ORDER BY id DESC");

        if (count($categories) > 0) {
            return $categories;
        }else {
            return false;
        }

    }// GET ALL PRODUCT CATEGORIES

    public static function add($title, $link, $description, $file = array()) {
        global $db;

        $check = $db->query("SELECT title FROM sliders WHERE title = :title", array('title' => $title), false);

        if ($check) {
            respond::alert('warning', '', 'Slider with the same title already exist');
            return false;
        }

        $upload = upload::add($file, config::baseUploadSliderUrl(), true);
        $image = $upload['file'];

        $add = $db->query("INSERT INTO sliders (title, link, image, description, timestamp) VALUES (:title, :link, :image, :description, :now)", array(
            'title' => request::secureTxt($title),
            'image' => $image,
            'description' => $description,
            'now' => time(),
            'link' => request::secureTxt($link)
        ));

        if ($add) {
            respond::alert('success', '', 'Slider successfully added');
        }else {
            respond::alert('danger', '', 'Sorry, there was an error adding slider');
        }

    }// Add new slider

    public static function edit($id, $title, $link, $description, $file = array()) {
        global $db;

        if ($file['size'] > 0) {

            $image = $db->single("SELECT image FROM sliders WHERE id = :id", array('id' => $id));

            upload::remove($image, config::baseUploadSliderUrl());

            $upload = upload::add($file, config::baseUploadSliderUrl(), true);
            $image = $upload['file'];

            $db->query("UPDATE sliders SET image = :image WHERE id = :id", array('image' => $image, 'id' => $id));

        }

        $update = $db->query("UPDATE sliders SET title = :title, link = :link, description = :description WHERE id = :id", array(
            'id' => $id,
            'title' => request::secureTxt($title),
            'description' => $description,
            'link' => request::secureTxt($link)
        ));

        if ($update) {
            respond::alert('success', '', 'Slider successfully updated');
        }else {
            respond::alert('danger', '', 'Unable to update slider');
        }

    }// Edit slider

    public static function remove($id) {
        global $db;

        $image = $db->single("SELECT image FROM sliders WHERE id = :id", array('id' => $id));

        upload::remove($image, config::baseUploadSliderUrl());

        $remove = $db->query("DELETE FROM sliders WHERE id = :id", array('id' => $id));

        if ($remove) {
            respond::alert('success', '', 'Slider successfully removed');
        }else {
            respond::alert('danger', '', 'Unable to remove this slider');
        }

    }// Remove slider

}