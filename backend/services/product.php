<?php
// get all products
// get allmproducts
function getAllProducts() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() === 0) {
        response(['error' => 'No products found'], 404);
    }
    $total = $stmt->rowCount();
    return ['products' => $products, 'total' => $total];
}
// get product by university id
function getProductByUniversityId($universityId) {
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM products WHERE id_university = :university_id");
    $stmt->bindParam(':university_id', $universityId);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() === 0) {
        response(['error' => 'No products found for this university ID'], 404);
    }
    response($datas, 200);
}
//return product by id_university
function returnProductByIdUniversity($id) {
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid product ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM products WHERE id_university = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() === 0) {
        response(['error' => 'Product not found'], 404);
    }
    $nbrs = $stmt->rowCount();
    return [$product, 'total' => $nbrs];
}

// update product // need a correction
function updateProduct() {
    global $datas;
    if(!isset($datas['id']) || !isset($datas['name']) || !isset($datas['description']) || !isset($datas['price']) || !isset($datas['category_id'])){
        response(['error' => 'Missing data'], 400);
    }
    // verify int value or superior to 0
    if (intval($datas['id']) <= 0 || intval($datas['category_id']) <= 0) {
        response(['error' => 'Invalid product ID or category ID'], 400);
    }
    // Validate input
    if (empty($datas['name']) || empty($datas['description']) || empty($datas['price']) || empty($datas['category_id'])) {
        response(['error' => 'Name, description, price, and category ID are required'], 400);
    }
    $sql = "";
    //for image
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
        $imagePath = handleProductImageUpload($_FILES['image']);
        $sql = "UPDATE products SET name = :name, description = :description, prices = :price, category_id = :category_id, picture = :image_path WHERE id = :id";
    } 
    $id = intval($datas['id']);
    $name = sanitizeInput($datas['name']);
    $description = sanitizeInput($datas['description']);
    $price = floatval($datas['price']);
    $categoryId = intval($datas['category_id']);
    global $connection;
    $stmt = "UPDATE products SET name = :name, description = :description, prices = :price, id_category = :category_id WHERE id = :id";
    if(!empty($sql)){
        $stmt = $connection->prepare($sql);
    } else {
        $stmt = $connection->prepare($stmt);
    }
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category_id', $categoryId);
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
        $stmt->bindParam(':image_path', $imagePath);
    }
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'Product updated successfully'], 200);
    } else {
        response(['error' => 'Failed to update product'], 500);
    }
}

// set product available or unavalaible
function setProductAvailability() {
    global $datas;
    if(!isset($datas['id']) || !isset($datas['is_available'])){
        response(['error' => 'Missing data'], 400);
    }
    // verify int value or superior to 0
    if (intval($datas['id']) <= 0 || !isset($datas['is_available'])) {
        response(['error' => 'Invalid product ID or availability status'], 400);
    }
    $id = intval($datas['id']);
    $isAvailable = sanitizeInput($datas['is_available']);
    $isAvailable = $isAvailable ? 1 : 0;
    global $connection;
    $stmt = $connection->prepare("UPDATE products SET is_available = :is_available WHERE id = :id");
    $stmt->bindParam(':is_available', $isAvailable);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'Product availability updated successfully'], 200);
    } else {
        response(['error' => 'Failed to update product availability'], 500);
    }
}

// create product  // need a correction
function createProduct() {
    global $datas;
    if(!isset($datas['name']) || !isset($datas['description']) || !isset($datas['price']) || !isset($datas['university_id']) || !isset($datas['category_id']) || !isset($datas['is_available'])){
         response(['error' => 'Missing data: ' . json_encode($datas)], 400);
    }
    // Validate input
    if (empty($datas['name']) || empty($datas['description']) || empty($datas['price']) || empty($datas['university_id']) || empty($datas['category_id']) || empty($datas['is_available'])) {
        response(['error' => 'Name, description, price, university ID, and category ID are required'], 400);
    }
    //for image 
    if(!isset($_FILES['image']) && $_FILES['image']['error'] !== 0){
        response(['error' => 'Image is required'], 400);
    } 
    $categoryId = intval($datas['category_id']);
    if($categoryId <= 0){
        response(['error' => 'Invalid category ID'], 400);
    }
    $isAvailable = $datas['is_available'] == 1 ? 1 : 0;
    $imagePath = handleProductImageUpload($_FILES['image']);
    $name = sanitizeInput($datas['name']);
    $description = sanitizeInput($datas['description']);
    $price = floatval($datas['price']);
    $universityId = intval($datas['university_id']);
    global $connection;
    $stmt = $connection->prepare("INSERT INTO products (name, description, prices, id_university, picture, id_category, is_available) VALUES (:name, :description, :price, :university_id, :image_path, :id_category, :is_available)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':university_id', $universityId);
    $stmt->bindParam(':image_path', $imagePath);
    $stmt->bindParam(':id_category', $categoryId);
    $stmt->bindParam(':is_available', $isAvailable);
    if ($stmt->execute()) {
        response(['success' => 'Product created successfully'], 201);
    } else {
        response(['error' => 'Failed to create product'], 500);
    }
}

//delete product
function deleteProduct(){
    global $datas;
    if(!isset($datas['id'])){
        response(['error' => 'missing datas'], 400);
    }
    $id = intval($datas['id']);
    $stmt = 'DELETE FROM products WHERE id = :id ';
    $stmt = $connection->prepare($stmt);
    $stmt->execute(['id' => $id]);

}
