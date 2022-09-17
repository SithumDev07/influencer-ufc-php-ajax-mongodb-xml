$(window).ready(function () {
    $.ajax({
        url: "api/news.php",
        type: 'GET',
        success: function(xml) {
            let data = [];
            $(xml).find('post').each(function () {
                let post = {};
                $(this).find('id').each(function () {
                    post.id = $(this).text()
                })
                $(this).find('title').each(function () {
                    post.title = $(this).text();
                })
                $(this).find('category').each(function () {
                    post.category = $(this).text();
                })
                $(this).find('imageUrl').each(function () {
                    post.image = $(this).text();
                })
                $(this).find('description').each(function () {
                    post.description = $(this).text();
                })
                data.push(post);
            })

            populatePosts(document.getElementById("postsContainer"), data);
        },
        error: function (response) {

        }
    });

    function populatePosts (element, data = []) {
        data.map((item, index) => {
            if(index == 0) {
                document.getElementById("heroBanner").style.backgroundImage = `url('${item.image}')`;
            }
            if(item.title !== "") {
                const divElement = document.createElement("button");
                divElement.setAttribute("type", "button");
                divElement.classList.add("post-button", "rounded-md", "overflow-hidden", "relative", "group", "hover:bg-black", "transition-all", "duration-300", "hover:p-5", "hover:scale-105", "cursor-pointer");
                const post = `
               <img src="${item.image}" alt="" class="mb-3 object-cover">
               <p class="absolute top-2 right-2 text-xs text-center uppercase my-1 px-2 py-1 rounded-full border border-2 border-red-500">${item.category}</p>
               <h3 class="group-hover:text-xs">${item.title}</h3>
            `;
                divElement.innerHTML = post;
                element.appendChild(divElement);
            }
        });

            [...document.querySelectorAll(".post-button")].map((item, index) => {
                console.log(data[index])
            item.addEventListener("click", function () {
                document.getElementById("modalContainer").classList.toggle("hidden")
                document.getElementById("modalContainer").classList.toggle("flex")
                openNews(document.getElementById("modalContainer"), { id: data[index].id, title: data[index].title, description: data[index].description, imageUrl: data[index].image })
            })
        })
    }

    function openNews(element, data) {
        const divElement = document.createElement("div");
        divElement.classList.add("news-modal", "w-full", "h-full", "transform", "relative", "scale-90", "bg-sport-dark", "p-10", "rounded-xl", "grid", "grid-cols-3", "overflow-hidden", "transition-all")
        const modal =  `
<!--        <div class="news-modal w-full h-full transform relative scale-90 bg-sport-dark p-10 rounded-xl grid grid-cols-3 overflow-hidden transition-all">-->
            <button type="button" id="modalCloseButton" class="absolute top-5 right-5 group hover:scale-105 duration-150 transform">
                <i class="bi bi-x-octagon-fill text-6xl text-red-500 rotate-0 hover:rotate-45 transform duration-200 transition-all"></i>
            </button>
            <div class="col-span-2 overflow-hidden">
                <img src="${data.imageUrl}" class="rounded-2xl" alt="UFC">
            </div>
            <div class="col-span-1">
                <p class="text-lg text-sport-white p-10 italic font-anton">
                ${data.description}
                </p>
            </div>
            <div class="col-span-2 col-span-3">
                <h3 class="text-4xl text-sport-white">${data.title}</h3>
            </div>`;
        divElement.innerHTML = modal
        element.innerHTML = "";
        element.appendChild(divElement);

        document.getElementById("modalCloseButton").addEventListener('click', function () {
            console.log("Closed")
            document.getElementById("modalContainer").classList.toggle("hidden")
            document.getElementById("modalContainer").classList.toggle("flex")
        })
    }
})