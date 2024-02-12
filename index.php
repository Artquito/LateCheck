<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Citra Kasih Late Checker</h1>
    <form>
        <label for="search">Search for Students</label>
        <input type="text" name="search" id="search" placeholder="search student">
        <button>Search</button>
    </form>
    <ul id="suggestionList">

    </ul>


    <h3>Late List</h3>
    <ul id="lateList">
        <button id="lateSubmitBtn">submit</button>
    </ul>

    <script>
        let searchTerm = document.getElementById("search")
        let suggestionList = document.getElementById("suggestionList")
        let lateCard =document.getElementById("lateList")
        const lateList = []
        let timeoutId

        function addToLateList(lateData) {
            lateList.push(lateData)
            // console.log(lateList);
        }

        function displayLateList() {
            lateCard.innerHTML = "";
            // console.log(lateList);
            lateList.forEach(student => {
                // console.log(student.fullName);
                const listedStudent = document.createElement("li")
                listedStudent.textContent = student.fullName

                lateCard.insertBefore(listedStudent, lateCard.firstChild)
            });
        }

        // addToLateList({ fullName: "sandi", userId: 1 })

        function fetchSuggestions(searchTerm) {

            let xhr = new XMLHttpRequest();
            let url = "http://localhost/includes/searchUsers.php"; // Adjust the path as needed
            let params = `searchTerm=${searchTerm}` // Your POST data

            xhr.open("POST", url, true)

            // Set the content type of the request
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response from the server
                    console.log(JSON.parse(xhr.responseText))
                    displaySuggestions(JSON.parse(xhr.responseText))
                }
            };

            // Send the POST request with the data
            xhr.send(params);
        }

        function clearSuggestion() {
            // Clear existing suggestions
            suggestionList.innerHTML = "";
        }

        function displaySuggestions(suggestions) {

            clearSuggestion()

            suggestions.forEach(suggestion => {
                // Create a list item element
                const listItem = document.createElement("li")
                // Set the text content of the list item to the suggestion
                listItem.textContent = suggestion.fullName
                listItem.style.paddingBottom = "10px";

                // Create a button element
                const button = document.createElement("button")
                button.textContent = "Add Student"
                // Add click event listener to the button
                button.addEventListener("click", function () {
                    // Log the ID of the person
                    // console.log("ID:", suggestion.userId)
                    addToLateList(suggestion)
                    displayLateList();
                });
                button.style.marginLeft = "10px"; // Adjust the margin as needed

                // Append the button to the list item
                listItem.appendChild(button)

                // Append the list item to the suggestion list container
                suggestionList.appendChild(listItem)
            });
        }

        function handleSearchInput() {
            // Clear previous timeout if exists
            clearTimeout(timeoutId);

            if (this.value.trim() !== "") { // Check if input is not empty or just whitespace
                // Set a new timeout to wait for a brief delay
                timeoutId = setTimeout(function () {
                    // Function to execute after the delay
                    fetchSuggestions(this.value);
                }.bind(this), 400); // Adjust the delay time (in milliseconds) as needed
            }
        }


        searchTerm.addEventListener("focusout", function () {
            timeoutId = setTimeout(function () {
                // Function to execute after the delay
                clearSuggestion()
            }.bind(this), 400);

        })
        searchTerm.addEventListener("input", handleSearchInput)
        searchTerm.addEventListener("focus", handleSearchInput)

    </script>
</body>

</html>