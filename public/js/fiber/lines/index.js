$(function(){
    
    // Akcja klik dla dodania traktu
    // Wykorzystanie jquery-ui dialog
    
    $("#showAddForm").click(function(){
        
        $("#dialog-form").dialog({
            modal: true,
            autoOpen: false,
            height:380,
            width:600,
            title:'Add Track',
            autoReposition: true,
            resizable: false,
            
            buttons:{
                
                // Przycisk zapisania do bazy za pomocą ajax
                Save : function() {
                    save();
                    $("#dialog-form").dialog("close");
                    location.reload();
                },
                
                // Anulowanie dodania
                Cancel: function() {
                    $("#dialog-form").dialog("close");
                }
            }
        });
        
        $("#dialog-form").load($(this).attr('href'));
        $("#dialog-form").dialog("open");
         
        return false;
    });
    
    function save(){
        
        // Wysyłka ajax
        $.ajax({
            url:        '/fiber/lines/addtrack',
            type:       'POST',
            dataType:   'json',
            async:      true,
            data:       { 
                name : $("#track_name").val(), 
                description: $("#track_description").val()
            },
            success: function(data, status){
                if(status){
                    alert(data['message']);				
		}else{
                    jQuery("#response").html('Błąd w zapisie');
                }
            },
            error : function(xhr, textStatus, errorThrown) {
                if (xhr.status === 0) {
                    alert('Not connected. Verify Network.');
                } else if (xhr.status === 404) {
                    alert('Requested page not found. [404]');
                } else if (xhr.status === 500) {
                    alert('Server Error [500].');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed.');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error.');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted.');
                } else {
                    alert('Remote sever unavailable. Please try later');
                }
            }
        });
    }
    
});