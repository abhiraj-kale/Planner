var global_id;
function showlist(id){
    $('.loading-box').fadeIn(200);
    $.ajax({
        type: "GET",
        url: "listdata.php",
        data: "id="+id,
        success: function (response) {
            response = JSON.parse(response);
            $('#title').val(response.title);
            $('#textarea').val(response.description);
            $('#date').val(response.date);
            $('#time').val(response.time);
        }
    });
    setTimeout(() => {
        $('.loading-box').fadeOut();
        $('.main').fadeIn(200);
    }, 500);
}
$('.show_list').on('click',function(){
    var id = this.id;
    global_id = id;
    showlist(id);
});

$('.cancel').click(function(){
    $('.main').fadeOut(200);
});

$('.img').on('click',function(){
    var item = $(this);
    var id = this.id;
     $('#delete').fadeIn();
   $('#no').on('click',function(){
     $('#delete').fadeOut();
   });
   $('#yes').on('click',function(){
       $('#delete').fadeOut();
        $.ajax({
            type: "GET",
            url: "listdata.php",
            data: "delete_list="+id,
            success: function (response) {
                if(response=="success"){
                    $('.delete-box').fadeIn(200);
                    setTimeout(() => {
                    $('.delete-box').fadeOut(200);
                   }, 1000);
                }
                item.parent().fadeOut();
            }
        });
   })
});

$('.checkbox').on('click',function(){
    $('.loading-box').fadeIn(200);
    var list_id = this.id;
    var item = $(this);
  
    if(item.prop("checked") == true){
        $.ajax({
            type: "POST",
            url: "listdata.php",
            data: "list_id="+list_id,
            success: function (response) {
                
                $('.loading-box').fadeOut(200);
                if (response=="success") {
                    $('.cmlist div').first().append(item.parent());
                }else{
                    $('.error-box').fadeIn(200);
                    setTimeout(() => {
                    $('.error-box').fadeOut(200);
                    }, 2000);
                    item.prop("checked", false);
                }
            }
        });
     }else {
         $.ajax({
             type: "POST",
             url: "listdata.php",
             data: "change_id="+list_id,
             success: function (response) {
                $('.loading-box').fadeOut(200);
                if (response=="success") {
                    $('.inlist div').first().append(item.parent());
                }else{
                    $('.error-box').fadeIn(200);
                    setTimeout(() => {
                    $('.error-box').fadeOut(200);
                    }, 2000);
                    item.prop("checked", false);
                }
             }
         });        
     }
});

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
                url: "listdata.php",
                data: {listid:global_id, title:title, textarea:textarea, date:date, time:time},
                async : false,
                success: function (response, status) {
                
                },
                complete: function (data) {
                    $('.loading-box').css({'display' : 'none'}); 
                }
            }); 
        }, 200);
    }
    showlist(global_id);
});
