<?php
//create university
function createUniversity() {
    global $datas;
    $name = $datas['name'] ?? '';
    $location = $datas['location'] ?? '';
    
    // Validate input
    if (empty($name) || empty($location)) {
        response(['error' => 'Name and location are required'], 400);
    }        
    $name = sanitizeInput($name);
    $location = sanitizeInput($location);
    global $connection;
    if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0){
       response(['error' => 'University image is required'], 400);
    }

    $image = handleProductImageUpload($_FILES['image']);
    $stmt = $connection->prepare("INSERT INTO university (name, location, image) VALUES (:name, :location, :image)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':image', $image);
    if ($stmt->execute()) {
        response(['success' => 'university cree avec success'], 200);
    } else {
        response(['error' => 'Failed to create university'], 500);
    }
}

//modify university
function updateUniversity() {
    global $datas;
    $id = $datas['id'] ?? 0;
    $name = $datas['name'] ?? '';
    $location = $datas['location'] ?? '';
    $image = '';

    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    // Validate input
    if (empty($name) || empty($location)) {
        response(['error' => 'Name and location are required'], 400);
    }        
    $name = sanitizeInput($name);
    $location = sanitizeInput($location);
    if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0){
        $university = getUniversityById($id);
        $image = $university['image'];
    } else {
        $image = handleProductImageUpload($_FILES['image']);
    }
    global $connection;
    $stmt = $connection->prepare("UPDATE university SET name = :name, location = :location, image = :image WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'university mise a jour avec success'], 200);
    } else {
        response(['error' => 'Failed to update university'], 500);
    }
}

//delete university
function deleteUniversity($id) {
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("DELETE FROM university WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        return ['message' => 'University deleted successfully'];
    } else {
        response(['error' => 'Failed to delete university'], 500);
    }
}

// get all universities
function getAllUniversities() {
    global $connection;
    $stmt = $connection->prepare("SELECT u.*, 
    (SELECT COUNT(*) FROM salle s WHERE s.id_university = u.id) AS places_count,
    (SELECT COUNT(*) FROM products p WHERE p.id_university = u.id) AS products_count, 
     (SELECT COUNT(*) FROM deliveries d 
        JOIN orders o ON d.id_commande = o.order_id
        JOIN salle s ON o.adresse_id = s.id
        WHERE s.id_university = u.id) AS deliveries_count
    FROM university u ORDER BY deliveries_count DESC");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'universities' => []];
    }
    $universities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'universities' => $universities];

}

// get university by id
function getUniversityById($id) {
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM university WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $university = $stmt->fetch(PDO::FETCH_ASSOC);
    return $university;
}
