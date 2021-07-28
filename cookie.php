<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        header('Cache-Control: no-store');
        header('Content-Type: text/javascript');

        if ($_GET['callback']=='') {
            echo 'alert("Error: A callback function must be specified.")';
        }
        elseif (!isset($_GET['cookieName'])) {// Cookie not set yet
            $cookieName = strtr((string)$_SERVER['UNIQUE_ID'], '@', '_');
            while (isset($_COOKIE[$cookieName]) || $cookieName=='') {
                $cookieName = dechex(mt_rand());// Get random cookie name
            }
            setcookie($cookieName, '3rd-party', 0, '/');
            header('Location: '.$_SERVER['REQUEST_URI'].'&cookieName='.$cookieName);
        }
        elseif ($_COOKIE[$_GET['cookieName']]=='3rd-party') {// Third party cookies are enabled.
            setcookie($_GET['cookieName'], '', -1, '/'); // delete cookie
            echo $_GET['callback'].'(1)';
        }
        else {// Third party cookies are not enabled.
            echo $_GET['callback'].'(0)';
        }
    ?>
</body>
</html>