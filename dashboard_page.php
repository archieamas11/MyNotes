
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
      
      .allnote {
    text-align: right;
    color:green;
    justify-content: space-between;
    font: 25px bold;
}
    </style>
</head>
<body>
<div class="container">
       
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
      <h1 class="white"><img src="logo.png" alt=""style="width: 30px; height: 42px; margin-top: 20px;">  Note<span class="green">IT</span></h1>
    
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
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
        </svg>
    </button>
    </div>
  </div>

  
   


</body>
</html>
