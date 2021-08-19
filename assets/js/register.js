$(document).ready(function(e){
    //Signup
    $('#signup').click(function(){
        $('#first').slideUp('slow', function(){
            $('#second').slideDown('slow')
        })
    })

    //Login
    $('#login').click(function(){
        $('#second').slideUp('slow', function(){
            $('#first').slideDown('slow')
        })
    })
})