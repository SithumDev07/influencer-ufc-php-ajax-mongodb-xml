$(window).ready(function () {
    $.ajax({
        url: "api/news.php",
        type: 'GET',
        success: function(xml) {
            let data = [];
            $(xml).find('post').each(function () {
                let post = {};
                $(this).find('title').each(function () {
                    post.title = $(this).text();
                })
                $(this).find('category').each(function () {
                    post.category = $(this).text();
                })
                $(this).find('imageUrl').each(function () {
                    post.image = $(this).text();
                })
                data.push(post);
            })

            populatePosts(document.getElementById("postsContainer"), data);
        },
        error: function (response) {

        }
    });

    function populatePosts (element, data = []) {
        data.map((item) => {
            if(item.title !== "") {
                const divElement = document.createElement("div");
                divElement.classList.add("rounded-md", "overflow-hidden", "pb-3");
                const post = `
               <img src="${item.image}" alt="" class="mb-3 object-cover">
               <p class="text-center my-1 px-2 py-1 rounded border border-2 border-red-500">${item.category}</p>
               <h3>${item.title}</h3>
               <div class="flex justify-end">
                <a href="#">View</a>
               </div>
            `;
                divElement.innerHTML = post;
                element.appendChild(divElement);
            }
        })
    }
})