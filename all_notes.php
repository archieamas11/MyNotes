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
    <link rel= "stylesheet" href="dashBOARDS1.css">
   <style>@media only screen and (max-width: 768px) {
    .containerfav {
        width: 100%; /* Adjust width for smaller screens */
        margin-left: 0; /* Remove left margin for full width */
        padding: 20px; /* Adjust padding for smaller screens */
        height:100px;
    }

    .list-group-item1 .action {
    /* margin-left:220px; */
    margin-left: auto; 
    margin-top: 10px;
}
.list-group-item1 .action button {
    margin-left: 5px; /* Add space between buttons */
    font-size: 16px; /* Adjust button font size */
    padding: 3px 30px; 
}
/* If you prefer padding, you can use padding instead of margin */
.list-group-item1 .action {
    /* padding-top: -25px;  */
    gap: 8px;
    display:flex;
    /* margin-top: 50px; */
    flex-direction: row-reverse; /* Change the direction to reverse the order of the buttons */
    margin-top: 20px;
}
.list-group-item1 .action a,
.list-group-item1 .action button {
    margin-left: 5px;
    font-size: 16px;
    padding: 3px 30px;
}

    .list-group-item1 .action button {
        margin: 5px; /* Adjust button margins for smaller screens */
    }
}
       .note-container {
        /* display: flex;
        flex-wrap: wrap;    
        justify-content: flex-start; */
    }
    .list-group-item1 > div {
    margin-bottom: 20px; 
    /* margin-top: 50px; */
}


.list-group-item1 .action {
    margin-left: 0; /* Center action buttons for smaller screens */
        margin-top: 20px; /* Adjust top margin for smaller screens */
        display: flex;
        justify-content: center;
}

/* If you prefer padding, you can use padding instead of margin */
.list-group-item1 .action {
    /* padding-top: -25px;  */
    gap: 8px;
    display:flex;
    margin-top: 50px;
    margin-left:240px;
}
.list-group-item1 .note-details {
    margin-top: 100px; /* Adjust the margin-top as needed */
}
      .allnote {
    text-align: right;
    color:green;
    justify-content: space-between;
    font: 25px bold;
}
.containerfav{
    width: 1100px;
    min-height: 100vh;
    /* background: linear-gradient(135deg, #cf9aff, #95c0ff); */
    /* color: green; */
    padding-top: 5.5%;
    /* padding-left: 200%; */
    margin-left: 250px;
    padding: 60px;
    overflow-y: auto;
    
}
@media screen and (max-width: 768px) {
    .list-group-item1 .action {
        flex-direction: column;
        align-items: stretch;
    }

    .list-group-item1 .action button {
        margin: 5px 0;
    }
}
    </style>
</head>
<body>
<div class="containerfav">
       
    <!-- </div> -->
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
      <h1 class="white"><img src="logo.png" alt=""style="width: 30px; height: auto;">  Note<span class="green">IT</span></h1>
    
      </div>
    </div>
    <ul class="sidebar-list">
    <li class="sidebar-list-item">
    <a href="dashBoard.php">
        <img src="note.png" alt="Note icon">
        <span>Note</span>
    </a>
</li>
      <li class="sidebar-list-item active">
        <a href="favorite_page.php">
        <img src="favorite.png" alt="Note icon">
          <span>Favorite  </span>
        </a>
      </li>
      <li class="sidebar-list-item">
        <a href="archive_page.php">
        <img src="archive.png" alt="Note icon">
          <span>Archive</span>
        </a>
      </li>
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
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
            <circle cx="12" cy="12" r="1"/>
            <circle cx="19" cy="12" r="1"/>
            <circle cx="5" cy="12" r="1"/>
        </svg>
    </button>
    </div>
  </div>
  <div class="">
        
        <div class="card">
            <div class="card-header1">
                Favorite Notes
            </div>

            <div class="card-body">
                <div class="data-item">
                    <ul class="list-group">

                        <?php
                        include('query/conn.php');

                        $stmt = $conn->prepare("SELECT * FROM `tbl_notes` WHERE is_favorite = 1 AND is_archived = 0");
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
                            <div class="list-group-item1" id="note_<?php echo $noteID; ?>">
                                <h3 style="text-transform: uppercase;"><?php echo htmlspecialchars($noteTitle); ?></h3>
                                <div>
                                    <p class="note-content">
                                        <?php echo truncateText($noteContent, 100); ?></p>
                                </div>
                                <div class="note-details">
                                    <small class="block text-muted text-info">Created: <i class="fa fa-clock-o"></i> <?php echo htmlspecialchars($formattedDateTime); ?></small>
                                </div>
                                <div class="action">
                                    <a href="#" onclick="openViewNoteModal(<?php echo $noteID; ?>)" title="View"><i class="fas fa-eye"></i></a>
                                    <button onclick="unfavoriteNote(<?php echo $noteID; ?>)" title="unfavoriteNote"><i class="fas fa-archive"></i> </button>
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
  
<script>
    function unfavoriteNote(noteID) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    // Handle successful response
                    console.log("Note unfavorited successfully");
                    // Remove the unfavorited note from the dashboard
                    var noteElement = document.getElementById('note_' + noteID);
                    if (noteElement) {
                        noteElement.parentNode.removeChild(noteElement);
                    }
                    // Display a success message
                    alert("Note unfavorited successfully");
                } else {
                    // Handle error
                    console.error("Error unfavoriting note");
                    // Display error message
                    alert("Error unfavoriting note");
                }
            }
        };
        xhttp.open("GET", "unfavorite_note.php?note_id=" + noteID, true);
        xhttp.send();
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
   
</script>
</body>
</html>
