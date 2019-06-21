<?php


class product {

    public static function all() {
        global $db;

        $products = $db->query("SELECT * FROM products ORDER BY timestamp DESC");
        return $products;

    }

    public static function view($limit = null) {
        global $db;

        if ($limit == null) {
            $products = $db->query("SELECT * FROM products ORDER BY id DESC");
        }else {
            $products = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT $limit");
        }

        return $products;

    }

    public static function single($slug) {
        global $db;

        $product = $db->query("SELECT * FROM products WHERE slug = :slug", array('slug' => $slug), false);

        if ($product) {
            return $product;
        }else {
            return false;
        }

    }

    public static function add($title, $categories = array(), $price, $c_price, $discount, $file = array(), $description) {
        global $db;

        if (self::check($title)) {
            respond::alert('warning', '', 'Product with the same title already exist');
            return false;
        }

        $upload = upload::add($file, config::baseUploadProductUrl(), true);
        $image = $upload['file'];

        $params = array(
          'title' => request::secureTxt($title),
          'price' => request::secureTxt($price),
          'c_price' => request::secureTxt($c_price),
          'discount' => request::secureTxt($discount),
          'image' => $image,
          'description' => request::secureTxt($description),
          'now' => time(),
          'slug' => request::slug($title)
        );

        $statement = "INSERT INTO products (name, thumbnail, price, cost_price, discount, description, timestamp, slug) VALUES (:title, :image, :price, :c_price, :discount, :description, :now, :slug)";

        if ($db->query($statement, $params)) {

            $id = $db->lastInsertId();
            foreach ($categories as $key => $value) {
                $db->query("INSERT INTO product_category (product_id, category_id) VALUES (:id, :cat_id)", array('id' => $id, 'cat_id' => $value));
            }

            respond::alert('success', '', 'Product successfully added');

        }else {
            respond::alert('danger', '', 'Unable to add new product');
        }

    }// Add Product

    public static function edit($id, $title, $categories = array(), $price, $c_price, $discount, $file = array(), $description) {
        global $db;

        if ($file['size'] > 0) {

            $image = $db->single("SELECT thumbnail FROM products WHERE id = :id", array('id' => $id));

            upload::remove($image, config::baseUploadProductUrl());

            $upload = upload::add($file, config::baseUploadProductUrl(), true);
            $image = $upload['file'];

            $db->query("UPDATE products SET thumbnail = :image WHERE id = :id", array('image' => $image, 'id' => $id));

        }

        $update = $db->query("UPDATE products SET name = :title, description = :description, slug = :slug, price = :price, cost_price = :c_price, discount = :discount, timestamp = :now WHERE id = :id", array(
            'id' => request::secureTxt($id),
            'title' => request::secureTxt($title),
            'price' => request::secureTxt($price),
            'c_price' => request::secureTxt($c_price),
            'discount' => request::secureTxt($discount),
            'description' => request::secureTxt($description),
            'now' => time(),
            'slug' => request::slug($title)
        ));

        if ($categories) {
            $db->query("DELETE FROM product_category WHERE product_id = :id", array('id' => $id));
            foreach ($categories as $key => $value) {
                $db->query("INSERT INTO product_category (product_id, category_id) VALUES (:p_id, :cat_id)", array('p_id' => $id, 'cat_id' => $value));
            }
        }

        if ($update) {
            respond::alert('success', '', 'Product successfully updated');
        }else {
            respond::alert('danger', '', 'Unable to update product');
        }

    }// Edit Product

    public static function remove($id) {
        global $db;

        $image = $db->single("SELECT thumbnail FROM products WHERE id = :id", array('id' => $id));

        upload::remove($image, config::baseUploadProductUrl());

        $remove = $db->query("DELETE FROM products WHERE id = :id", array('id' => $id));

        if ($remove) {
            $db->query("DELETE FROM product_category WHERE product_id = :id", array('id' => $id));
            respond::alert('success', '', 'Product successfully removed');
        }else {
            respond::alert('danger', '', 'Unable to remove this product');
        }

    }// Remove Product

    public static function check($title) {
        global $db;

        if ($db->query("SELECT name FROM products WHERE name = :title", array('title' => $title), false)) {
            return true;
        }else {
            return false;
        }

    }// check if product exist

    public static function other_products($slug) {
        global $db;

        $products = $db->query("SELECT * FROM products WHERE slug != :slug ORDER BY RAND() LIMIT 4", array('slug' => $slug));

        if ($products) {
            return $products;
        }else {
            return false;
        }

    }// Fetch other products

    public static function display($product, $home = false) {
        ?>
        <div class="col-xl-3 col-lg-3 col-sm-6 col-md-<?php if ($home == true) {
            echo 3;
        }else {
            echo 4;
        }
        ?>">
            <div class="product">
                <div class="product-image">
                    <?php
                    if ($product['discount'] != 0) {
                        echo '<div class="ribbon ribbon-dark">-'.$product['discount'].'%</div>';
                    }
                    ?>
                    <img src="<?php echo config::baseUploadProductUrl().$product['thumbnail']; ?>" alt="<?php echo $product['name']; ?>" style="object-fit: cover; height: 350px; width: 100%;" class="img-fluid">
                    <div class="product-hover-overlay">
                        <div class="product-hover-overlay-buttons">
                            <a href="shop/product/<?php echo $product['slug']; ?>" class="btn btn-dark btn-buy"><span class="btn-buy-label ml-2">View</span></a>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <h3 class="h6 text-uppercase mb-1 text-ellipsis">
                        <a href="shop/product/<?php echo $product['slug']; ?>" class="text-dark"><?php echo $product['name']; ?></a>
                    </h3>
                    <span class="text-muted">₦<?php echo number_format($product['price']); ?></span>
                </div>
            </div>
        </div>
<?php
    }

    public static function search($product) {
        global $db;

        $products = $db->query("SELECT * FROM products WHERE name LIKE :product", array('product' => '%'.$product.'%'));

        if (count($products) > 0) {
            return $products;
        }else {
            return false;
        }

    }

}