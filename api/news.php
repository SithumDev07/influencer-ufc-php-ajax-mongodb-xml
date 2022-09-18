<?php

require "../database.php";
$postsCollection = $db->selectCollection("posts");


if($_SERVER["REQUEST_METHOD"] == "GET") {
    header('content-type: text/xml');
    $postData = $postsCollection->find();
    $root = new SimpleXMLElement("<root />");
    foreach ($postData as $doc) {
        $json = MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP($doc));
        $json = json_decode($json, true);

        $post = $root->addChild("post");
        $post->addChild('title', $json['title']);
        $post->addChild('description', $json['description']);
        $post->addChild("category", $json["category"]);
        $post->addChild('published', $json["published"]);
        $post->addChild("imageUrl", $json["imageUrl"]);
    }
    echo $root->asXML();
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SERVER["QUERY_STRING"])) {
    echo "You are getting the post with id " . $_SERVER["id"];
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

//    $title = $_POST["title"];
//    $category = $_POST["category"];
//    $description = $_POST["description"];
//    $published = $_POST["published"];
//    $imageUrl = $_POST["imageUrl"];
//
//    $newEntry = [
//        "title" => "" . $title,
//        "category" => "" . $category,
//        "description" => "" . $description,
//        "published" => "" . $published,
//        "imageUrl" => "" . $imageUrl
//    ];
//
//    $postsCollection->insertOne($newEntry);
//
//    print_r($newEntry);

    $postData = file_get_contents('php://input');

    $xml = simplexml_load_string($postData);

//    $xml = $xml->children();

    var_dump($xml);

//    print_r($xml);
}