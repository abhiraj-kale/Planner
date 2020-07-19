$(document).ready(function () {
});
$('.menu').on('click', function(){
    $('.drop_down').fadeIn(200);
})

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