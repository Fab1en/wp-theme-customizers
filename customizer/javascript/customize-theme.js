jQuery(function($){

    // switch to know when we are dragging
    var move = false;
    
    // initial background-position when draging
    var initPos = {x:0, y:0};
    
    // jQuery mouse events handling
    $('#wrap').mousedown(function(e){
        move = true;
        
        // calculate the initial background-position value (relative to the mouse position)
        var bgPos = $(this).css('background-position');
        if(bgPos.indexOf('px') !== -1){
            var num = bgPos.split('px');
            initPos = {x: parseInt(num[0], 10)-e.clientX, y: parseInt(num[1], 10)-e.clientY};
        } else {
            initPos = {x:-e.clientX, y:-e.clientY};
        }
        
    }).mouseup(function(){
        move = false;
        $(this).css('cursor', 'default');
    }).mouseleave(function(){
        move = false;
        $(this).css('cursor', 'default');
    }).mousemove(function(e){
        if(move) {
            
            // live update of the background-position
            var $this = $(this);
            $this.css({
                cursor: 'move',
                'background-position': (e.clientX + initPos.x) + 'px ' + (e.clientY + initPos.y) + 'px'
            });
        }
    });

});
