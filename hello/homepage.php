<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.wrapper {
			width: 1000px;
			height: auto;
			margin: auto;
		}

		.header {
			height: 55px;
			margin: auto;
			border: 1px solid black;
		}

		.logo {
			float: left;
			width: 150px;
			padding: 10px
		}

		#form_search {
			margin-top: 10px;

		}

		#form_search input[type=text] {
			width: 250px;
			height: 30px
		}

		#form_search input[type=submit] {
			height: 30px
		}

		.login {
			float: right;
			right: 30px;
			height: 35px;
			line-height: 35px;
			color: gray;
			position: relative;
			display: inline;
		}

		.login a {
			text-decoration: none;

		}

		.register {
			float: right;
			margin-right: 50px;
			height: 35px;
			line-height: 35px;
			color: gray;
		}

		.register a {
			text-decoration: none;

		}

		.menu {
			width: 100% height: 30px;
			background: pink;
			border: 1px solid black
		}

		.menu ul li {
			list-style: none;
			text-align: center;
			display: inline-table;
		}

		.menu ul li a {
			text-decoration: none;
			font-size: 16px;
			margin: 30px;
			padding: 5px;
			text-transform: uppercase;
		}

		.content {
			width: 100%;
			border: 1px solid black
		}

		.left {
			width: 20%;
			background: gray;

			float: left;
		}

		.right {
			width: 80%;

			float: right;
		}

		.footer {
			width: 1000px;
			height: 100px;
			background: #f0f0f0;
			clear: both;
		}

		.left>p {
			background: white;
			color: black;
			font-size: 22px;
			font-family: arial;
			padding: 10px;
			text-align: center;
		}

		.category ul {
			width: 100%;
			height: auto;
		}

		.category ul li {
			list-style: none;

		}

		.category ul li a {
			color: white;
			padding: 8px;
			margin: 5px;
			text-align: center;
			font-size: 20px;
			text-decoration: none;
			font-family: Comic Sans Ms;
		}

		.category a:hover {
			text-decoration: underline;
		}

		.brand ul {
			width: 100%;
			height: auto;
			list-style: none;
		}

		.brand ul li {
			list-style: none;

		}

		.brand a:hover {
			text-decoration: underline;
		}

		.brand ul li a {
			color: white;
			padding: 8px;
			margin: 5px;
			text-align: center;
			font-size: 20px;
			text-decoration: none;
			font-family: Comic Sans Ms;
		}

		.products_box {
			width: 780px;
			text-align: center;
			margin-left: 30px;
			margin-bottom: 10px;
		}

		.single_product {
			float: left;
			margin-left: 30px;
			padding: 10px;
		}

		.single_product img {
			border: 2px solid black;
		}
	</style>
	<script>
        function addToCart(id, name, price) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            const existingProductIndex = cart.findIndex(item => item.id === id);

            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity++;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            alert("Đã thêm sản phẩm vào giỏ hàng!");
        }
    </script>
	
</head>
<body>
<div class="wrapper">
		<div class="header">
			<div class="logo">
			<img src="logo.jpg" alt="Logo" style="height: 40px; vertical-align: middle;"> Phone Store</h1>
			</div>
			<!--/.header_logo-->
			<div id="form_search">
				<form method="get" action="" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a Product" />
					<input type="submit" name="search" value="Search" />
				</form>
			</div>
		</div>
		<!-- end header -->
		<div class="menu">
			<ul>
				<li> <a href="boong.html">Sản phẩm trưng bày </a></li>
				<li><a href="add_product.php"> Thêm sản phẩm </a> </li>
				<li><a href="giohang.php"> Giỏ hàng </a></li>
			</ul>
		</div>
			<div class="right">
				<p style="text-align: left;font-size: 20px"> Tất cả sản phẩm </p>
				<div class="products_box">
					<!--Truy vấn từ cơ sở dữ liệu -->
	        <?php
			
   //B1: Kết nối
			$connect = mysqli_connect('localhost', 'root', '', 'se06303_web');
			if (!$connect) {
				echo "Kết nối thất bại";
			} else {
				echo"";
			}
			//B2: Viết câu truy vấn
			$sql = "SELECT * FROM products";
			//B3: Thực thi truy vấn
			$result = mysqli_query($connect,$sql);
			//Đưa kết quả vào mảng liên kết
			
			
			while($row_product =mysqli_fetch_array($result)){
				//Hiển thị lần lượt từng sản phẩm
				$product_id = $row_product['product_id'];
				$product_name = $row_product['product_name'];
				$product_price = $row_product['product_price'];
				$product_img = $row_product['product_img'];
				echo"
				<div class='single_product'>
				<h3>$product_name</h3>
				<img src='uploads/products/$product_img' width='180' height='180' />
				
                    <p>Giá: " . number_format($product_price, 0, ',', '.') . " VND</p>
                    <button onclick='addToCart($product_id, \"$product_name\", $product_price)'>Thêm vào giỏ hàng</button>
				</a>          
		
				</div>       
				";

			}
			
			
            ?>
				</div>

			</div>
		</div>
	</div>
	<div class="footer">
		<p> Đây là footer </p>
	</div>
</div>
</body>

</html>