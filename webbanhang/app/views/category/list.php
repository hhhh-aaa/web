<?php include 'app/shares/header.php'; ?>
<h1>Danh sách danh mục</h1>
<a href="/Category/add" class="btn btn-primary mb-3">Thêm danh mục</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category->id; ?></td>
                <td><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <a href="/Category/edit/<?php echo $category->id; ?>" class="btn btn-warning">Sửa</a>
                    <a href="/Category/delete/<?php echo $category->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'app/shares/footer.php'; ?>