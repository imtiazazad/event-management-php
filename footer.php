    <footer style="background-color: black; color: white; padding: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Left-side footer content -->
                <h4>Contact Us</h4>
                <p>Email: example@example.com</p>
                <p>Phone: +123 456 7890</p>
            </div>
            <div class="col-md-6 text-right">
                <!-- Right-side footer content -->
                <h4>Follow Us</h4>
                <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Simulate the loading process (remove setTimeout in your actual code)
    setTimeout(function () {
        document.getElementById("preloader").style.display = "none";
        document.querySelector(".content").style.display = "block";
    }, 1000); // Adjust the timeout duration as needed
});
// search button
function performSearch() {
            // Get the search input value
            var searchQuery = document.getElementById("searchInput").value;

            // Check if a query is provided
            if (searchQuery) {
                // Build the URL with the query parameter
                var searchURL = 'search.php?query=' + searchQuery;

                // Redirect to the search results page
                window.location.href = searchURL;
            }else{
                alert("Search input is empty")
            }
        }
    </script>
    <!-- Include Bootstrap JS scripts here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




</body>
</html>