--------
2015-08 Update Notes

I have refactored the inputvar package to be psr-2 and psr-4 compliant.
I implemented the use of namespaces, created explicit exception classes, 
and changed to camel casing for class and method names.

I have included 'legacy' support that should work for code using this package
prior to the August 2015 updates. See the bottom of the inputvar.php file.
--------
Inputvar's purpose is mainly for convenience of accessing client (user)
input in a more safe way. It is dual-licensed under the GPLv3 and MIT licenses.

By using the inputvar classes, you do not have to
referece the $_GET, $_POST, $_REQUEST superglobals.

There are also convenience methods that allow you to check if a variable 'exists',
and provide sanitized values in various formats, eg: mysql escaped, base64, hex, alphanumeric, etc.

Usage:
If the request URI is as follows:

http://example.com/getpage.php?pagename=poop

The following code
<?php
use \inputvar\getvar;
$page = new getvar('pagename');
if ($page->exists())
	echo $page->alphanum();
?>
will display the text 'poop'

It can facilitate POST, GET, or any REQUEST var as follows

<?php
//POST var
$mypostvar = new postvar('mypostvar');

//GET var
$mygetvar = new getvar('mygetvar');

//REQUEST variable
$myreqvar = new reqvar('myreqvar');

//arbitrary string
$myvarvar = new varvar('Some stuff I want to put and perhaps filter');
?>

The following methods are available to actually get the values

<?php

//value escaped with real_escape_string
//inputvar::myesc(mysqli $mysqli_resource);
echo $myinputvar->myesc(mysqli $mysqli_resource);

//value striped of all chars except what is needed for a street address
//inputvar::streetaddr();
echo $myinputvar->streetaddr();

//value stripped of HTML tags, high/low ascii chars
//inputvar::value();
echo $myinputvar->value();

//value stripped except what is needed for email address
//inputvar::email();
echo $myinputvar->email();

//value stripped except for alphanumeric chars and space
//inputvar::alphanumspace();
echo $myinputvar->alphanumspace();

//value stripped except for alphanumeric chars
//inputvar::alphanum();
echo $myinputvar->alphanum();

//value stripped except for numeric chars
//inputvar::numeric();
echo $myinputvar->numeric();

//value formatted as US phone number
//inputvar::usphone();
echo $myinputvar->usphone();

?>
