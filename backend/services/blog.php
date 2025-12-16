<?php
//we can creat , unallow and read
//create new blogs data.
function newBlogData(){
    global $datas, $connection;
    // get the user id 
    $user = getBearerToken();
    $user_id = $user->sub;
    if(!isset($datas['category']) || !isset($datas['message']) || !isset($datas['title'])){
        response(['error' => 'veuillez remplir correctement tout les champs'], 400);
    }
    if(!isset($datas['image'])){
        $image ='';
    }else {
        $image = sanitizeInput($datas['image']);
    }
    $category = sanitizeInput($datas['category']);//actualites, ameliorations, guides, avis, top:agent/client
    $message = sanitizeInput($datas['message']);
    if($category === 'avis'){
        if(!isset($datas['rating'])){

            response(['error' => 'Veuillez fournir une note pour les avis'], 400);
        }
        $rating = intval($datas['rating']);
        if($rating < 1 || $rating > 5){
            response(['error' => 'La note doit être comprise entre 1 et 5'], 400);
        }
            
    }else {
        $rating = 0; // default value for non-avis categories
    }
    $title = sanitizeInput($datas['title']);
    $user_id = sanitizeInput($user_id);
    //add datas t0 the blog

    $stmt = $connection->prepare("INSERT INTO blog (title, category, message, user_id, image, rating) Values (:title, :category, :message, :user_id, :image, :rating)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':rating', $rating);
    $stmt->execute();
    response(['status' => 'success', 'message' => 'Blog post created successfully']);
}
// getALL blog data 
function getAllBlogData(){
    //get everything from the blog
    global $connection;
    $stmt = $connection->prepare('SELECT b.id, b.category, b.message,b.date, b.title, u.name, b.rating FROM blog b LEFT JOIN users u on b.user_id = u.id_unique ORDER BY date DESC');// need to make a join with usesrs
    $stmt->execute();
    $blogDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    response(['status' => 'success', 'blogDatas' => $blogDatas]);
}