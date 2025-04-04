<?php include 'app/shares/header.php'; ?>
<div class="container mt-4">
    <h1 class="text-center">Danh sách sản phẩm</h1>
    <?php if (SessionHelper::isAdmin()): ?>
        <a href="/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới</a>
    <?php endif; ?>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <?php if ($product->image): ?>
                        <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top"
                            alt="Product Image" style="max-height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <img src="/images/no-image.png" class="card-img-top" alt="Không có ảnh"
                            style="max-height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/Product/show/<?php echo $product->id; ?>" class="text-dark">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <p class="card-text"><strong>Giá:</strong>
                            <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>
                        <p class="card-text"><strong>Danh mục:</strong>
                            <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <div class="d-flex justify-content-between">
                            <?php if (SessionHelper::isAdmin()): ?>
                                <a href="/Product/edit/<?php echo $product->id; ?>"
                                    class="btn btn-warning btn-sm fw-bold text-white rounded-pill transition-all hover-btn">
                                    <i class="fas fa-edit me-1"></i> Sửa
                                </a>
                                <a href="/Product/delete/<?php echo $product->id; ?>"
                                    class="btn btn-danger btn-sm fw-bold rounded-pill transition-all hover-btn"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    <i class="fas fa-trash me-1"></i> Xóa
                                </a>
                            <?php endif; ?>
                            <a href="/Product/addToCart/<?php echo $product->id; ?>"
                                class="btn btn-primary btn-sm fw-bold rounded-pill transition-all hover-btn">
                                <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'app/shares/footer.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const token = localStorage.getItem('jwtToken');
        if (!token) {
            alert('Vui lòng đăng nhập');
            location.href = '/account/login'; // Điều hướng đến trang đăng nhập
            return;
        }
        fetch('/api/product', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            }
        })
            .then(response => response.json())
            .then(data => {
                const productList = document.getElementById('product-list');
                data.forEach(product => {
                    const productItem = document.createElement('li');
                    productItem.className = 'list-group-item';
                    productItem.innerHTML = `
<h2><a

href="/Product/show/${product.id}">${product.name}</a></h2>

<p>${product.description}</p>
<p>Giá: ${product.price} VND</p>
<p>Danh mục: ${product.category_name}</p>

<a href="/Product/edit/${product.id}" class="btn btn-
warning">Sửa</a>

<button class="btn btn-danger"
onclick="deleteProduct(${product.id})">Xóa</button>

`;
                    productList.appendChild(productItem);
                });
            });
    });
    function deleteProduct(id) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
            fetch(`/api/Product/${id}`, {
                method: 'DELETE'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Product deleted successfully') {
                        location.reload();
                    } else {
                        alert('Xóa sản phẩm thất bại');
                    }
                });
        }
    }
</script>