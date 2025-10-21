<?php
// create place name by university id
function createPlace() {
    global $datas;
    // verify int value or superior to 0
    if (intval($datas['universityId']) <= 0 || empty($datas['placeName'])) {
        response(['error' => 'Invalid university ID or place name'], 400);
    }
    $placeName = sanitizeInput($datas['placeName']);
    $universityId = intval($datas['universityId']);

    $sql = '';
    if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0){
        $sql = "INSERT INTO salle (university_id, salle_name) VALUES (:university_id, :place_name)";
    }
    $imagePath = handleProductImageUpload($_FILES['image']);
    global $connection;
    if($sql !== ''){
        $stmt = $connection->prepare($sql);
    } else {
        $stmt = $connection->prepare("INSERT INTO salle (university_id, salle_name, image_path) VALUES (:university_id, :place_name, :image_path)");
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

//modify salle
function modifyPlace(){
    global $datas;
    // verify int value or superior to 0
    if (intval($datas['universityId']) <= 0 || empty($datas['placeName']) || intval($datas['id'] <= 0)) {
        response(['error' => 'Invalid university ID or place name'], 400);
    }
    $placeName = sanitizeInput($datas['placeName']);
    $id = intval($datas['id']);
    $universityId = intval($datas['universityId']);
    $sql = '';
    if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0){
        $sql = "UPDATE salle SET university_id = :university_id, salle_name = :place_name WHERE id = :id";
    }
    $imagePath = handleProductImageUpload($_FILES['image']);
    global $connection;
    if($sql !== ''){
        $stmt = $connection->prepare($sql);
    } else {
        $stmt = $connection->prepare("UPDATE salle SET university_id = :university_id, salle_name = :place_name, image_path = :image_path WHERE id = :id");
        $stmt->bindParam(':image_path', $imagePath);
    }
   
    $stmt->bindParam(':university_id', $universityId);
    $stmt->bindParam(':place_name', $placeName);
    
    if ($stmt->execute()) {
        response(['success' => 'place modifiee avec success'], 200);
    } else {
        response(['error' => 'Failed to modify place'], 500);
    }
}
//
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
    $stmt = $connection->prepare("SELECT id, salle_name FROM salle WHERE id_university = :university_id");
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