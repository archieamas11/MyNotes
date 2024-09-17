<?php
  include "header.php";
?>

<div class="container">
    <h1>NoteIt</h1>
</div>
<div class="container">
<form action= "database.php" method= "POST"> 
  <div class="mb-3 md-col-5 text-center">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" class="form-control" name="title"id="exampleInputEmail1" aria-describedby="emailHelp" required>
    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
  </div>
  <div class="form-group md-col-5 text-center">
<label for= "exampleFormControlTextArea1"> Content </label>
<textarea class = "form-control" name="content"id="exampleFormControlTextArea1" rows="3"></textarea>

</div>
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

</div>

