
// Khởi tạo giỏ hàng từ Local Storage (nếu chưa có thì tạo mảng rỗng)
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Lấy tất cả các nút "Add to Cart"
const addToCartButtons = document.querySelectorAll(".add-to-cart");

// Xử lý sự kiện click vào nút "Add to Cart"
addToCartButtons.forEach(button => {
    button.addEventListener("click", () => {
        const productName = button.dataset.name; // Tên sản phẩm
        const productPrice = parseFloat(button.dataset.price); // Giá sản phẩm

        // Tìm sản phẩm trong giỏ hàng
        const existingProduct = cart.find(item => item.name === productName);

        if (existingProduct) {
            // Nếu sản phẩm đã tồn tại, tăng số lượng
            existingProduct.quantity++;
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới
            cart.push({ name: productName, price: productPrice, quantity: 1 });
        }

        // Lưu giỏ hàng vào Local Storage
        localStorage.setItem("cart", JSON.stringify(cart));

        // Hiển thị thông báo
        alert(`Đã thêm ${productName} vào giỏ hàng!`);
    });
});

// Xem giỏ hàng trong console (dùng để kiểm tra)
console.log("Cart:", cart);

