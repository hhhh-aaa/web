<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #6c757d;
        }

        .navbar {
            background: linear-gradient(90deg, #6c757d, #7366FF);
            /* Gradient background */
        }

        .navbar .nav-link {
            color: white;
            /* Link color */
        }

        .navbar .navbar-brand {
            color: white;
            /* Brand color */
        }

        .navbar .nav-link:hover {
            color: #ffcc00;
            /* Hover color */
        }

        .navbar-toggler {
            border-color: white;
            /* Toggler border color */
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            /* White toggler icon */
        }

        .product-image {
            max-width: 100px;
            height: auto;
        }

        .promo-banner {
            background-color: #FF6CAB;
            /* Banner background color */
            color: white;
            /* Text color */
            padding: 10px 0;
            /* Padding for the banner */
            text-align: center;
            /* Center the text */
            border: 2px solid #FF3B6A;
            /* Border color and thickness */
            border-radius: 5px;
            /* Rounded corners */
            margin: 20px 0;
            /* Margin for spacing */
        }

        footer {
            background-color: #f8f9fa;
            /* Light footer background */
            color: #343a40;
            /* Dark text color */
        }

        .navbar-brand img {
            width: 150px;
            /* Thay đổi kích thước logo tại đây */
            height: auto;
            /* Giữ tỷ lệ khung hình */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
            <img src="/images/8.png" alt="Logo"> Lavilev
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/Product/">Danh sách sản phẩm</a>
                </li>
                <?php if (SessionHelper::isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/Product/add">Thêm sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Category/list">Danh sách danh mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Category/add">Thêm danh mục</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="/Product/cart">
                        <i class="fas fa-shopping-cart"></i> Giỏ hàng
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                    require_once 'app/helpers/SessionHelper.php';
                    if (SessionHelper::isLoggedIn()) {
                        echo "<a class='nav-link'>" . $_SESSION['username'] . "</a>";
                    } else {
                        echo "<a class='nav-link' href='/account/login'>Login</a>";
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    if (SessionHelper::isLoggedIn()) {
                        echo "<a class='nav-link' href='/account/logout'>Logout</a>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        function logout() {
            localStorage.removeItem('jwtToken');
            location.href = '/account/login';
        }
        document.addEventListener("DOMContentLoaded", function () {
            const token = localStorage.getItem('jwtToken');
            if (token) {
                document.getElementById('nav-login').style.display = 'none';
                document.getElementById('nav-logout').style.display = 'block';
            } else {
                document.getElementById('nav-login').style.display = 'block';
                document.getElementById('nav-logout').style.display = 'none';
            }
        });
    </script>
    <div class="container mt-4"></div>

    <!-- Promotional Banner -->
    <?php
    if ($_SERVER['REQUEST_URI'] === '/Product/'): ?>
        <div class="promo-banner">
            <h2>Khuyến mãi đặc biệt!</h2>
            <p>Giảm giá 20% cho tất cả sản phẩm trong tháng này!</p>
        </div>
    <?php endif; ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>