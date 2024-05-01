<?php 
class DatabaseSessionHandler implements SessionHandlerInterface {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function open($savePath, $sessionName): bool {
        return true;
    }

    public function close(): bool {
        return true;
    }

    public function read($sessionId): string|false {
        $stmt = $this->pdo->prepare("SELECT data FROM sessions WHERE id = ?");
        $stmt->execute([$sessionId]);
        $sessionData = $stmt->fetchColumn();
        return $sessionData === false ? '' : $sessionData;
    }

    public function write($sessionId, $data): bool {
        $stmt = $this->pdo->prepare("REPLACE INTO sessions (id, data, last_accessed) VALUES (?, ?, NOW())");
        $stmt->execute([$sessionId, $data]);
        return true;
    }

    public function destroy($sessionId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM sessions WHERE id = ?");
        $stmt->execute([$sessionId]);
        return true;
    }

    public function gc($maxLifetime): int|false {
        $stmt = $this->pdo->prepare("DELETE FROM sessions WHERE last_accessed < DATE_SUB(NOW(), INTERVAL ? SECOND)");
        $stmt->execute([$maxLifetime]);
        return true;
    }
}


$pdo = new PDO('mysql:host=localhost;port=3308;dbname=sessions', 'alex', '0098036');

$sessionHandler = new DatabaseSessionHandler($pdo);

session_set_save_handler($sessionHandler, true);

session_start();
var_dump($_SESSION);
$_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT']; 
$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];

if ($_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['user_ip'] != $_SERVER['REMOTE_ADDR']) {
   
    $sessionId = session_id();
    $sessionHandler-> destroy($sessionId);
    setcookie(session_name(), '', time() - 3600, '/');
   die('Session compromised');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['username'])&&!isset($_SESSION['password'])){
        $_SESSION['username']=$_POST['username'];  
        $_SESSION['password']=$_POST['password']; 
        
    }


    $sessionId = session_id(); 
    $sessionData = $sessionHandler->read($sessionId);
     print_r($sessionData);
}
// $sessionId = session_id(); // Получаем идентификатор текущей сессии
// $sessionHandler->destroy($sessionId);
// setcookie(session_name(), '', time() - 3600, '/');
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="#" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>







