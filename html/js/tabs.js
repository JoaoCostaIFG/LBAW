
'use strict'

$(document).ready(function(){
    $(".nav-item a").click(function(e){
        e.preventDefault();
        $(this).tab('show');
    });
});
