<!DOCTYPE html>
<html>
<head>
    <title>Login Mahasiswa</title>
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
        <form action="process/process-login.php" method="POST">
            <div class="input-group">
                <label>Email Student</label>
                <input type="email"
                name="email"
                placeholder="contoh@student.ac.id"
                required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password"name="password"
                placeholder="Masukkan password"
                required>
            </div>
            
            <button class="btn" type="submit">
                Login
            </button>
        </form>
        
        <button class="btn btn-outline" onclick="window.location.href='index.html'">
            Back To Home
        </button>
        
        <div class="link">
            Belum punya akun?
            <a href="register.php">
                Register di sini
            </a>
        </div>
    </div>
</div>
</body>
</html>