<?php
include('query/conn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the note ID from the form
    $noteID = $_POST['note_id'];
    
    // Retrieve the note from the database based on the ID
    $stmt = $conn->prepare("SELECT * FROM `tbl_notes` WHERE tbl_notes_id = :note_id");
    $stmt->bindParam(':note_id', $noteID);
    $stmt->execute();
    $note = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // If not submitted, get note ID from URL parameter
    if(isset($_GET['edit'])){
        $noteID = $_GET['edit'];
        
        // Retrieve the note from the database based on the ID
        $stmt = $conn->prepare("SELECT * FROM `tbl_notes` WHERE tbl_notes_id = :note_id");
        $stmt->bindParam(':note_id', $noteID);
        $stmt->execute();
        $note = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take-Note App</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #343a40;
            color: #ffffff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: #ffffff;
        }

        .navbar-nav {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .nav-item {
            margin-left: 20px;
        }

        .nav-link {
            color: #ffffff !important;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #ffc107 !important;
        }

        .main-panel {
            margin: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .card-header a:hover {
            color: #ffc107;
        }

        .card-body {
            padding: 20px;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #dee2e6;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item:hover {
            background-color: #f1f1f1;
        }

        .list-group-item h3 {
            margin-bottom: 10px;
            color: #007bff;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .text-info {
            color: #17a2b8 !important;
        }

        .fa-clock-o {
            margin-right: 5px;
        }

        /* Custom styles for forms */
        form {
            margin-bottom: 20px;
        }

        form .form-group {
            margin-bottom: 20px;
        }

        form .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form textarea {
            height: 200px;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>

</div>
    <div class="main-panel">
        <div class="row">

            <!-- Update Note -->
            <div class="col-md-4 border-right">
                <div class="card">
                    <div class="card-header">
                        Update Note
                    </div>
                    <div class="card-body">
                        <form id="updateNoteForm"  method="post" action="query/update_note_process.php">
                            <input type="hidden" name="note_id" value="<?php echo $note['tbl_notes_id']; ?>">
                            <div class="form-group">
                                <label for="noteTitle">Title</label>
                                <input type="text" class="form-control" id="noteTitle" name="note_title" value="<?php echo $note['note_title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" id="note" name="note_content" rows="23"><?php echo $note['note']; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary">Update</button>
                            <button href="http://localhost/noteLogin/" type="submit" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            

          

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>