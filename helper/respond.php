<?php

/**
 * RESPOND CLASS
 */
class respond {

    public static function alert($type, $title, $message) {
        ?>
                                        <div class="alert alert-<?php echo $type; ?> alert-custom" style="text-align: center; margin-bottom: 20px; width: 100%;" >

                                        <?php
                                        if ($title != "") {
                                        	?>
    									<h4 class="alert-title"><?php echo $title; ?></h4>
                                        	<?php
                                        }

                                        if ($message != '') {
                                        	?>
    									<p style="margin-bottom: 0px; font-size: 14px;"><?php echo $message; ?></p>
                                        	<?php
                                        }
                                        ?>
                                        </div>
        <?php
    }



        public static function time_diff($time) {
        $time_diff =  time() - $time;
        return floor($time_diff /3600);
        }


        public static function timeAgo($time_ago){
            $cur_time   = time();
            $time_elapsed   = $cur_time - $time_ago;
            $seconds  = $time_elapsed ;
            $minutes  = round($time_elapsed / 60 );
            $hours    = round($time_elapsed / 3600);
            $days     = round($time_elapsed / 86400 );
            $weeks    = round($time_elapsed / 604800);
            $months   = round($time_elapsed / 2600640 );
            $years    = round($time_elapsed / 31207680 );
        // Seconds
            if($seconds <= 60){
                echo "$seconds seconds ago";
            }
        //Minutes
            else if($minutes <=60){
                if($minutes==1){
                    echo "one minute ago";
                }
                else{
                    echo "$minutes minutes ago";
                }
            }
        //Hours
            else if($hours <=24){
                if($hours==1){
                    echo "an hour ago";
                }else{
                    echo "$hours hours ago";
                }
            }
        //Days
            else if($days <= 7){
                if($days==1){
                    echo "yesterday";
                }else{
                    echo "$days days ago";
                }
            }
        //Weeks
            else if($weeks <= 4.3){
                if($weeks==1){
                    echo "a week ago";
                }else{
                    echo "$weeks weeks ago";
                }
            }
        //Months
            else if($months <=12){
                if($months==1){
                    echo "a month ago";
                }else{
                    echo "$months months ago";
                }
            }
        //Years
            else{
                if($years==1){
                    echo "one year ago";
                }else{
                    echo "$years years ago";
                }
            }
        }


        public static function limit_words($string, $word_limit) {
            $words = explode(" ",$string);
            return implode(" ",array_splice($words,0,$word_limit));
        }


            public static function generateRandomID($length = 10) {
                $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return strtoupper($randomString);
            }

            public static function time() {
                //getting current date and time
                date_default_timezone_set("Africa/Lagos");
                    $d = date("d-m-Y");
                    $t = date("h:i A");
                    $date = $d.' | '.$t;
                    $now =  time();
            }

            public static function getIP() {
                $ip;
                if (getenv("HTTP_CLIENT_IP"))
                $ip = getenv("HTTP_CLIENT_IP");
                else if(getenv("HTTP_X_FORWARDED_FOR"))
                $ip = getenv("HTTP_X_FORWARDED_FOR");
                else if(getenv("REMOTE_ADDR"))
                $ip = getenv("REMOTE_ADDR");
                else
                $ip = "UNKNOWN";
                return $ip;

            }


            public static function json($status, $status_message, $data) {
                $response = array(
                  'status' => $status,
                  'status_message' => $status_message,
                  'data' => $data
                );
                echo json_encode($response);
            }

}
