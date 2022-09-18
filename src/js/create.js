$(document).ready(function () {

    document.getElementById("submitButton").addEventListener(("click", function () {
        createPost();
    }))

    function createPost() {
        $.ajax({
            url: "api/news.php",
            type: 'POST',
            success: function(xml) {
                console.log(xml)
            },
            error: function (response) {
                console.error(response)
            }
        });
    }
})