<?php include 'app/shares/header.php'; ?>
<h1>Giỏ hàng</h1>
<?php if (!empty($cart)): ?>
    <ul class="list-group" id="cart-items">
        <?php foreach ($cart as $id => $item): ?>
            <li class="list-group-item" data-id="<?php echo $id; ?>">
                <h2><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h2>

                <?php if ($item['image']): ?>
                    <img src="/<?php echo $item['image']; ?>" alt="ProductImage" style="max-width: 100px;">
                <?php endif; ?>

                <p>Giá: <span class="price"><?php echo number_format($item['price'], 0, ',', '.'); ?></span> VND</p>

                <p>
                    Số lượng: 
                    <button class="btn btn-secondary btn-sm decrease" data-id="<?php echo $id; ?>">-</button>
                    <input type="number" class="form-control quantity" value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>" data-id="<?php echo $id; ?>" style="width: 60px; display: inline-block;">
                    <button class="btn btn-secondary btn-sm increase" data-id="<?php echo $id; ?>">+</button>
                </p>
                <p>Tổng: <span class="total" data-id="<?php echo $id; ?>"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></span> VND</p>
            </li>
        <?php endforeach; ?>
    </ul>
    <h3>Tổng tiền giỏ hàng: <span id="total-price">0 VND</span></h3>
<?php else: ?>
    <p>Giỏ hàng của bạn đang trống.</p>
<?php endif; ?>
<a href="/" class="btn btn-secondary mt-2">Tiếp tục mua sắm</a>
<a href="/Product/checkout" class="btn btn-secondary mt-2">Thanh Toán</a>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    function updateTotal() {
        let total = 0;
        $('.total').each(function() {
            total += parseFloat($(this).text().replace(' VND', '').replace('.', '').replace('.', ''));
        });
        $('#total-price').text(total.toLocaleString() + ' VND');
    }

    $('.increase').click(function() {
        const id = $(this).data('id');
        const quantityInput = $('.quantity[data-id="' + id + '"]');
        let quantity = parseInt(quantityInput.val());
        quantity++;
        quantityInput.val(quantity);

        const price = parseFloat($('.price').eq($(this).closest('li').index()).text().replace(' VND', '').replace('.', '').replace('.', ''));
        const total = price * quantity;
        $('.total[data-id="' + id + '"]').text(total.toLocaleString() + ' VND');

        updateTotal();
    });

    $('.decrease').click(function() {
        const id = $(this).data('id');
        const quantityInput = $('.quantity[data-id="' + id + '"]');
        let quantity = parseInt(quantityInput.val());
        if (quantity > 1) {
            quantity--;
            quantityInput.val(quantity);

            const price = parseFloat($('.price').eq($(this).closest('li').index()).text().replace(' VND', '').replace('.', '').replace('.', ''));
            const total = price * quantity;
            $('.total[data-id="' + id + '"]').text(total.toLocaleString() + ' VND');

            updateTotal();
        }
    });

    // Tính tổng tiền ban đầu
    updateTotal();
});
</script>

<?php include 'app/shares/footer.php'; ?>