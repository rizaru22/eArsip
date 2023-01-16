$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbdisposisiskterima.php?action=table_data",    //"ajax/ajax_ujian.php?action=table_data",
         "type" : "POST"
      }
   });

    
});

function setbaca(id){
       
      $.ajax({
        url : "ajax/dbdisposisiskterima.php?action=updatebaca&id="+id,
        type : "GET",
        success : function(data){
           table.ajax.reload();
        },
        error : function(){
           alert("Tidak dapat mengupdate data!");
        }
     });

  }