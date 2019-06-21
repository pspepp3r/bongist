<?php


class category {

    public static function all() {
        global $db;

            $categories = $db->query("SELECT * FROM categories ORDER BY id DESC");

            if (count($categories) > 0) {
                return $categories;
            }else {
                return false;
            }

    }// GET ALL PRODUCT CATEGORIES

    public static function add($title, $description, $file = array()) {
        global $db;

        $check = $db->query("SELECT name FROM categories WHERE name = :title", array('title' => $title), false);

        if ($check) {
            respond::alert('warning', '', 'Category with the same title already exist');
            return false;
        }

        $upload = upload::add($file, config::baseUploadCategoryUrl(), true);
        $image = $upload['file'];

        $add = $db->query("INSERT INTO categories (name, image, description, timestamp, slug) VALUES (:title, :image, :description, :now, :slug)", array(
            'title' => $title,
            'image' => $image,
            'description' => $description,
            'now' => time(),
            'slug' => request::slug($title)
        ));

        if ($add) {
            respond::alert('success', '', 'Category successfully added');
        }else {
            respond::alert('danger', '', 'Sorry, there was an error adding category');
        }

    }// Add new category

    public static function edit($id, $title, $description, $file = array()) {
        global $db;

        if ($file['size'] > 0) {

            $image = $db->single("SELECT image FROM categories WHERE id = :id", array('id' => $id));

            upload::remove($image, config::baseUploadCategoryUrl());

            $upload = upload::add($file, config::baseUploadCategoryUrl(), true);
            $image = $upload['file'];

            $db->query("UPDATE categories SET image = :image WHERE id = :id", array('image' => $image, 'id' => $id));

        }

        $update = $db->query("UPDATE categories SET name = :title, description = :description, slug = :slug WHERE id = :id", array(
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'slug' => request::slug($title)
        ));

        if ($update) {
            respond::alert('success', '', 'Category successfully updated');
        }else {
            respond::alert('danger', '', 'Unable to update category');
        }

    }// Edit category

    public static function remove($id) {
        global $db;

        $image = $db->single("SELECT image FROM categories WHERE id = :id", array('id' => $id));

        upload::remove($image, config::baseUploadCategoryUrl());

        $remove = $db->query("DELETE FROM categories WHERE id = :id", array('id' => $id));

        if ($remove) {
            $db->query("DELETE FROM product_category WHERE category_id = :id", array('id' => $id));
            respond::alert('success', '', 'Category successfully removed');
        }else {
            respond::alert('danger', '', 'Unable to remove this category');
        }

    }// Remove category

    public static function products($id) {
        global $db;

        $products = $db->query("SELECT * FROM product_category LEFT JOIN products ON product_id = products.id WHERE category_id = :id", array('id' => $id));

        if (count($products)) {
            return $products;
        }else {
            return false;
        }

    }// Get all products of category

    public static function check($slug) {
        global $db;

        $category = $db->query("SELECT * FROM categories WHERE slug = :slug", array('slug' => $slug), false);

        if ($category) {
            return $category;
        }else {
            return false;
        }

    }// Check if category exist with slug



}