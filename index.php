<?php

require "config.php";

$db = $DBClient->selectDatabase("influencer");

$postsCollection = $db->selectCollection("posts");

$posts = simplexml_load_file("https://api.foxsports.com/v2/content/optimized-rss?partnerKey=MB0Wehpmuj2lUhuRhQaafhBjAJqaPU244mlTDK1i&size=30&tags=fs/ufc");

$posts = $posts->children()->children();

foreach ($posts as $post) {
    if($post->title) {
        $postsArray = [
            "title" => "" . $post->title,
            "description" => "". $post->description
        ];

//        $postsCollection->insertOne($postsArray);
    }
}

include("pages/home.html");
