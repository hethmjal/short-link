@php
$db = env('DB_DATABASE');
$user = env('DB_USERNAME');
$pass = env('DB_PASSWORD');
// connect to database
$dsn = 'mysql:host=localhost;dbname=' . $db;
$user = $user;
$pass = $pass;
$option = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];

try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOExeception $e) {
    echo 'Failed Connect' . $e->getMessage();
}

if ($link != '[]') {
    foreach ($link as $l) {
        $c = $l->views + 1;
        $stmt = 'UPDATE links SET views=? WHERE link=?';
        $con->prepare($stmt)->execute([$c, $l->link]);
        $now = $now = date('m/d/Y');
        $stmt = $con->prepare('INSERT INTO urlvisits (link, created_at) values(?,?)');
        $stmt->execute([$l->link, $now]);

        echo '
<meta http-equiv="refresh" content="0;' .
            $l->original_link .
            '">';
    }
}
@endphp
