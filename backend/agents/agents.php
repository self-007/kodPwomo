<?php
$datas = validateRequest() ?? []; 
//get Agents
function getAllAgents() {
    global $connection;
    $stmt = $connection->prepare("SELECT id, name, email FROM users WHERE role = 'agent'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// GET available agents
function getAvailableAgents() {
    global $connection;
    $stmt = $connection->prepare("SELECT id, name, email FROM users WHERE role = 'agent' AND is_available = 1");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//get agent by id_unique
function getAgentById($id) {
    //clean id. id is an alpha num value
    $id = sanitizeInput($id);
    global $connection;
    $stmt = $connection->prepare("SELECT id, name, email, status FROM users WHERE id_unique = :id AND role = 'agent'");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $agent = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() === 0) {
        response(['error' => 'Agent not found: ' . $id], 404);
    }
    return $agent;
}
//get agent availability
function getAgentAvailability($id) {
    $agent = getAgentById($id);
    if(isset($agent) && $agent['status'] == 'active'){
       response(['is_available' => true], 200);
    }
    response(['is_available' => false], 200);
}
// modify agent availability
function setAgentAvailability() {
    global $datas;
    //verify if data exist or empty
    if(!isset($datas['id']) || !isset($datas['status'])){
        response(['donnees manquantes'], 404);
    }

    //clean id. id is an alpha num value
    $agentId = sanitizeInput($datas['id']);
    $isAvailable = sanitizeInput($datas['status']);
    call_user_func_array('getAgentById', [$agentId]); // Check if agent exists
    $isAvailable = $isAvailable !== 'active' ? 'inactive' : 'active';
    global $connection;
    $stmt = $connection->prepare("UPDATE users SET status = :is_available WHERE id_unique = :id AND role = 'agent'");
    $stmt->bindParam(':is_available', $isAvailable);
    $stmt->bindParam(':id', $agentId);
    if ($stmt->execute()) {
        response(['message' => 'Agent availability updated successfully to ' . $isAvailable, 'success' => true], 200);
    } else {
        response(['error' => 'Failed to update agent availability'], 500);
    }
}
//get tops agents by university id
function getTopAgents($universityId, $limit = 5) {
    //id_unique, email, name, completed_deliveries_count, last_delivery_date, avg_note
    global $connection;
    $stmt = $connection->prepare("
        SELECT u.id_unique, u.email, u.name, COUNT(d.id) as completed_deliveries_count, MAX(d.date) as last_delivery_date, AVG(d.note) as avg_note
        FROM users u
        JOIN deliveries d ON u.id_unique = d.id_agent
        JOIN orders o ON d.id_commande = o.order_id
        JOIN salle s ON o.adresse_id = s.id
        WHERE s.id_university = :university_id
        GROUP BY u.id_unique
        ORDER BY completed_deliveries_count DESC
        LIMIT :limit
    ");
    $stmt->bindParam(':university_id', $universityId, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'agents' => []];
    }
    $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'agents' => $agents];
}

//top global agents
function getTopGlobalAgents($limit = 5) {
    //id_unique, email, name, completed_deliveries_count, last_delivery_date, avg_note
    global $connection;
    $stmt = $connection->prepare("
        SELECT u.id_unique, u.email, u.name, COUNT(d.id) as completed_deliveries_count, MAX(d.date) as last_delivery_date, AVG(d.note) as avg_note,
        SUM(d.delivery_price) as total_earned
        FROM users u
        JOIN deliveries d ON u.id_unique = d.id_agent
        JOIN orders o ON d.id_commande = o.order_id
        GROUP BY u.id_unique
        ORDER BY completed_deliveries_count DESC
        LIMIT :limit
    ");
    
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'agents' => []];
    }
    $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'agents' => $agents];
}