<?php

class Validator {
    public static function validate_email($email) {
        if (empty($email)) {
            return false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public static function validate_int($int) {
        if (empty($int)) {
            return false;
        } elseif (!is_numeric($int)) {
            return false;
        }
        return true;
    }

    public static function validate_date($date, $format = 'Y-m-d') {
        if (empty($date)) {
            return false;
        } elseif (!DateTime::createFromFormat($format, $date)) {
            return false;
        }
        return true;
    } 

    public static function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
        
}