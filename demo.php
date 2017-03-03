<?php

/*
//value escaped with real_escape_string
//inputvar::myesc(mysqli $mysqli_resource);
 */
echo $myinputvar->myesc($mysqli_resource);

/*
//value striped of all chars except what is needed for a street address
//inputvar::streetaddr();
 */
echo $myinputvar->streetaddr();

/*
//value stripped of HTML tags, high/low ascii chars
//inputvar::value();
 */
echo $myinputvar->value();

/*
//value stripped except what is needed for email address
//inputvar::email();
 */
echo $myinputvar->email();

/*
//value stripped except for alphanumeric chars and space
//inputvar::alphanumspace();
 */
echo $myinputvar->alphanumspace();

/*
//value stripped except for alphanumeric chars
//inputvar::alphanum();
 */
echo $myinputvar->alphanum();

/*
//value stripped except for numeric chars
//inputvar::numeric();
 */
echo $myinputvar->numeric();

/*
//value formatted as US phone number
//inputvar::usphone();
 */
echo $myinputvar->usphone();









