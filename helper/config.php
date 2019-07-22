<?php
/**
 * Created by IntelliJ IDEA.
 * User: psalm29
 * Date: 20/09/2017
 * Time: 9:01 PM
 */

class config {

//      static $url = "http://localhost/bongist/";
      static $url = "https://bongist.dev";


    public static function base() {
        return self::$url;
    }

    public static function email() {
        return "bongistk@gmail.com";
    }

    public static function name() {
        return "Bongist Koncepts";
    }


    public static function description() {
        return "Bongist Koncept";
    }

    public static function address() {
        return "13/25 New Avenue<br>New Heaven, 45Y 73J<br>England, <strong>Great Britain</strong>";
    }

    public static function accountDetails() {
        return "<strong>Bank: </strong> Access Bank<br><strong>Account Name: </strong> Janelle Clothings<br><strong>Account Number: </strong> 8968686586";
    }

    public static function phone() {
        return "<strong>+33 555 444 333</strong>";
    }

    public static function url() {
        return self::$url;
    }

    public static function logo() {
        return 'assets/images/logo.svg';
    }

    public static function favicon() {
        return 'assets/images/favicon.png';
    }

    public static function baseUploadStaffUrl() {
        return 'assets/images/staff/';
    }

    public static function defaultPhoto() {
        return 'avatar.png';
    }

    public static function baseUploadSliderUrl() {
        return 'assets/images/sliders/';
    }

    public static function baseUploadProfileUrl() {
        return 'assets/images/customers/';
    }

    public static function paymentActivity()
    {
        return 'added a payment';
    }

    public static function expenseActivity()
    {
        return 'added an expense';
    }

    public static function expenseUpdateActivity()
    {
        return 'edited an expense';
    }

    public static function orderActivity()
    {
        return 'added an order';
    }

    public static function orderUpdateActivity()
    {
        return 'updated an order';
    }

    public static function noteActivity()
    {
        return 'added a note';
    }

    public static function staffActivity()
    {
        return 'was added as a staff';
    }

    public static function staffUpdateActivity()
    {
        return 'updated a staff';
    }

    public static function expenseCategoryActivity()
    {
        return 'added an expense category';
    }

    public static function customerActivity()
    {
        return 'added a customer';
    }


    public static function meta() {
        ?>
        <!-- Search Engine -->
        <meta name="description" content="<?php echo self::description(); ?>">
        <meta name="image" content="<?php echo self::base().self::logo(); ?>">
        <meta content="Codekago Interactive" name="author"/>

        <!-- Schema.org for Google -->
        <meta itemprop="name" content="<?php echo self::name(); ?>">
        <meta itemprop="description" content="<?php echo self::description(); ?>">
        <meta itemprop="image" content="<?php echo self::base().self::logo(); ?>">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php echo self::name(); ?>">
        <meta name="twitter:description" content="<?php echo self::description(); ?>">

        <!-- Open Graph general (Facebook, Pinterest & Google+) -->
        <meta name="og:title" content="<?php echo self::name(); ?>">
        <meta name="og:description" content="<?php echo self::description(); ?>">
        <meta name="og:image" content="<?php echo self::base().self::logo(); ?>">
        <meta name="og:url" content="<?php echo self::base(); ?>">
        <meta name="og:site_name" content="<?php echo self::name(); ?>">
        <meta name="og:type" content="website">

        <?php
    }



}
