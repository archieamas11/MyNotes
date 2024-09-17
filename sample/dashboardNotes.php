<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    <div>
    <div class="container">
        <h1><img src="images/Capture.png" alt="Logo"> Notes</h1>
        <button class="btn1">Create Notes</button>
        <div class="notes-container">
            <p contenteditable="true" class="input-box1"></p>
        </div>
    </div>

   
    <script>
        
const notesContainer = document.querySelector(".notes-container");
const createBtn = document.querySelector(".btn1");
let notes = document.querySelectorAll(".input-box1");

createBtn.addEventListener("click", () => {
    let inputBox = document.createElement("p");
    // let img = document.createElement("img");
    inputBox.className = "input-box1";
    inputBox.setAttribute ("contenteditable", "true");
    // image.src = "images/delete.png";
    notesContainer.appendChild(inputBox);
    // .appendChild(img)

})


    </script>

</body>
</html>
