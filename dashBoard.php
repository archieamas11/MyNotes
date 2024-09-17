<?php
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

include 'query/conn.php';

$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM table_user WHERE id = :id");
$stmt->bindParam(':id', $userID);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['user_full_name'] = isset($userData['name']) ? $userData['name'] : 'Guests';

?>
  <?php
// Function to truncate text to a specified length
function truncateText($text, $length) {
    if (strlen($text) > $length) {
        $truncatedText = substr($text, 0, $length) . '...';
    } else {
        $truncatedText = $text;
    }
    return $truncatedText;
}
?>



<!DOCTYPE html>
<html>  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel= "stylesheet" href="dashess.css">
   <style>

    </style>
</head>
<body>
<div class="container">
        
   
    <div id="myModalAdd" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModalAdd()">&times;</span>
        <div id="addNoteFormContainer ">
            <!-- Add Note form will be populated here -->
            <form id="" method="post" action="query/add_note.php">
                <div class="form-group">
                    <label for="noteTitle">Title</label>
                    <input type="text" class="form-control" id="noteTitle" name="note_title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="note">Description</label>
                    <textarea class="form-control" id="note" name="note_content" rows="10" placeholder="Description"></textarea>
                </div>
                <button type="submit">Add Note</button>
            </form>
        </div>
    </div>
</div>
<div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="noteDetails"></div>
        </div>
    </div>



    <input type="checkbox" id="check">
    <label for="check"></label>
    <div id="updateNoteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateNoteModal()">&times;</span>
        <div id="updateNoteFormContainer">
            <!-- Update Note form will be populated here -->
        </div>
    </div>
</div>
<div class="app-container">
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="app-icon">
      <h1 class="white"><img src="logoo.png" alt=""style="width: 30px; height: 42px; margin-top: 10px;">  Note<span class="green">IT</span></h1>
    
      </div>
    </div>
    <ul class="sidebar-list">
    <li class="sidebar-list-item">
    <a href="dashBoard.php">
        <img src="note.png" alt="Note icon">
        <span>All Notes</span>
    </a>
</li>
      <li class="sidebar-list-item active">
        <a href="favorite_page.php">
        <img src="favorite.png" alt="Note icon">
          <span>Favorite  </span>
        </a>
      <li class="sidebar-list-item">
        <a href="archive_page.php">
        <img src="archive.png" alt="Note icon">
          <span>Archive</span>
        </a>
      </li>
      <!-- <li class="sidebar-list-item">
        <a href="dashboardNotes.php">   
        <img src="archive.png" alt="Note icon">
          <span>sample</span>
        </a>
      </li> -->
      <li class="sidebar-list-item">
        <a href="home.php">
        <img src="logout.png" alt="Note icon">
          <span>Logout</span>
        </a>
      </li>
    </ul>
    <div class="account-info">
    <div class="account-info-picture">
        <img src="https://images.unsplash.com/photo-1527736947477-2790e28f3443?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTE2fHx3b21hbnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" alt="Account">
    </div>
    <div class="account-info-name"><?php echo isset($_SESSION['user_full_name']) ? $_SESSION['user_full_name'] : 'Guest'; ?></div>
    <button class="account-info-more">
    </button>
    </div>
  </div>

    <div class="">
            <!-- Add Note -->
            <div class="col-md-4 border-right">
                <div class="card">
                <div class="card-header" id="addNoteHeader">
    <div class="add-note-wrapper">
        <img src="add.png" alt="Add Note Image" class="add-note-image"> 
        <button onclick="toggleAddNoteForm()" id="addNoteButton">Create Note</button>
       
    </div>
    <div class="add-note-wrapper">
   <label for="search">Search</label>
   <input type="text" id="search" name="search" oninput="handleSearch()">
</div>
<div class="" id="addNoteForm" style="display: none;">
    <!-- <form method="post" action="query/add_note.php"> -->
        <!-- <div class="form-group"> 
        </div>  
        <div class="form-group">
        </div> -->

        
    <!-- </form> -->
</div>
</div>
                </div>
            </div>
            <!--  Update and Delete Notes -->
            <div class="note-container">
                <div class="card">
                    <div class="card-header1">
                       Notes
                        <!-- <a href="all_notes.php">View All Notes</a> -->
                    </div>

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
                               
                            <div class="list-group-item1"> 
                                <div class= "view">
                                    <a href="#" onclick="openViewNoteModal(<?php echo $noteID; ?>)" title="View"><i class="fas fa-eye"></i></a>
                            </div>
                            <div class="">
                                    <h3 style="text-transform: uppercase;"><?php echo htmlspecialchars($noteTitle); ?></h3>
                                    </div>
                                    <div>
        <p class="note-content">
            <?php echo truncateText($noteContent, 100); ?></p>
    </div>
    <div class="note-details">
        <small class="block text-muted text-info">Created: <i class="fa fa-clock-"></i> <?php echo htmlspecialchars($formattedDateTime); ?></small>
    
        <div class="action">
    <?php
            // Check if the note is favorited
            $isFavorite = $row['is_favorite'];

            // Determine the class based on whether the note is favorited or not
            $favoriteClass = $isFavorite ? 'fas fa-heart favorited' : 'far fa-heart';
            ?>
            <!-- Output the favorite button icon with the determined class -->
            <button onclick="favoriteNote(<?php echo $noteID; ?>)" title="Favorite"><i class="<?php echo $favoriteClass; ?>"></i></button>
        <button onclick="archiveNote(<?php echo $noteID; ?>)" title="Archive"><i class="fas fa-archive"></i></button>
        <!-- <button onclick="favoriteNote(<?php echo $noteID; ?>)" title="Favorite"><i class="fas fa-heart"></i></button> -->
        <button type="button" onclick="openUpdateNoteModal(<?php echo $noteID; ?>, '<?php echo addslashes($noteTitle); ?>', '<?php echo addslashes($noteContent); ?>')" title="Edit"><i class="fas fa-edit"></i></button>
    </div>
    </div>
</div>
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
        </div>
    </div>

    </div>
  

    <script>
     
     
     function toggleAddNoteForm() {
    var addNoteForm = document.getElementById('addNoteForm');
    if (addNoteForm.style.display === 'none') {
        addNoteForm.style.display = 'block';
    } else {
        addNoteForm.style.display = 'none';
    }
    openModalAdd(); // Move this line outside of the if block
}



function openModalAdd() {
    document.getElementById('myModalAdd').style.display = "block";
}

function closeModalAdd() {
    document.getElementById('myModalAdd').style.display = "none";
}

    
function openModal() {
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }

        function openViewNoteModal(noteId) {
            // AJAX request to get note details
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Insert the note details into the modal
                    document.getElementById("noteDetails").innerHTML = this.responseText;
                    // Open the modal
                    openModal();
                }
            };
            xhttp.open("GET", "view_note.php?view=" + noteId, true);
            xhttp.send();
        }

        // Add event listeners to "View" buttons
        var viewNoteBtns = document.querySelectorAll(".view-note-btn");
        viewNoteBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                var noteId = this.getAttribute("data-note-id");
                openViewNoteModal(noteId);
            });
        });
        var updateNoteModal = document.getElementById('updateNoteModal');

// Get the <span> element that closes the modal
var closeUpdateNoteSpan = document.getElementsByClassName("close")[0];

function openUpdateNoteModal(noteID, noteTitle, noteContent) {
    // Populate the update note form with note details
    document.getElementById('updateNoteFormContainer').innerHTML = `
        <form id="updateNoteForm" method="post" action="query/update_note_process.php">
            <input type="hidden" name="note_id" value="${noteID}">
            <div class="form-group">
                <label for="noteTitle">Title</label>
                <input type="text" class="form-control" id="noteTitle" name="note_title" value="${noteTitle}">
            </div>
            <div class="form-group">
                <label for="noteContent">Note</label>
                <textarea class="form-control" id="noteContent" name="note_content" rows="10">${noteContent}</textarea>
            </div>
            <button type="submit">Update</button>
        </form>
    `;

    // Display the update note modal
    document.getElementById('updateNoteModal').style.display = 'block';
}

// Function to close the update note modal
function closeUpdateNoteModal() {
    document.getElementById('updateNoteModal').style.display = 'none';
}
function archiveNote(noteID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // Handle successful response
                console.log("Note archived successfully");
                // Remove the archived note from the dashboard page
                var noteElement = document.getElementById('note_' + noteID);
                if (noteElement) {
                    noteElement.parentNode.removeChild(noteElement);
                }
                // Display success message
                alert("Note archived successfully");
            } else {
                // Handle error
                console.error("Error archiving note");
                // Display error message
                alert("Error archiving note");
            }
        }
    };
    xhttp.open("GET", "archive_note.php?note_id=" + noteID, true);
    xhttp.send();
}




function favoriteNote(noteID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // Handle successful response
                console.log("Note favorited successfully");
                // Display success message
                alert("Note favorited successfully");
            } else {
                // Handle error
                console.error("Error favoriting note");
                // Display error message
                alert("Error favoriting note");
            }
        }
    };
    xhttp.open("GET", "favorite_note.php?note_id=" + noteID, true);
    xhttp.send();
}

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

function truncateText(text, length) {
    if (text.length > length) {
        return text.substring(0, length) + '...';
    } else {
        return text;
    }
}

function renderSearchResults(results) {
    var listGroup = document.querySelector('.list-group');
    // Clear existing search results
    listGroup.innerHTML = '';
    // Render new search results
    results.forEach(function(note) {
        var listItem = document.createElement('li');
        listItem.classList.add('list-group-item2'); // Apply the same class as regular notes
        var title = document.createElement('h3');
        title.style.textTransform = "uppercase";
        title.textContent = note.note_title;
        var content = document.createElement('p');
        content.textContent = truncateText(note.note, 100); // Truncate the note content
        var details = document.createElement('small');
        details.classList.add('block', 'text-muted', 'text-info');
        details.innerHTML = 'Created: <i class="fa fa-clock-o"></i> ' + note.date_time;
        var action = document.createElement('div');
        action.classList.add('action');

        var viewIcon = document.createElement('i');
        viewIcon.classList.add('fas', 'fa-eye');
        viewIcon.addEventListener('click', function() {
            // Pass the note ID directly to the function
            openViewNoteModal(note.note_id);
        });

        var favoriteIcon = document.createElement('i');
        favoriteIcon.classList.add('fas', 'fa-heart');
        favoriteIcon.addEventListener('click', function() {
            favoriteNote(note.note_id);
        });

        var archiveIcon = document.createElement('i');
        archiveIcon.classList.add('fas', 'fa-archive');
        archiveIcon.addEventListener('click', function() {
            archiveNote(note.note_id);
        });

        var editIcon = document.createElement('i');
        editIcon.classList.add('fas', 'fa-edit');
        editIcon.addEventListener('click', function() {
            openUpdateNoteModal(note.note_id, note.note_title, note.note);
        });

        action.appendChild(viewIcon);
        action.appendChild(favoriteIcon);
        action.appendChild(archiveIcon);
        action.appendChild(editIcon);

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
