<?  
    unset($_SESSION['user']);

    setcookie('uid', '', time() - 60480000, '/');
    setcookie('uih', '', time() - 60480000, '/');
    
    header('Location: /');
?>