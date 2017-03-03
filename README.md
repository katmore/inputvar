# inputvar

*inputvar*'s purpose is for convenience of accessing client (user) input in a safe way.

By using the inputvar classes, you do not have to referece the PHP superglobals `$_GET`, `$_POST`, `$_REQUEST`, et. al.

There are also convenience methods that allow you to check if a variable 'exists',
and provide sanitized values in various formats, eg: mysql escaped, base64, hex, alphanumeric, etc.

## Installation
Add 'inputvar' as a dependency to your existing project
**Using composer**
```bash
cd my_project_dir
composer require katmore/flat
```

## Demo
See [demo.php](./demo.php) for examples regarding the above methods.

## Usage

### Setting Values
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

### Getting the values
The following methods are available to actually get the values...
 * inputvar::myesc()
 * inputvar::streetaddr()
 * inputvar::value()
 * inputvar::email()
 * inputvar::alphanumspace()
 * inputvar::alphanum()
 * inputvar::numeric()
 * inputvar::usphone()
 
See [demo.php](./demo.php) for examples regarding the above methods.

## Legal
### Copyright
inputvar. https://github.com/katmore/inptuvar
Copyright (c) 2010-2017 Doug Bird. All Rights Reserved.

### License
inputvar is copyrighted free software.
You may redistribute and modify it under either the terms and conditions of the
"The MIT License (MIT)"; or the terms and conditions of the "GPL v3 License".
See [LICENSE](https://github.com/katmore/inputvar/blob/master/LICENSE) and [GPLv3](https://github.com/katmore/inputvar/blob/master/GPLv3).


