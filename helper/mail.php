<?php

/**
 * MAIL CLASS
 */
class mail {

    public static function send($from, $sender, $to, $subject, $msg) {

        $yr = date('Y');
        $message = '<!DOCTYPE HTML>
<html>

<style type="text/css">
    html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
    @media only screen and (max-device-width: 680px), only screen and (max-width: 680px) {
        *[class="table_width_100"] {
            width: 96% !important;
        }
        *[class="border-right_mob"] {
            border-right: 1px solid #dddddd;
        }
        *[class="mob_100"] {
            width: 100% !important;
        }
        *[class="mob_center"] {
            text-align: center !important;
        }
        *[class="mob_center_bl"] {
            float: none !important;
            display: block !important;
            margin: 0px auto;
        }
        .iage_footer a {
            text-decoration: none;
            color: #929ca8;
        }
        img.mob_display_none {
            width: 0px !important;
            height: 0px !important;
            display: none !important;
        }
        img.mob_width_50 {
            width: 40% !important;
            height: auto !important;
        }
    }
    .table_width_100 {
        width: 680px;
    }
    a {
        color: #377dff;
    }
</style>

<body style="padding: 0px; margin: 0px;">
<div id="mailsub" class="notification" align="center">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tr><td align="center" bgcolor="#eff3f8">


                <!--[if gte mso 10]>
                <table width="680" border="0" cellspacing="0" cellpadding="0">
                    <tr><td>
                <![endif]-->

                <table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
                    <!--header -->
                    <tr><td align="center" bgcolor="#eff3f8">
                            <!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
                            <table width="96%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td align="left"><!--

                        Item --><div class="mob_center_bl" style="float: left; display: inline-block; width: 115px;">
                                            <table class="mob_center" width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
                                                <tr><td align="left" valign="middle">
                                                        <!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
                                                        <table width="115" border="0" cellspacing="0" cellpadding="0" >
                                                            <tr><td align="left" valign="top" class="mob_center">
                                                                    <a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
                                                                        <font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
                                                                            <img src="https://ctifund.biz/assets/img/logo.svg" style="height: 70px !important" alt="Logo" border="0" style="display: block;" /></font></a>
                                                                </td></tr>
                                                        </table>
                                                    </td></tr>
                                            </table></div><!-- Item END--><!--[if gte mso 10]>
                          </td></tr>
                              </table>
                            </td></tr>
                          </table></div><!-- Item END--></td>
                                </tr>
                            </table>
                            <!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
                        </td></tr>
                    <!--header END-->

                    <!--content 1 -->
                    <tr><td align="center" bgcolor="#ffffff">
                            <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td align="center">
                                        <!-- padding --><div style="height: 50px; line-height: 100px; font-size: 10px;">&nbsp;</div>

                                    </td></tr>
                                <tr><td align="center">
                                        <table width="80%" align="center" border="0" cellspacing="0" cellpadding="0">
                                            <tr><td align="center">
                                                    <div style="line-height: 24px;">
                                                        <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 16px;">
                                                            <div style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e; margin-padding: 50px; text-align: center;">
                                                                '.$msg.'
                                                            </div></font>
                                                    </div>
                                                </td></tr>
                                        </table>
                                        <!-- padding --><div style="height: 45px; line-height: 45px; font-size: 10px;">&nbsp;</div>
                                    </td></tr>
                            </table>
                        </td></tr>
                    <!--content 1 END-->


                    <!--footer -->
                    <tr><td class="iage_footer" align="center" bgcolor="#eff3f8">
                            <!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td align="center">
                                        <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
                        <span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
                          '.$yr.' &copy; <a href="http://ctifund.biz/" target="_blank" style="text-decoration: none; color: #377dff;">CTIFUND</a>. ALL Rights Reserved.
                        </span></font>
                                    </td></tr>
                            </table>

                            <!-- padding --><div style="height: 50px; line-height: 50px; font-size: 10px;">&nbsp;</div>
                        </td></tr>
                    <!--footer END-->
                </table>
                <!--[if gte mso 10]>
                </td></tr>
                </table>
                <![endif]-->

            </td></tr>
    </table>

</div>
</body>

</html>';

                 $headers = "MIME-Version: 1.0" . "\r\n";
                 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                 // More headers
                 $headers .= 'From: '.$sender.' <'.$from.'>' . "\r\n";
                 $headers .= 'Reply-To: '.$sender.' <'.$from.'>' . "\r\n";
//                 ini_set('sendmail_from','lilkenzy02@gmail.com');
                 if (mail($to, $subject, $message, $headers)) {
                     return true;
                 }else {
                     return false;
                 }

    }// SEND MAIL METHOD

}
