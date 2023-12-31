if (isset($_SESSION['loggedin'])) {
    header('Location: home.php');
    exit;
}
