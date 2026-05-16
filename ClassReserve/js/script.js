function goTo(page) {
    window.location.href = page;
}

function loginStudent() {
    const email = document.getElementById("studentEmail").value;
    const password = document.getElementById("studentPassword").value;

    if(email === "") {
        alert("Email harus diisi");
        return false;
    }
     if(!validateEmail(email)) {
        alert("Format email tidak valid");
        return false;
    }

    if(password.length < 6) {
        alert("Password minimal 6 karakter");
        return false;
    }

    alert("Login berhasil");
    window.location.href = "dashboard.html";
}

function loginAdmin() {
    const email = document.getElementById("adminEmail").value;
    const password = document.getElementById("adminPassword").value;

    if(email === "admin@admin.ac.id" && password === "admin123") {
        alert("Login admin berhasil");
    } else {
        alert("Email atau password salah");
    }
}
function registerUser() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirm = document.getElementById("confirm").value;

    if(name === "") {
        alert("Nama harus diisi");
        return false;
    }

    if(password !== confirm) {
        alert("Password tidak cocok");
        return false;
    }

    alert("Registrasi berhasil");
    window.location.href = "verification.html";
}
function verifyOTP() {
    alert("Verifikasi berhasil");
    window.location.href = "login-student.html";
}

function logout() {
    alert("Logout berhasil");
    window.location.href = "index.html";
}

function validateEmail(email) {
    return email.includes("@");
}

function checkPassword(password) {
    return password.length >= 6;
}

function verifyCode(code) {
    return code.length === 6;
}
function submitPeminjaman() {

    const kegiatan = document.getElementById("kegiatan").value;
    const tanggal = document.getElementById("tanggal").value;

    if(kegiatan === "") {
        alert("Nama kegiatan harus diisi");
        return false;
    }

    if(tanggal === "") {
        alert("Tanggal harus diisi");
        return false;
    }

    alert("Pengajuan peminjaman berhasil dikirim");
}

function approve() {
    alert("Pengajuan diterima");
}

function reject() {
    alert("Pengajuan ditolak");
}