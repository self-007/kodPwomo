<?php
//create university
function createUniversity() {
    global $datas;
    $name = $datas['name'] ?? '';
    $location = $datas['zone'] ?? '';
    
    // Validate input
    if (empty($name) || empty($location)) {
        response(['error' => 'Name and location are required'], 400);
    }        
    $name = sanitizeInput($name);
    $location = sanitizeInput($location);
    global $connection;
    if(!isset($_FILES['image_file']) || $_FILES['image_file']['error'] !== 0){
       response(['error' => 'University image is required'], 400);
    }

    $image = handleProductImageUpload($_FILES['image_file']);
    $stmt = $connection->prepare("INSERT INTO university (name, Zone, image) VALUES (:name, :location, :image)");
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
function updateUniversity($id) {
    global $datas;
    

    if (!isset($datas['name'] ) || !isset($datas['zone'])) {
        response(['error' => ' and location are required', $datas], 400);
    } 
    $name = $datas['name'];
    $location = $datas['zone'];
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    // Validate input
    if (empty($name) || empty($location)) {
        response(['error' => 'Name and location are required'.$datas], 400);
    }        
    $name = sanitizeInput($name);
    $location = sanitizeInput($location);

    global $connection;
    $stmt = $connection->prepare("UPDATE university SET name = :name, Zone = :location WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'university mise a jour avec success'], 200);
    } else {
        response(['error' => 'Failed to update university'], 500);
    }
}

//update image
function update_image_uvs($id){
    global $datas;
    if (intval($id) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    if(!isset($_FILES['image_file']) || $_FILES['image_file']['error'] !== 0){
         response(['error' => 'University image is required'], 400);
    } 
    $image = handleProductImageUpload($_FILES['image_file']);
    global $connection;
    $stmt = $connection->prepare("UPDATE university SET image = :image WHERE id = :id");
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'University image updated successfully'], 200);
    } else {
        response(['error' => 'Failed to update university image'], 500);
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

//all universities response all unoversities 
function All_universities(){
    $university = getAllUniversities()['universities'];
    response($university, 200);
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
