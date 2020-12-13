 
 $(".").click(function(e){



 });
 
 
 
 
 var email = $('#emailnews').val();
   var _token = $('#token').val();
   $.ajax({
               type:"ajax",
               url: 'gusto',
               type: 'POST',
               data: {email: 'jose'},
               dataType: 'json',
               success: function(){
                    alert('bien');
               },
               error: function(){
                   alert('mal');
               },
           })
       }
  })

