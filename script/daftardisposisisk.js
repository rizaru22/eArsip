$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbdaftardisposisisk.php?action=table_data",    
         "type" : "POST"
      }
   });
  
});

