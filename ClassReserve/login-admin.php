<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">
        <div class="logo-icon"></div>
        <span>ClassReserve</span>
    </div>
</div>

<div class="center-container">
    <div class="card">
        <h1>Login</h1>
        <p class="subtitle">
            Silakan masuk untuk melanjutkan
        </p>
        <form action="process/process-login-admin.php" method="POST">
            <div class="input-group">
                <label>Email Admin</label>
                <input type="email"
                name="email"
                placeholder="contoh@admin.ac.id"
                required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password"
                name="password"
                placeholder="Masukkan password"
                required>
            </div>

            <button class="btn" type="submit">
                Login
            </button>
        </form>
        
        <button class="btn btn-outline"
        onclick="window.location.href='index.html'">
        Back To Home
    </button>
    </div>
</div>
</body>
</html>