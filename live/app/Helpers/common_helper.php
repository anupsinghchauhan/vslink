<?php

if ( ! function_exists('get_roles'))

{    

    /**

     * get_roles

     *

     * @return void

     */

    function get_roles()

    {

        $role_arr = array(

            encryptor(1) => 'Super Admin',

            encryptor(2) => 'Admin'

        );

        return $role_arr;

    }

}



if ( ! function_exists('slugify')){

    /**

     * slugify

     *

     * @param  mixed $text

     * @return void

     */

    function slugify($text)

    {

        // replace non letter or digits by -

        $text = preg_replace('~[^\pL\d]+~u', '_', $text);

        // transliterate

        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters

        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim

        $text = trim($text, '-');

        // remove duplicate -

        $text = preg_replace('~-+~', '-', $text);

        // lowercase

        $text = strtolower($text);

        if (empty($text)) {

            return 'n-a';

        }

        return $text;

    }

}


if (! function_exists('thousandsCurrencyFormat')) {
    function thousandsCurrencyFormat($num) {

     if($num>1000) {

           $x = round($num);
           $x_number_format = number_format($x);
           $x_array = explode(',', $x_number_format);
           $x_parts = array('k', 'm', 'b', 't');
           $x_count_parts = count($x_array) - 1;
           $x_display = $x;
           $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
           $x_display .= $x_parts[$x_count_parts - 1];

           return $x_display;

     }

     return $num;
   }
}

if (! function_exists('get_client_ip')) {
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}