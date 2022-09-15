$(window).ready(function () {
    $.ajax({
        url: "api/news.php",
        type: 'GET',
        success: function(xml) {
            $(xml).find('members').each(function () {
                $(this).find('name').each(function () {
                    const name = $(this).text();
                    console.log(name)
                    document.getElementById("name").innerHTML = name;
                })
            })
        }
    });
})