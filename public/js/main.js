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
    
    $('#new').click(function(e){
        e.preventDefault();
        
        $('.createAccnt').hide('slow');
        
        $('#createAccount1').show('slow');
        
        $('#choice').html('New Account and New Contact');
    });
    
    $('#existing').click(function(e){
        e.preventDefault();
        
        $('.createAccnt').hide('slow');
        
        $('#createAccount2').show('slow');
        
        $('#choice').html('Add a New Contact to an Existing Account');
    });
    
});