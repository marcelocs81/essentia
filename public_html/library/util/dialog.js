

/*
 * 
 * Global variables start
 * 
 * Change the behaviour of the cms
 * http://adriancallaghan.co.uk/thickdialog/
 */

// messages
var message_delay_appear = 100;
var message_delay_disappear = 2000;

// dialog box
var dialogBox_width = 500;
// height is dynamic

// confirm box
// width is dynamic
var confirmBox_height = 400;

/*
 * 
 * Global variables end
 * 
 */
// pop ups, just give an anchor point the class dialog_box, and the title will be used as the title 
$(function (){
    $('a.dialog-box').click(function() {
        var url = this.href;
        var title = this.title;
        // show a spinner or something via css
        var dialog = $('<div id="dialog" style="display:none" class="loading">Carregando</div>').appendTo('body');
        // open the dialog
        dialog.dialog({
            
            width: dialogBox_width,
            
            // add a close listener to prevent adding multiple divs to the document
            close: function(event, ui) {
                // remove div with all data and events
                dialog.remove();
            },
            modal: true
        });

        // load remote content
        dialog.load(
            url, 
            {}, // omit this param object to issue a GET request instead a POST request, otherwise you may provide post parameters within the object
            function (responseText, textStatus, XMLHttpRequest) {
                // remove the loading class
                dialog.removeClass('loading');
                dialog.dialog('option', 'position', 'center');
                dialog.dialog('option', 'title', title);

            }
        );
        //prevent the browser to follow the link
        return false;
    });
});

// form pop ups, just give an anchor point the class dialog_form, and the title will be used as the title 
$(function (){
    
    function submitBind(layout,original_url){
    
        $(layout).find('form').submit(function(event){

            /* stop form from submitting normally */
            event.preventDefault(); 

            url = $(this).attr('action')=='' ? original_url : $(this).attr('action');                    

            /* Send the data using post and put the results in a div */
            $.post(
                url,
                $(this).serialize(),
                function(data) {

                    $('#dialog').empty();
                    $('#dialog').append(data);
                    $('#dialog').dialog('option', 'position', 'center');
                    submitBind(layout, original_url);
                });

        }); 

    }
    
    
    $('a.dialog-form').click(function() {
        
        var original_url = this.href;
        var title = this.title;
        // show a spinner or something via css
        var dialog = $('<div id="dialog" style="display:none" class="loading">Loading</div>').appendTo('body');
        // open the dialog
        dialog.dialog({
            
            width: dialogBox_width,
            
            // add a close listener to prevent adding multiple divs to the document
            close: function(event, ui) {
                // remove div with all data and events
                dialog.remove();
            },
            modal: true
        });

        // load remote content

        dialog.load(
            original_url,
            function (responseText, textStatus, XMLHttpRequest) {
                // remove the loading class
                dialog.removeClass('loading');
                dialog.dialog('option', 'position', 'center');
                dialog.dialog('option', 'title', title);
                              
                submitBind(this,original_url);
             
            }
        );
        //prevent the browser to follow the link
        return false;
    });
});





// confirm box, add the class dialog-confirm and a title and it does the rest
$(function (){
    $('a.dialog-confirm').click(function() {

        var url = this.href;
        var dialog = $('<div id="dialog" style="display:none" title="Você tem certeza?">'+this.title+'</div>').appendTo('body');
        
        dialog.dialog({
        	
            resizable: false,
           // height:confirmBox_height,
            modal: true,            
            buttons: {
                    "Sim": function() {
                            $(this).dialog( "close" );
                            window.location.href = url;

                    },
                    "Não": function() {
                            $(this).dialog( "close" );
                    }
            }
        });        
        dialog.dialog('option', 'position', 'center');
       
        //prevent the browser to follow the link
        return false;
    });
});

//confirm box, add the class dialog-confirm and a title and it does the rest
$(function (){
    $('button.dialog-confirm').click(function() {

        var form = this.form;
        var dialog = $('<div id="dialog" style="display:none" title="Você tem certeza?">'+this.title+'</div>').appendTo('body');
        
        var input = $("<input>")
        			.attr("type", "hidden")
        			.attr("name", this.id).val(this.value);
        $(form).append($(input));
        
        dialog.dialog({
        	
            resizable: false,
           // height:confirmBox_height,
            modal: true,            
            buttons: {
                    "Sim": function() {
                            $(this).dialog( "close" );
                            $(form).submit();

                    },
                    "Não": function() {
                            $(this).dialog( "close" );
                    }
            }
        });        
        dialog.dialog('option', 'position', 'center');
       
        //prevent the browser to follow the link
        return false;
    });
});

