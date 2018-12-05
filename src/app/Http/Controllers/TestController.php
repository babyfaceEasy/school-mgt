<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Instructions:
     *
     * Given the above JSON, build a simple PHP script to import it.
     *
     * Your script should create two variables:
     *
     * - a comma-separated list of email addresses
     * - the original data, sorted by age descending, with a new field on each record
     *   called "name" which is the first and last name joined.
     *
     * Please deliver your code in either a GitHub Gist or some other sort of web-hosted code snippet platform.
     */
    static function cmp($a, $b){
        if ($a['age'] == $b['age']) {
            return 0;
        }

        return ($a['age'] < $b['age']) ? -1 : 1 ;
    }
    private function isJson($string){
        $result = json_decode($string, true);

        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = ''; // JSON is valid // No error has occurred
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
            // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }
       
        if ($error !== '') {
            // throw the Exception or exit // or whatever :)
            exit($error);
        }
        return $result;
    }
    public function index()
    {
        $people = '{"data":[{"first_name":"jake","last_name":"bennett","age":31,"email":"jake@bennett.com","secret":"VXNlIHRoaXMgc2VjcmV0IHBocmFzZSBzb21ld2hlcmUgaW4geW91ciBjb2RlJ3MgY29tbWVudHM="},{"first_name":"jordon","last_name":"brill","age":85,"email": "jordon@brill.com","secret":"YWxidXF1ZXJxdWUuIHNub3JrZWwu"},]}';
        $people = rtrim($people, ',');

        $last_comma = strrpos($people, ',');
        //dd($last_comma);
        $people = substr_replace($people, '', $last_comma, 1);

        // json decode string into associative array.
        $result = json_decode($people, true);

        $email_addresses = '';
        $sorted_arr = array();
        foreach ($result['data'] as $data) {
            $email_addresses .= $data['email'] . ', ';
            $temp_arr = $data;
            $temp_arr['name'] = $data['first_name'] . ' ' . $data['last_name'];
            array_push($sorted_arr, $temp_arr);
        }

        uasort($sorted_arr, function($a, $b){
            if ($a['age'] == $b['age']) {
                return 0;
            }
    
            return ($a['age'] < $b['age']) ? -1 : 1 ;
        });
    
        //remove the last_comma
        $email_addresses = substr_replace($email_addresses, '', strrpos(trim($email_addresses), ','), 1);

        print_r($email_addresses . "\n");
        echo "<br>";
        print_r($sorted_arr);

        //dd($sorted_arr);

        //return $email_addresses;
    }
}
