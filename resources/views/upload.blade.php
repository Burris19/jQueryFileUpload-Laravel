<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload</title>	
</head>
<body>
	<form action="upload" id="formulario" class="formulario">
        <input type="file" multiple="multiple" id="file"/>        
        <input type="hidden" name="_token" value="{!! csrf_token() !!}"  id="token">
        
	</form>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>
        window.onload = function(){            
            var files = document.getElementById("file");
            var photos = [];
            var subidas =0;
            var error=0;
            var total =0;
            files.addEventListener("change", showContent, false)            
            function showContent(){
                var filess = document.getElementById("file").files;                                
                for (var i = 0; i < filess.length; i++ ){                     
                    photos.push(filess[i]);
                    total +=1;
                }
                if (total > 0) {
                    sendFile();
                }
            }            
            function sendFile(indice){                
                var token = $("#token").val();
                var formData = new FormData();
                formData.append('_token', token);
                formData.append('file', photos[0]);                                
                $.ajax({
                    url: '/prueba',
                    method: 'POST',
                    data: formData,                    
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        subidas +=1;
                        console.log(response);                        
                    },
                    error: function(erro){
                        error -=1;
                        console.log(error);
                    },
                    complete: function(){                        
                        photos.pop();
                        if ( subidas < total){
                            sendFile();
                        }
                    }                    
                });
            }
        };
    </script>
</body>
</html>