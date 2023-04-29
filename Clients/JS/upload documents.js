$(document).ready(function(){
   
    $('.file_drag_area').on('dragover', function(){  
        $(this).addClass('file_drag_over');  
        return false;  
   });  
   $('.file_drag_area').on('dragleave', function(){  
        $(this).removeClass('file_drag_over');  
        return false;  
   });  
   $('.file_drag_area').on('drop', function(e){  
        e.preventDefault();  
        $(this).removeClass('file_drag_over');  
        var formData = new FormData();  
        var files_list = e.originalEvent.dataTransfer.files;  
        //console.log(files_list);  
        for(var i=0; i<files_list.length; i++)  
        {  
             formData.append('file[]', files_list[i]);  
        }  
        //console.log(formData);  
       /* $.ajax({  
             url:"upload.php",  
             method:"POST",  
             data:formData,  
             contentType:false,  
             cache: false,  
             processData: false,  
             success:function(data){  
                  $('#uploaded_file').html(data);  
             }  
        })  */
   });  


});