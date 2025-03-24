$(document).ready(function(){
    // jquery UI exercice
    $('#vie').hide();
    $('#deuxieme').hide();
    $('#troisieme').hide();
    $('#quatrieme').hide();
    $('#cinquieme').hide();
    $('#cinquieme').hide();
    $('#para1').hide();
    $('#cacher').hide();
    $('#montrer_image').hide();

    $('h1').click(function(){
        $(this).css('color', 'red');
        $('#vie').show();
    })

    $('#vie').hover(function(){
        $(this).css({
            'color': 'purple',
            'font-weight': 'bold',
            'font-style': 'italic'
        })
    })

    $('#vie').mouseleave(function(){
        $('#para1').show();
    })

    $('#para1').click(function(){
        $('#deuxieme').show();
    })

    $('#para2').click(function(){
        $('#troisieme').show();
    })
    // Jquery ui1
    $('h2').css('color','blue');
    $('#p1').hide();
    $('#div1').hide();
    $('#cliquer').click(function(){

        $(this).css({
            'color':'red',
            'font-weight': 'bold',
            'font-size': '200%'

        })
        $('#p1').show();
        $('#div1').fadeIn(1000);
    });

    $('#p1').mouseover(function (){
        $('#div1').css('background-color','pink');
    })

    $('#calendrier').datepicker();

    $('#tirer').click(function(){
        $('#menu').toggle('slide');
    })
});