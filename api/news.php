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
    $post = [
        "title" => "" . $_POST['news_title'],
        "category" => "" . $_POST['news_category'],
        "description" => "". $_POST['news_description'],
        "published" => "" . $_POST['news_published'],
        "imageUrl" => "" . $_POST['news_imageurl']
    ];

    $postsCollection->insertOne($post);

    header("./pages/home.html", true, 201);
    exit();
}