(function($){
    $.fn.anyfilechooser = function(){
        var chooser = this;

        var $container = $('<div class="anyfilechooser" />');
        var $textbox = $('<input class="anyfilechooser-text" type="text" />');
        var $button = $('<input class="anyfilechooser-button" type="button"  value="Load" />');
        var $trigger = $('<input class="anyfilechooser-trigger" type="file" />');

        var filename = null;

        if(arguments.length == 1){
            var options = arguments[0];
        } else {
            options = {
                "load_callback": function(){
                    alert("Implement 'load_callback' ");
                }
            }
        }

        $container
            .append($trigger)
            .append($textbox)
            .append($button);

        var trigger_call = function(){
            $trigger.click();
        }

        $textbox.click(trigger_call);
        $button.click(function(){
            if($textbox.val() == ''){
                trigger_call.apply(chooser);
            } else {
                options.load_callback.apply(this);
            }
        });

        $trigger.bind('change', function(event){
            console.log(this);
            filename = this.value;
            $textbox.val(filename);
        });

        this.append($container);
        return this;
    }
}(jQuery))
