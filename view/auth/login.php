<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
<?php if (!empty($errors)): ?>
<?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <ul>
                    <li><?php echo $error; ?></li>
            </ul>
        </div>
    <?php endif; ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <form method="POST" action="/register/plogin">
                        <div class="mb-3">
                            <label for="login" class="form-label">login</label>
                            <input type="text" class="form-control" id="login" name="login" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Jnujsl5+z8WwSQLwkZf3p6Oz5f5uK50X5QNDf5cl5g5aaP" crossorigin="anonymous"></script>
</body>
</html>
