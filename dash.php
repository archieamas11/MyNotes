

<?php
include('query/conn.php');

// Fetch all notes from the database
$stmt = $conn->prepare("SELECT * FROM `tbl_notes`");
$stmt->execute();
$allNotes = $stmt->fetchAll();

// Check if user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM table_user WHERE id = :id");
$stmt->bindParam(':id', $userID);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['user_full_name'] = isset($userData['name']) ? $userData['name'] : 'Guest';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="dash.css">
    <style>
       .note-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .note {
        width: calc(50% - 10px); /* Adjust as needed */
        margin: 5px;
        padding: 10px;
        border: 1px solid #ccc;
    }

    .right-note {
    /* Styles for notes on the right side */
    margin-left: 120px; Adjust margin as needed
}


    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between; /* Adjust as needed */
    }
    </style>
</head>
<body>
<div class="container">
    
            <!-- Add Note -->
            <div class="col-md-4 border-right">
                <div class="card">
                <div class="card-header" id="addNoteHeader">
    <div class="add-note-wrapper">
        <img src="add.png" alt="Add Note Image" class="add-note-image"> 
        <button onclick="toggleAddNoteForm()" id="addNoteButton">Create Note</button>
       
    </div>
    <div>
  <label for="search">Search</label>
  <input type="text" id="search" name="search">
</div>
<div class="card-body" id="addNoteForm" style="display: none;">
    <form method="post" action="query/add_note.php">
        <div class="form-group">
            <label for="noteTitle">Title</label>
            <input type="text" class="form-control" id="noteTitle" name="note_title" placeholder="Title">
            <small id="emailHelp" class="form-text text-muted"></small>
        </div>  
        <div class="form-group">
            <label for="note">Description</label>
            <textarea class="form-control" id="note" name="note_content" rows="10"placeholder="Description"></textarea>
        </div>
        <button type="submit">Add Note</button>
    </form>
</div>
</div>
<div class="container">
    <!-- Display favorite notes on the left side -->
    <div class="note-container">
        <!-- Add PHP loop here to display favorite notes -->
        <!-- Example: -->
        <!-- <?php foreach ($favoriteNotes as $note): ?> -->
            <div class="note">
                <!-- Note content -->
            </div>
        <!-- <?php endforeach; ?> -->
    </div>
    <div class="">
                <div class="card">
                    <div class="card-header1">
                       All Notes
                        <!-- <a href="all_notes.php">View All Notes</a> -->
                    </div>
   <!-- Display all notes on the right side -->
<div class="note-container right-note">
    <?php if (!empty($allNotes)): ?>
        <?php foreach ($allNotes as $note): ?>
            <div class="note">
                <h3 style="text-transform: uppercase;"><?php echo $note['note_title']; ?></h3>
                <p class="note-content"><?php echo $note['note']; ?></p>
                <small class="block text-muted text-info">Created: <i class="fa fa-clock-o"></i> <?php echo date('F j, Y H:i A', strtotime($note['date_time'])); ?></small>
                <div class="action-icons">
                    <div class="btn-group float-right">
                        <a href="#" onclick="openViewNoteModal('<?php echo $note['tbl_notes_id']; ?>')" title="View"><i class="fas fa-eye"></i></a>
                        <button type="button" onclick="openUpdateNoteModal('<?php echo $note['tbl_notes_id']; ?>', '<?php echo addslashes($note['note_title']); ?>', '<?php echo addslashes($note['note']); ?>')" title="Edit"><i class="fas fa-edit"></i></button>
                        <button onclick="delete_note('<?php echo $note['tbl_notes_id']; ?>')" type="button" title="Remove"><i class="fas fa-trash"></i></button>
                        <!-- You can optionally add a button to mark/unmark as favorite -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No notes available.</p>
    <?php endif; ?>
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
                <h1 class="white"><img src="logo.png" alt="" style="width: 30px; height: auto;">  Note<span class="green">IT</span></h1>
            </div>
        </div>
        <ul class="sidebar-list">
            <li class="sidebar-list-item">
                <a href="#">
                    <img src="note.png" alt="Note icon">
                    <span>Note</span>
                </a>
            </li>
            <li class="sidebar-list-item active">
                <a href="favorite_note_page.php">
                    <img src="favorite.png" alt="Note icon">
                    <span>Favorite  </span>
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="#">
                    <img src="archive.png" alt="Note icon">
                    <span>Archive</span>
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="#">
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
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                    <circle cx="12" cy="12" r="1"/>
                    <circle cx="19" cy="12" r="1"/>
                    <circle cx="5" cy="12" r="1"/>
                </svg> -->
            </button>
        </div>
    </div>
   

    

    
                        
<script>
    function favoriteNote(noteId) {
        // Send an AJAX request to 'favorite_note.php' with the note ID
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Check the response from the server
                if (this.responseText === "Note marked as favorite successfully.") {
                    // Note was successfully marked as a favorite
                    alert("Note marked as favorite successfully.");
                    // You can update the UI here to visually indicate that the note is a favorite
                    var favoriteIcon = document.getElementById('favoriteIcon_' + noteId);
                    if (favoriteIcon) {
                        favoriteIcon.style.color = 'gold'; // Change the color to gold or any other color you prefer
                    }
                } else if (this.responseText === "Note is already favorited.") {
                    // Note is already marked as a favorite
                    alert("Note is already favorited.");
                } else if (this.responseText === "Note removed from favorites successfully.") {
                    // Note was successfully removed from favorites
                    alert("Note removed from favorites successfully.");
                    // You can update the UI here to visually indicate that the note is not a favorite
                    var favoriteIcon = document.getElementById('favoriteIcon_' + noteId);
                    if (favoriteIcon) {
                        favoriteIcon.style.color = 'black'; // Change the color to the default color or any other color you prefer
                    }
                } else {
                    // Handle other response scenarios if needed
                    alert("Unexpected response from the server.");
                }
            }
        };
        xhttp.open("POST", "favorite_note.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("note_id=" + noteId);
    }

    function delete_note(id) {
        if (confirm("Do you confirm to delete this note?")) {
            window.location = "query/delete_note.php?delete=" + id;
        }
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
        xhttp.onreadystatechange = function () {
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
    viewNoteBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
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

    function toggleAddNoteForm() {
        var addNoteForm = document.getElementById('addNoteForm');
        var addNoteButton = document.getElementById('addNoteButton');

        if (addNoteForm.style.display === 'none') {
            addNoteForm.style.display = 'block';
            addNoteButton.textContent = 'Hide Note';
        } else {
            addNoteForm.style.display = 'none';
            addNoteButton.textContent = 'Create Note';
        }
    }

</script>

</body>
</html>
