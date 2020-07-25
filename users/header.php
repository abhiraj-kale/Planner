
<link rel="stylesheet" href="stylesheet/user.css">
<style>
    .loading-box{
    display: none;
    background-color: whitesmoke;
    background-image: url("../images/loading.gif");
    background-repeat: no-repeat;
    background-size: 100px;
    background-position: left;
    height: 80px;
    width: 250px;
    font-size: 35px;
    font-weight: lighter;
    position: fixed;
    z-index:99999;
    margin-left: 38%;
    margin-top: 5%;
    border-radius: 5px;
    box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.39);
  }
  .loading-box label{
    float: right;
    margin: 10px; 
    padding: 5px; 
    font-family: Arial, Helvetica, sans-serif;
  }
  .profile{
	display: none;
	font-family: Arial, Helvetica, sans-serif;
	position: absolute;
	z-index: 9999999;
	background-color: #FFFFFF;
	padding: 2%;
	width: 65%;
	margin: 7em auto;
	border-radius: 1.5em;
	box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
	margin-left: 15%;
	margin-top: 2%;
	margin-right: auto;
  }
  .profile button{
	margin: 10px;
  }
 .profile_close{
	 font-size: 20px;
 }
</style>
<div id="topnav" class="topnav">
		   <a href="#" id="logout"><button>Planner</button><label>.in</label></a>
		   <div class="tab">
		   <a class="user" href="user.php">Create List</a>
		   <a class="mylists" href="mylists.php">My Lists</a>
		   </div>
				<div class="top_menu" style="cursor: pointer;">
					<a href="#" class="menu">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					<ul class="drop_down">
						<li class="pro" >Profile</li>
						<li class="set">Settings</li>
						<li class="logout" id="logout">Log Out</li>
					</ul>
				 </a>
                </div>
</div>
<div class="loading-box">
	</span><span><label>Loading</label></span>
        <p></p>
</div>
<div class="complete-box">
	</span><span><label>Created!</label></span>
        <p></p>
</div>
<div class="profile">
     <center><h2>Profile</h2></center>
    <h4>USER ID : <?php echo $_SESSION['id']; ?> (Unchangeable)</h4>
    <h4 class="user_head">Username: <?php echo $_SESSION['username'];?></h4>
    <input class="n_user" type="text" placeholder="New Username"><button class="chng_user">Change Username</button>
    <h4>Password</h4>
    <input class="o_p" type="password" placeholder="Old password"></label> <input class="n_p" type="text" placeholder="New Password"><button class="chng_pass">Change Password</button>
    <h4 class="email_head">Email : <?php echo $_SESSION['email']; ?></h4>
    <input class="n_email" type="email" placeholder="New Email"><button class="chng_email">Change Email</button>
    <br>
    <center><button class="profile_close">Close</button></center>
</div>
<script src="js/jquery.js"></script>
<script>
    var name = location.pathname.split('/').slice(-1)[0];
    if(name == "user.php"){
     $('.user').addClass("active");   
    }else if(name == "mylists.php"){
     $('.mylists').addClass("active");   
    }

    $('.top_menu').on('click', function(){
    $('.drop_down').toggle();
    });
    $('#topnav a').not('.menu').on('click' , function () {  
        $('.loading-box').css({'display' : 'block'});
    });
    $('.logout').on('click',function(){
        $.get("user.php", "logout=true",
            function (data,status) {
                window.location.href="../log_in.php";
            },
        );
    });
    $('#logout').on('click',function(){
        $.get("user.php", "logout=true",
            function (data,status) {
                window.location.href="../log_in.php";
            },
        );
    });
    
$('.pro').on('click',function(){

$('.profile').fadeIn(200);

$('.chng_user').on('click',function(){
    $('.chng_user').prop('disabled', true);
    var username = $('.n_user').val();
    if (username=="") {
        alert('Field can\'t be empty');
        $('.chng_user').prop('disabled', false);
        return;
    }
    $.ajax({
        type: "POST",
        url: "listdata.php",
        data: "username="+username,
        success: function (response) {
            if (response=="success") {
                $('.user_head').html("Username: "+username);
                alert('Username changed')
            }else {
                alert("Error");
            }
        }
    });
     $('.chng_user').prop('disabled', false);
});

$('.chng_email').on('click',function(){
    $('.chng_email').prop('disabled', true);
    var email = $('.n_email').val();
    if (email=="") {
        alert('Field can\'t be empty');
        $('.chng_email').prop('disabled', false);
        return;
    }
    $.ajax({
        type: "POST",
        url: "listdata.php",
        data: "email="+email,
        success: function (response) {
            if (response=="success") {
                $('.email_head').html("Email : "+email);
                alert('Email changed');
            }else {
                alert("Error");
            }
        }
    });
     $('.chng_email').prop('disabled', false);
});

$('.chng_pass').on('click',function () {
    var old_pass = $('.o_p').val();
    var new_pass = $('.n_p').val();
    if (new_pass=="" || old_pass=="") {
        alert('Field/s can\'t be empty');
        return;
    }
    $.ajax({
        type: "POST",
        url: "listdata.php",
        data: {oldpass: old_pass, newpass: new_pass},
        success: function (response) {
            if (response=="") {
                alert('Error');
            }else 
                alert(response);
        }
    });
});

$('.profile_close').on('click',function(){
    $('.profile').fadeOut(200);
});
});


    // Click outside of div to close
$(document).mouseup(function(e) 
{
    var container = $('.drop_down');

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.fadeOut(200);
    }
});
</script>