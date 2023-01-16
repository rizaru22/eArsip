$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbdisposisiout.php?action=table_data",    
         "type" : "POST"
      }
   });
  
});