<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEase | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #6f42c1, #0d6efd);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            max-width: 450px;
            width: 100%;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="card login-card p-4">
        <div class="card-body text-center">
            <!-- Logo -->
            <img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" class="brand-logo" alt="logo">
            <h3 class="fw-bold mb-4">ShopEase</h3>

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3 justify-content-center" id="loginTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab">User Login</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab">Admin Login</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="loginTabsContent">

                <!-- User Login -->
                <div class="tab-pane fade show active" id="user" role="tabpanel">
                    <form>
                        <div class="mb-3 text-start">
                            <label for="userEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="userEmail" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="userPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="userPassword" placeholder="Enter your password" required>
                        </div>
                        <div class="text-end mb-3">
                            <a href="#" class="small">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login as User</button>
                    </form>
                    <!-- First Time User Link -->
                    <p class="mt-3 mb-0">First time user? <a href="user-register.html">Sign Up</a></p>
                </div>

                <!-- Admin Login -->
                <div class="tab-pane fade" id="admin" role="tabpanel">
                    <form>
                        <div class="mb-3 text-start">
                            <label for="adminUsername" class="form-label">Admin Username</label>
                            <input type="text" class="form-control" id="adminUsername" placeholder="Enter admin username" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="adminPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="adminPassword" placeholder="Enter your password" required>
                        </div>
                        <div class="text-end mb-3">
                            <a href="#" class="small">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Login as Admin</button>
                    </form>
                    <!-- First Time Admin Link -->
                    <p class="mt-3 mb-0">First time admin? <a href="admin-register.html">Create Account</a></p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>