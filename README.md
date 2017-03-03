# inputvar
access and sanitize user input

*inputvar*'s purpose is for convenience of accessing client (user) input in a safe way.

By using the inputvar classes, you do not have to referece the PHP superglobals `$_GET`, `$_POST`, `$_REQUEST`, et. al.

There are also convenience methods that allow you to check if a variable 'exists',
and provide sanitized values in various formats, eg: mysql escaped, base64, hex, alphanumeric, etc.

## Usage:
If the request URI is as follows:

http://example.com/getpage.php?pagename=poop

The following code block...
```php
$page = new getvar('pagename');
if ($page->exists())
	echo $page->alphanum();
```

will display the text 'poop'...
```html
poop
```

*inputvar* can facilitate POST, GET, or any REQUEST var as follows
```php
//POST var
$mypostvar = new postvar('mypostvar');

//GET var
$mygetvar = new getvar('mygetvar');

//REQUEST variable
$myreqvar = new reqvar('myreqvar');

//arbitrary string
$myvarvar = new varvar('Some stuff I want to put and perhaps filter');
```

The following methods are available to actually get the values

```php
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

```

