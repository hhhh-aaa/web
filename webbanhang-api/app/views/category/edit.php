<?php include 'app/shares/header.php'; ?>
<h1>Sửa danh mục</h1>

<?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/Category/update">
    <input type="hidden" name="id" value="<?php echo $category->id; ?>">
    <div class="form-group">
        <label for="name">Tên danh mục:</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    <a href="/Category/list" class="btn btn-secondary mt-2">Quay lại danh sách</a>
</form>

<?php include 'app/shares/footer.php'; ?>