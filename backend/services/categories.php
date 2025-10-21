<?php

//create category
function createCategory() {
    global $datas;
    // Validate input
    if (!isset($datas['name'])) {
        response(['error' => 'Name is required'], 400);
    }        
    $name = sanitizeInput($datas['name']);
    if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0){
        response(['error' => 'Name is required'], 400);
    }
    $imagePath = handleProductImageUpload($_FILES['image']);
    global $connection;
    $stmt = $connection->prepare("INSERT INTO category (name, image_path) VALUES (:name, :image_path)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':image_path', $imagePath);
    if ($stmt->execute()) {
        response(['success' => 'category cree avec success'], 200);
    } else {
        response(['error' => 'Failed to create category'], 500);
    }
}

// update category
function updateCategory() {
    global $datas;
    // verify int value or superior to 0
    if (intval($datas['id']) <= 0) {
        response(['error' => 'Invalid category ID'], 400);
    }
    // Validate input
    if (!isset($datas['name'])) {
        response(['error' => 'Name is required'], 400);
    }        
    $name = sanitizeInput($datas['name']);
    $sql = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
        $imagePath = handleProductImageUpload($_FILES['image']);
        $sql = "UPDATE categories SET name = :name, image_path = :image_path WHERE id = :id";
    }
    $stmt = "UPDATE category SET name = :name, WHERE id = :id";
    global $connection;
    if($sql == ''){
        $stmt = $connection->prepare($stmt);
    } else {
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':image_path', $imagePath);
    }
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'categorie modifiee avec success'], 200);
    } else {
        response(['error' => 'Failed to update category'], 500);
    }
}
//delete category
function deleteCategory($id) {
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid category ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("DELETE FROM categories WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        return ['message' => 'Category deleted successfully'];
    } else {
        response(['error' => 'Failed to delete category'], 500);
    }
}
// get category by id
function getCategoryById($id) {
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid category ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM category WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// get all categories
function getAllCategories() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM category");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}