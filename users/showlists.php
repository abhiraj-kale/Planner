<?php 
require '../connect.inc.php';
ob_start();
session_start();
 $_SESSION['username'];
 $_SESSION['password'];
 $_SESSION['email'];
 $_SESSION['id'];
 $_SESSION['logged_in'];
if($_SESSION['logged_in']==false){
    header('Location: ../log_in.php');
};

global $conn;
$query="SELECT id,email FROM user_info WHERE username='".$_SESSION['username']."'";
   if ($result = mysqli_query($conn,$query)){
       $row = mysqli_fetch_assoc($result);
         $_SESSION['id'] = $row['id'];
         $_SESSION['email'] = $row['email'];
}
?>
<div id="delete">
    <h3>Do you want to delete this item?</h3>
    <button id="yes">Yes</button> <button id="no">No</button>
</div>
<div class="delete-box">
	</span><span><label>Deleted!</label></span>
        <p></p>
</div>
<div class="error-box">
	</span><span><label>Error 504</label></span>
        <p></p>
</div>
<div class="main">
               <input class="un " id="title" type="text" align="center" placeholder="Title" maxlength="20" minlength="1">
               <textarea class="un" id="textarea" rows="9" placeholder="Description" maxlength="300" minlength="1"></textarea>
            <div>
            <input class="date " id="date" type="date" align="center" value="" >
            <input class="date " id="time" type="time" align="center" value="">
		  </div>
			  <a class="save">Save</a>
			  <a class="cancel">Cancel</a>
</div>           

<div class="inlist">
      <div>
                      <p class="sign" align="left">Incomplete Lists</p>
    <?php  
         $query="SELECT id,list_id,title,description,date,time,complete FROM lists WHERE id='".$_SESSION['id']."' AND complete=0";
        if ($result = mysqli_query($conn,$query)) {
            while($row = mysqli_fetch_assoc($result)){
                if (mysqli_num_rows($result)>=0) {
                    echo "<div class='lists' tabindex='-1' ><button class='show_list' id='".$row['list_id']."'>".$row['title']."</button><img src='images/delete.png' alt='delete' id='".$row['list_id']."' class='img'><input type='checkbox' class='checkbox' id='".$row['list_id']."'><label>".$row['date']."</label><label>".$row['time']."</label></div>";
                }
            }
        }
      ?>
	</div>
</div>

	<div class="cmlist">
	<div>
           <p class="sign" align="center">Completed Lists</p>

    <?php  
         $query="SELECT id,list_id,title,description,date,time,complete FROM lists WHERE id='".$_SESSION['id']."' AND complete=1";
        if ($result = mysqli_query($conn,$query)) {
            while($row = mysqli_fetch_assoc($result)){
                if (mysqli_num_rows($result)>=0) {
                    echo "<div class='lists' tabindex='-1' ><button class='show_list' id='".$row['list_id']."'>".$row['title']."</button><img src='images/delete.png' alt='delete' id='".$row['list_id']."' class='img'><input type='checkbox' class='checkbox' checked id='".$row['list_id']."'><label>".$row['date']."</label><label>".$row['time']."</label></div>";
                }
            }
        }
    ?>
    </div>
</div>

<script src="js/jquery.js"></script>
<script src="js/showlist.js"></script>