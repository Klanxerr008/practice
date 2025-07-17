<?php
$con = mysqli_connect("localhost", "fresh", "fresh", "db_fresh", 3307);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Products</title>
    <style>
        body {
            font-family: sans-serif;
        }

        header {
            position: sticky;
            top: 0;
            display: flex;
            justify-content: space-between;
            height: 5rem;
            border-radius: 5px;
            background-color: white;
            border-bottom: 2px solid rgb(144, 248, 144);
            padding: 5px;
        }

        .navigation {
            display: flex;
            align-items: center;
            list-style: none;
            gap: 5rem;
            padding-right: 20px;
        }

        .navigation li a {
            text-decoration: none;
            color: green;
        }

        footer {
            border-radius: 3px;
            height: 2rem;
            padding: 20px;
            text-align: center;
            background-color: rgb(144, 248, 144);
            color: black;
        }

        .section,
        .section2 {
            display: flex;
            justify-content: center;
            margin-top: 5rem;
            gap: 5rem;
            flex-wrap: wrap;
        }

        .card {
            width: 16rem;
            border: 1px solid black;
            padding: 30px;
            border-radius: 5px;
            text-align: center;
        }

        button {
            margin-top: 10px;
            background-color: rgb(144, 248, 144);
            border: none;
            border-radius: 5px;
            height: 3rem;
            width: 16rem;
            cursor: pointer;
        }

        .card button:hover {
            background-color: aqua;
        }

        /* Modal Styles */
        #productModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            position: relative;
            text-align: center;
        }

        .modal-content img {
            object-fit: cover;
            width: 100%;
            height: 150px;
            border-radius: 5px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <div>
            <img src="https://dcassetcdn.com/design_img/2701189/611628/611628_14686488_2701189_922c785a_image.png" height="80px" width="80px">
        </div>
        <div class="navigation">
            <li><a href="index.php">Home</a></li>
            <li><a href="">Cart</a></li>
        </div>
    </header>

    <!-- Section 1 -->
    <div class="section">
        <?php
        $query1 = "SELECT * FROM tbl_products LIMIT 3";
        $result1 = mysqli_query($con, $query1);
        while ($row = mysqli_fetch_assoc($result1)) {
            echo '
            <div class="card">
                <div><img src="' . $row["image"] . '" height="150px" width="250px"></div>
                <h2>' . $row["product_name"] . '</h2>
                <p>₱' . $row["price"] . ' per ' . $row["unit_type"] . '</p>
                <p>Fresh and organic!</p>
                <button>Add to Cart</button>
                <button onclick="openModal(\'' . $row["image"] . '\')">View</button>
            </div>';
        }
        ?>
    </div>

    <!-- Section 2 -->
    <div class="section2">
        <?php
        $query2 = "SELECT * FROM tbl_products LIMIT 3 OFFSET 3";
        $result2 = mysqli_query($con, $query2);
        while ($row = mysqli_fetch_assoc($result2)) {
            echo '
            <div class="card">
                <div><img src="' . $row["image"] . '" height="150px" width="250px"></div>
                <h2>' . $row["product_name"] . '</h2>
                <p>₱' . $row["price"] . ' per ' . $row["unit_type"] . '</p>
                <p>Fresh and organic!</p>
                <button>Add to Cart</button>
                <button onclick="openModal(\'' . $row["image"] . '\')">View</button>
            </div>';
        }
        ?>
    </div>

 
    <div id="productModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Product Image">
            <p style="font-style: italic;">Fresh and organic!</p>
        </div>
    </div>

    <footer>
        ALL RIGHTS (Klenz 2025 practice)
    </footer>

    <script>
        function openModal(image) {

            document.getElementById('modalImage').src = image;
            document.getElementById('productModal').style.display = "flex";
        }

        function closeModal() {
            document.getElementById('productModal').style.display = "none";
        }

        window.onclick = function(event) {
            const modal = document.getElementById('productModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>
