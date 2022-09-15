<?php

require "database.php";

$postsCollection = $db->selectCollection("posts");
const MEDIA_NAMESPACE = "http://search.yahoo.com/mrss/";

$posts = simplexml_load_file("https://api.foxsports.com/v2/content/optimized-rss?partnerKey=MB0Wehpmuj2lUhuRhQaafhBjAJqaPU244mlTDK1i&size=30&tags=fs/ufc",null, LIBXML_NOBLANKS);

$posts = $posts->children()->children();

foreach ($posts as $post) {
    $mediaContent = $post->children(MEDIA_NAMESPACE);
    if($post->guid) {
        $postsArray = [
            "title" => "" . $post->title,
            "category" => "" . $post->category,
            "description" => "". $post->description,
            "published" => "" . $post->pubDate,
            "imageUrl" => "" . $mediaContent->content->attributes()->{'url'}
        ];

        $postsCollection->insertOne($postsArray);
    }
}
