<?php
//This is an array for the states
$states = array(
    'Alabama',
    'Alaska',
    'Arizona',
    'Arkansas',
    'California',
    'Colorado',
    'Connecticut',
    'Delaware',
    'District of Columbia',
    'Florida',
    'Georgia',
    'Hawaii',
    'Idaho',
    'Illinois',
    'Indiana',
    'Iowa',
    'Kansas',
    'Kentucky',
    'Louisiana',
    'Maine',
    'Maryland',
    'Massachusetts',
    'Michigan',
    'Minnesota',
    'Mississippi',
    'Missouri',
    'Montana',
    'Nebraska',
    'Nevada',
    'New Hampshire',
    'New Jersey',
    'New Mexico',
    'New York',
    'North Carolina',
    'North Dakota',
    'Ohio',
    'Oklahoma',
    'Oregon',
    'Pennsylvania',
    'Rhode Island',
    'South Carolina',
    'South Dakota',
    'Tennessee',
    'Texas',
    'Utah',
    'Vermont',
    'Virginia',
    'Washington',
    'West Virginia',
    'Wisconsin',
    'Wyoming',
);
// first and last name clean up function
function cleanUpString($str)
{
    $string = str_replace(' ', '', $str);
    if ($string != "" && $string != null && $string != false && $string != " ") {
        $string = str_replace(' ', '', $str);
        $string = trim($str, " ");
        $string = strip_tags($str);
        $string = ucwords(strtolower($str));

        return $string;
    } else {return false;}
}
//This will check if the password is atleast 6 characters
function isValidPassword($password)
{
    if (strlen($password) >= 6) {
        return $password;
    }
}return false;
//valid phone fuction
function isValidPhone($pNumber)
{
    $isLessThan10 = strlen($pNumber) == 10;
    $areaCode = substr($pNumber, 0, 3);
    $nextThree = substr($pNumber, 3, 3);
    $lastFour = substr($pNumber, 6, 4);
    $pNumberAsArray = str_split($pNumber);
    //this will generate (xxx)xxx-xxxx
    $pNumber = '(' . $areaCode . ')' . $nextThree . '-' . $lastFour;

//this will check if string is number or not
    if ($isLessThan10) {
        foreach ($pNumberAsArray as $char) {
            if (!is_numeric($char)) {
                return false;
            }
        }
        return $pNumber;
    } else {
        return false;
    }

}

//This function validates and formats address entered
function isValidAddress($address)
{
    $add = str_replace(' ', '', $address);
    if ($address != "" && $address != null && $address != false && $address != " ") {
        $add = str_replace(' ', '', $address);
        $add = trim($address, " ");
        $add = strip_tags($address);
        $add = ucwords(strtolower($address));
        return $add;
    } else {return false;}
}

//This function validates that the zipcode is numerical
function isValidZip($zipcode)
{
    if ($zipcode != "" && is_numeric($zipcode) && strlen($zipcode) == 5) {
        return $zipcode;
    }
    return false;
}
//This function is used to validate emails.
function isValidEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}