<!DOCTYPE html>
<html>  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel= "stylesheet" href="dashe.css">
    <style>

    </style>
</head>
<body>
    <div class="container">
        <div class="app-container">
            <div class="sidebar">
                <div class="sidebar-header">
                    <div class="app-icon">
                        <h1 class="white"><img src="logoo.png" alt=""style="width: 30px; height: 42px; margin-top: 10px;">  Note<span class="green">IT</span></h1>
                    </div>
                </div>
            </div>
            <!-- Search Section -->
            <div class="col-md-4 border-right">
                <div class="card">
                    <div class="card-header" id="addNoteHeader">
                        <div class="add-note-wrapper">
                            <label for="search">Search</label>
                            <input type="text" id="search" name="search" oninput="handleSearch()">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Notes Section -->
            <div class="note-container">
                <div class="card">
                    <div class="card-header1">Notes</div>
                    <div class="card-body">
                        <div class="data-item">
                            <ul class="list-group">
                                <?php
                                include('query/conn.php');
                                $stmt = $conn->prepare("SELECT * FROM `tbl_notes`");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach ($result as $row) {
                                    $noteID = $row['tbl_notes_id'];
                                    $noteTitle = $row['note_title'];
                                    $noteContent = $row['note'];
                                    $noteDateTime = $row['date_time'];
                                    // Convert the date_time value to a formatted date and time string
                                    $formattedDateTime = date('F j, Y H:i A', strtotime($noteDateTime));
                                ?>
                                <li class="list-group-item1">
                                    <div class="view"></div>
                                    <div>
                                        <h3 style="text-transform: uppercase;"><?php echo htmlspecialchars($noteTitle); ?></h3>
                                    </div>
                                    <div>
                                     
                                    </div>
                                    <div class="note-details">
                                        <div class="action"></div>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Section -->
    <script>
        // Handle Search Functionality
        function handleSearch() {
            var searchInput = document.getElementById('search').value.trim();
            if (searchInput !== '') {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var searchResults = JSON.parse(this.responseText);
                        renderSearchResults(searchResults);
                    }
                };
                xhttp.open("GET", "search_note.php?search=" + encodeURIComponent(searchInput), true);
                xhttp.send();
            } else {
                // Clear search results if search input is empty
                renderSearchResults([]);
            }
        }

        // Render Search Results
        function renderSearchResults(results) {
            var listGroup = document.querySelector('.list-group');
            // Clear existing search results
            listGroup.innerHTML = '';
            // Render new search results
            results.forEach(function(note) {
                var listItem = document.createElement('li');
                listItem.classList.add('list-group-item1');
                var title = document.createElement('h3');
                title.style.textTransform = "uppercase";
                title.textContent = note.note_title;
                var content = document.createElement('p');
                content.textContent = note.note;
                var details = document.createElement('small');
                details.classList.add('block', 'text-muted', 'text-info');
                details.innerHTML = 'Created: <i class="fa fa-clock-o"></i> ' + note.date_time;
                var action = document.createElement('div');
                action.classList.add('action');
                listItem.appendChild(title);
                listItem.appendChild(content);
                listItem.appendChild(details);
                listItem.appendChild(action);
                listGroup.appendChild(listItem);
            });
        }
    </script>
</body>
</html>
