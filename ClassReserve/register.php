<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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

<h1>Register</h1>

<p class="subtitle">
Buat akun baru untuk mulai menggunakan ClassReserve
</p>

<form action="process/process-register.php" method="POST">

<div class="input-group">
<label>Nama Lengkap</label>
<input type="text"
name="name"
placeholder="Masukkan nama lengkap"
required>
</div>

<div class="input-group">
<label>Email Student</label>
<input type="email"
name="email"
placeholder="contoh@student.ac.id"
required>
</div>

<div class="input-group">
<label>Password</label>
<input type="password"
name="password"
placeholder="Masukkan password"
required>
</div>

<div class="input-group">
<label>Konfirmasi Password</label>
<input type="password"
name="confirm"
placeholder="Konfirmasi password"
required>
</div>

<button class="btn" type="submit">
Register
</button>

</form>

<div class="link">
Sudah punya akun?
<a href="login-student.php">
Login di sini
</a>
</div>

</div>

</div>

</body>
</html>