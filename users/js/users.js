$(document).ready( function() {
    $('.date').val(new Date().toISOString().substr(0, 10));
});

$('#new').on('click', function(){
    $('.main').fadeIn(200);
});
$('.cancel').on('click' , function () { 
    $('.main').fadeOut(200);
});
var loading = false;
$('.save').on('click',function(){
        $('.main').fadeOut(200);
        $('.loading-box').css({'display' : 'block'});
        if ($('#title').val()=="" || $('#textarea').val()=="") {
            alert('Fields can\'t be empty');
            $('.loading-box').css({'display' : 'none'});
        }else {
        setTimeout(() => {          
            var title = $('#title').val();
            var textarea = $('#textarea').val();
            var date = $('#date').val();
            var time = $('#time').val();
            
            $.ajax({
                type: "POST",
                url: "user.php",
                data: {title:title, textarea:textarea, date:date, time:time},
                async : false,
                success: function (response, status) {
                    
                    if(status=="success"){
                        $('.complete-box').fadeIn(200);
                        setTimeout(() => {
                        $('.complete-box').fadeOut(200);
                       }, 1000);
                    }
                },
                complete: function (data) {
                    $('.loading-box').css({'display' : 'none'}); 
                }
            }); 
        }, 200);
    }
});