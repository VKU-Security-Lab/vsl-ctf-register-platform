<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Admin - Internal VSL CTF 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/flatly/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin-styles.css">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Roboto', sans-serif;
        }

        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 40px;
            background: #fff;
            max-width: 450px;
            width: 100%;
            position: relative;
        }

        .login-card img.logo {
            width: 120px;
            margin-bottom: 20px;
        }

        .btn-login {
            background: #f0ad4e;
            border: none;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #ec971f;
        }

        /* Loading Spinner */
        .spinner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            display: none;
            z-index: 10;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                padding: 30px;
            }

            .login-card img.logo {
                width: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="spinner-overlay" id="spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Đang tải...</span>
                </div>
            </div>
            <div class="text-center">
                <img src="assets/images/logo.png" alt="Logo" class="logo">
                <h3 class="mt-3 mb-4">Đăng Nhập Admin</h3>
            </div>
            <div id="alert-container"></div>
            <form id="loginForm">
                <div class="mb-4">
                    <label for="username" class="form-label"><i class="fas fa-user me-2"></i>Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập username"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>Mật Khẩu</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-login w-100"><i class="fas fa-sign-in-alt me-2"></i>Đăng
                    Nhập</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/admin-scripts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginForm = document.getElementById('loginForm');
            const alertContainer = document.getElementById('alert-container');
            const spinner = document.getElementById('spinner');
            loginForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const username = document.getElementById('username').value.trim();
                const password = document.getElementById('password').value.trim();
                if (username === '' || password === '') {
                    showAlert('Vui lòng nhập đầy đủ thông tin.', 'danger');
                    return;
                }
                spinner.style.display = 'flex';
                fetch('login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ username, password })
                })
                    .then(response => response.json())
                    .then(data => {
                        spinner.style.display = 'none';
                        if (data.success) {
                            window.location.href = 'admin-dashboard.php';
                        } else {
                            showAlert(data.message, 'danger');
                        }
                    })
                    .catch(error => {
                        spinner.style.display = 'none';
                        showAlert('Đã xảy ra lỗi. Vui lòng thử lại sau.', 'danger');
                        console.error('Error:', error);
                    });
            });

            // Hàm để hiển thị thông báo
            function showAlert(message, type) {
                alertContainer.innerHTML = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            }
        });
    </script>
</body>

</html>