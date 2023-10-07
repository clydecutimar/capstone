<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1015A3;
        }
        .container {
            margin-top: 100px;
        }
        .card {
            border: none;
        }
        .card-header h1 {
            font-size: 24px;
            text-align: center;
        }
        .error {
            color: red;
        }
		.logo {
            display: block;
            margin: 0 auto; /* Center the logo horizontally */
            text-align: center;
        }
        .logo a {
        text-decoration: none;
    }
    </style>
</head>
<body>
<br><br>
<div class="logo">
    <h1><a href="main.php"><span style="color: white;">scholarIN</span></a></h1>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1>Scholarship Provider</h1>
                    </div>
					<h1 style="padding-left: 30px;">Sign In</h1>
                    <div class="card-body">
                        <form method="POST" action="login.php">
                            <?php if (isset($_GET['error'])) { ?>
                                <p class="error"><?php echo $_GET['error']; ?></p>
                            <?php } ?>
                            <div class="mb-3">
                                <label for="uname" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="uname" name="uname" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
