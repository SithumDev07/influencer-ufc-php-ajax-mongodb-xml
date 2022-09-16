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
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

}