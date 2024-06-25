<?php
require_once("../config.php");

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melakukan validasi input dengan htmlspecialchars()
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);

    // Escape karakter khusus dalam konteks SQL dengan mysqli_escape_string()
    $username = mysqli_escape_string($conn, $username);
    $password = mysqli_escape_string($conn, $password);

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
    $check = mysqli_query($conn, $query);

    if ($check->num_rows > 0) {
        $row = mysqli_fetch_assoc($check);
        $_SESSION['username'] = $row['username'];
        header("Location: index.php");
    } else {
        echo "<script>alert('Username/Password salah');</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?> - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="shadow card mt-5">
                    <h3 class="card-header bg-primary text-light py-4">Login Page</h3>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>