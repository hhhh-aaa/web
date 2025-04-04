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
                        <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="Product Image" style="max-height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <img src="/images/no-image.png" class="card-img-top" alt="Không có ảnh" style="max-height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/Product/show/<?php echo $product->id; ?>" class="text-dark">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>
                        <p class="card-text"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="card-text"><strong>Giá:</strong> <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>
                        <p class="card-text"><strong>Danh mục:</strong> <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="d-flex justify-content-between">
                            <?php if (SessionHelper::isAdmin()): ?>
                                <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm fw-bold text-white rounded-pill transition-all hover-btn">
                                    <i class="fas fa-edit me-1"></i> Sửa
                                </a>
                                <a href="/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger btn-sm fw-bold rounded-pill transition-all hover-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    <i class="fas fa-trash me-1"></i> Xóa
                                </a>
                            <?php endif; ?>
                            <a href="/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary btn-sm fw-bold rounded-pill transition-all hover-btn">
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