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
            var $this = $(this);
            
            // store the background-position as a global variable
            window.background_position = (e.clientX + initPos.x) + 'px ' + (e.clientY + initPos.y) + 'px';
            
            // live update of the background-position
            $this.css({
                cursor: 'move',
                'background-position': window.background_position
            });
            
        }
    });
    
    
    // WP theme customizer magic
	wp.customize( 'artsite_background_color', function( value ) {
		value.bind( function( newval ) {
			$('body, #wrap').css('background-color', newval );
		} );
	} );
	wp.customize( 'background_image', function( value ) {
		value.bind( function( newval ) {
			$('#wrap').css('background-image', newval );
		} );
	} );
	wp.customize( 'background_repeat', function( value ) {
		value.bind( function( newval ) {
			$('#wrap').css('background-repeat', newval );
		} );
	} );

});
