(function( $ ){
    $.fn.ulSelect = function(){
        return this.each(function(){
            var $select = $(this);
            $select.data('shiftIndex', null);
            $select.attr('unselectable', 'on').css('user-select', 'none');


            $li_list = $('li', $select);
            var index = null;
            $li_list.click(function(event){
                var $selected = $('.selected', $select);

                if(! event.ctrlKey){
                    $selected.removeClass('selected');
                }
                $(this).toggleClass('selected');
            });
        });
    }
})( jQuery );

(function( $ ){
    $.fn.dashboardFetch = function(){
        this.each(function(){
            var $select = $(this);
            var src = $select.attr('data-source');
            console.log(src);

            var jqxhr = $.get(src, function(data){
                var data = $.parseJSON(data);
                $select.empty();
                $select.append("<input type='hidden' class='select-selected' />");
                for(var i in data){
                    console.log(data[i]);
                    $select.append("<li value='"+ i +"'>"+data[i].name+"</li>");
                }
                $select.ulSelect();
            });
            jqxhr.fail(function(){
                alert('error');
            });
        });
    }
})( jQuery );
