$(".btn").click(function(){
        var overlay = $(".overlay.overlay-slidedown")
       overlay.toggleClass('open')
    });


$("#close").click(function(){
        var overlay = $(".overlay.overlay-slidedown")
       overlay.removeClass('open')
    });
