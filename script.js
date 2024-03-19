// JavaScript to handle tab switching
document.getElementById("home-tab").addEventListener("click", function () {
    loadPage("index.php");
});

document.getElementById("shop-tab").addEventListener("click", function () {
    loadPage("shop.html");
});

document.getElementById("profile-tab").addEventListener("click", function () {
    loadPage("profile.html");
});

function loadPage(page) {
    // You can use AJAX or fetch to load the content of the page dynamically
    // For simplicity, let's assume the content is directly loaded into the .content div
    document.querySelector(".content").innerHTML = "Loading...";
    
    // Simulate loading delay (remove this in a real-world scenario)
    setTimeout(function () {
        fetch(page)
            .then(response => response.text())
            .then(data => {
                document.querySelector(".content").innerHTML = data;
            })
            .catch(error => {
                console.error("Error loading page:", error);
                document.querySelector(".content").innerHTML = "Error loading page.";
            });
    }, 1000);
}
