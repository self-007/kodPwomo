<?php
// create place name by university id
function createPlace($idUniversity){
    global $datas;
    // verify int value or superior to 0
    if (intval($idUniversity) <= 0 || empty($datas['name'])) {
        response(['error' => 'Invalid university ID or place name'], 400);
    }
    $placeName = sanitizeInput($datas['name']);
    $universityId = intval($idUniversity);

    $sql = '';
    if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0){
        $sql = "INSERT INTO salle (university_id, salle_name) VALUES (:university_id, :place_name)";
    }
    $imagePath = handleProductImageUpload($_FILES['image']);
    global $connection;
    if($sql !== ''){
        $stmt = $connection->prepare($sql);
    } else {
        $stmt = $connection->prepare("INSERT INTO salle (id_university, salle_name, image) VALUES (:university_id, :place_name, :image_path)");
        $stmt->bindParam(':image_path', $imagePath);
    }
   
    $stmt->bindParam(':university_id', $universityId);
    $stmt->bindParam(':place_name', $placeName);
    
    if ($stmt->execute()) {
        response(['success' => 'place cree avec success'], 200);
    } else {
        response(['error' => 'Failed to create place'], 500);
    }
}

// PUT: update place name only (JSON)
function modifyPlace($id){
    global $datas;
    if (empty($datas['name'])) {
        response(['error' => 'Invalid place name', $datas], 400);
    }
    if(intval($id) <= 0 ){
        response(['error' => 'Invalid  id'], 400);
    }
    $placeName = sanitizeInput($datas['name']);
    $id = intval($id);
    global $connection;
    $stmt = $connection->prepare("UPDATE salle SET salle_name = :place_name WHERE id = :id");
    $stmt->bindParam(':place_name', $placeName);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'place modifiee avec success'], 200);
    } else {
        response(['error' => 'Failed to modify place'], 500);
    }
}

// POST: update place image only (FormData)
function updatePlaceImage($id){
    if(intval($id) <= 0 ){
        response(['error' => 'Invalid id'], 400);
    }
    if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0){
        response(['error' => 'Image is required'], 400);
    }
    $imagePath = handleProductImageUpload($_FILES['image']);
    global $connection;
    $stmt = $connection->prepare("UPDATE salle SET image = :image_path WHERE id = :id");
    $stmt->bindParam(':image_path', $imagePath);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'Image modifiée avec succès'], 200);
    } else {
        response(['error' => 'Failed to update image'], 500);
    }
}

//delete places
function deletePlaces(){
    global $datas;
    if(!isset($datas['id'])){
        response(['error' => 'Invalid place ID'], 400);
    }
    $id = intval($datas['id']);
    $stmt = $connection->prepare("DELETE FROM salle WHERE id = :id");
    $stmt->execute(['id' => $id]);
    response(['success' => 'place suprimee avec success']);
}
// get places by university id
function getPlacesByUniversityId($universityId) {
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("SELECT id, salle_name, image FROM salle WHERE id_university = :university_id");
    $stmt->bindParam(':university_id', $universityId);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        response(['places' => []]);
    }
    $places = $stmt->fetchAll(PDO::FETCH_ASSOC);
    response(['places' => $places]);
    
}
// get all places
function getAllPlaces() {
    global $connection;
    $stmt = $connection->prepare("SELECT id, salle_name, id_university FROM salle");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'places' => []];
    }
    $places = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'places' => $places];
}