<link rel="stylesheet" href="stylesheet/Header.css">
<div id="topnav" class="topnav">
               <a href="index.php"><button>Planner</button><label>.in</label></a>
              <a href="index.php" class="home">Home</a>
              <a  href="about.php" class="about">About</a>
              <a href="log_in.php" class="log_in">Log in</a>
              <a href="sign_up.php" class="sign_up">Sign Up</a>
</div>


	<div class="loading-box">
	<span><label>Loading</label></span>
        <p></p>
    </div>
    
    <script src="js/jquery.js"></script>
<script>
    $('#topnav a').on('click' , function () {  
        $('.loading-box').css({'display' : 'block'});
    });
    var name = location.pathname.split('/').slice(-1)[0];
    if(name == "index.php"){
     $('.home').addClass("active");   
    }else if(name == "about.php"){
     $('.about').addClass("active");   
    }
    else if (name == "log_in.php"){
    $('.log_in').addClass("active");
    }else if(name=="sign_up.php"){
    $('.sign_up').addClass("active");
    }

    $('.buttons').on('click' , function(){
		   $('.modalcontainer').fadeOut();
   });


</script>