<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title> 
    <link rel="stylesheet" href="giohang1.css">
    <link rel="stylesheet" href="giohang2.css">
    <link rel="stylesheet" href="giohang3.css">
    <script>
        // Lấy dữ liệu từ localStorage
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        function updateCartUI() {
            const tableBody = document.querySelector("#cart-table tbody");
            const cartTotal = document.getElementById("cart-total");
            tableBody.innerHTML = "";
            let totalAmount = 0;

            cart.forEach((item, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.price.toLocaleString("vi-VN")}VND</td>
                    <td>
                        <button class="decrease" data-index="${index}">-</button>
                        ${item.quantity}
                        <button class="increase" data-index="${index}">+</button>
                    </td>
                    <td>${(item.price * item.quantity).toLocaleString("vi-VN")}VND</td>
                    <td><button class="remove" data-index="${index}">Xóa</button></td>
                `;
                tableBody.appendChild(row);
                totalAmount += item.price * item.quantity;
            });

            cartTotal.textContent = `Tổng cộng: ${totalAmount.toLocaleString("vi-VN")}VND`;
        }

        document.addEventListener("DOMContentLoaded", () => {
            updateCartUI();

            // Xử lý sự kiện trên giỏ hàng
            document.querySelector("#cart-table").addEventListener("click", e => {
                const index = e.target.dataset.index;
                if (e.target.classList.contains("increase")) {
                    cart[index].quantity++;
                } else if (e.target.classList.contains("decrease")) {
                    if (cart[index].quantity > 1) cart[index].quantity--;
                } else if (e.target.classList.contains("remove")) {
                    cart.splice(index, 1); // Xóa sản phẩm
                }
                localStorage.setItem("cart", JSON.stringify(cart));
                updateCartUI();
            });
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="logo">
                <a href="homepage.php"><img  src="cart_icon.png" alt="Logo"></a>
            </div>
        </div>
        <h1>Giỏ Hàng</h1>
        <table id="cart-table" border="1" style="width: 100%; text-align: center;">
            <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <p id="cart-total" style="font-weight: bold;"></p>
        <a href="homepage.php" style="text-decoration: none; font-size: 18px; color: blue;">Quay lại Trang Chủ</a>
    </div>
</body>
</html>
