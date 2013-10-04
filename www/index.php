<?php
/**
 * @author Joe Green
 * @link http://smrtr.co.uk
 * @package vagrant-raring
 */
ini_set('error_reporting', '1');
ini_set('display_errors', '1');
require_once '../vendor/autoload.php';
$auth = Zend_Auth::getInstance();

class MyAuthAdapter implements Zend_Auth_Adapter_Interface
{
    const password = 'raring';
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function authenticate()
    {
        return
            $this->password === self::password ?
                new Zend_Auth_Result(1, ['loggedin'=>true], []) :
                new Zend_Auth_Result(-3, null, []);
    }
}

if (isset($_POST['password'])) {
    $result = $auth->authenticate(new MyAuthAdapter($_POST['password']));
}
elseif (isset($_GET['logout'])) {
    $auth->clearIdentity();
    header('Location: /');
    exit;
}
?><html>
<head>
    <title>Vagrant - Ubuntu Raring with PHP & Apache</title>
    <link type="text/css" rel="stylesheet" media="screen" href="/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="hero-unit">
            <h1>Vagrant - Raring <small>with PHP and Apache</small></h1>
        </div>
        <div class="row">
            <div class="span8 offset2">
<?php if ($auth->hasIdentity() || (isset($result) && $result->isValid())): ?>
                    <div class="well">
                        <p class="lead">Well done! You're in!</p>
                        <p><a href="/?logout">Log out</a></p>
                    </div>
<?php elseif (isset($result)): ?>
                    <h3>Enter the password to authenticate <small>the password is <em>raring</em></small></h3>
                    <p class="text-error">The password is <strong>raring</strong>!</p>
                    <form method="POST" action="/">
                        <input type="text" name="password">
                        <input type="submit">
                    </form>
<?php else: ?>
                    <h3>Enter the password to authenticate <small>the password is <em>raring</em></small></h3>
                    <form method="POST" action="/">
                        <input type="text" name="password">
                        <input type="submit">
                    </form>
<?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
