<?php
$ufc_posts = simplexml_load_file("https://api.foxsports.com/v2/content/optimized-rss?partnerKey=MB0Wehpmuj2lUhuRhQaafhBjAJqaPU244mlTDK1i&size=30&tags=fs/ufc");

$ufc_posts = $ufc_posts->children()->children();

$xmlDoc = new SimpleXMLElement("<xml/>");

foreach ($ufc_posts as $ufc_post) {
    $mediaXml = $ufc_post->children(MEDIA_NAMESPACE);
    if($ufc_post->title) {
        $post = $xmlDoc->addChild("post");
        $post->addChild("title", $ufc_post->title);
        $post->addChild("description", $ufc_post->description);
        $post->addChild("published", $ufc_post->pubDate);

        foreach ($mediaXml->content->attributes() as $img => $value) {
            $post->addChild("media", $value);
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Content-type: text/xml; charset=utf-8");
    echo $xmlDoc->asXML();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

}