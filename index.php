<?php
if(isset($_COOKIE['id']) && $_COOKIE['id']!='') {
    header('Location: ./users/user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do App</title>
</head>
 <link rel="stylesheet" href="./stylesheet/index.css">
<body>
    <div class="top-div">
	<?php include("header.php")?>
        <div id="intro-div" class="intro-div">
             <div class = "background">
                <img src="./images/index-wallpaper.jpg" height="600px"/>
                <div class = "foreground">
                    <h1>Welcome To Planner</h1>
                </div>
            </div>
         </div>
    </div>
    <div class="middle-div">
        <div class="grid-container">
            <div class="grid-item">Create To-Do Lists</div>
            <div class="grid-item">Keep a track of your goals</div>
            <div class="grid-item">Keep it organized</div>
            <div class="grid-item">Not a Member yet ? Sign-up NOW!</div>
            <div class="grid-item"><label class="mid-logo">Planner<span>.in</span></label></div>
            <div class="grid-item">Already Have an Account?Log-in</div>
          </div>
	</div>
	
	<?php include("footer.php")?>
</body>
</html>
