$(document).ready(function() {
    
    
    console.log("js is loading");
    
    $('.loginButton').click(function(e){
        e.preventDefault();
        
        if( $('.loginButton').hasClass('closed') ) {
            $('.loginButton').removeClass('closed').addClass('opened');
            $('#loginModal').css('display','flex');
            console.log("to open");
        } else if( $('.loginButton').hasClass('opened') ) {
            $('.loginButton').removeClass('opened').addClass('closed');
            $('#loginModal').css('display','none');
            console.log("to close");
        }
    });
    
    $('[data-toggle="tooltip"]').tooltip();
    
});