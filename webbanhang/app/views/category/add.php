<?php include 'app/shares/header.php'; ?>
<h1>Thêm danh mục mới</h1>

<?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/Category/save">
    <div class="form-group">
        <label for="name">Tên danh mục:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
    <a href="/Category/list" class="btn btn-secondary mt-2">Quay lại danh sách</a>
</form>

<?php include 'app/shares/footer.php'; ?>