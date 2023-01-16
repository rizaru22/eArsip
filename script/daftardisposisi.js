$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbdaftardisposisi.php?action=table_data",    
         "type" : "POST"
      }
   });
  
});

