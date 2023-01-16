var save_method, table;
//Menampilkan data dengan plugin datatables dan konfigurasi datepicker
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbview_kepegawaian.php?action=table_data",    //"ajax/ajax_ujian.php?action=table_data",
         "type" : "POST"
      }
   });
   
});

function form_add(){
   save_method = "add";
   $('#modalData').modal('show');
   $('#modalData form')[0].reset();
   $('.modal-title').text('Input Data Pengguna');
}
function save_data(){
   if(save_method == "add") url = "ajax/dbview_kepegawaian.php?action=insert";
   else url = "ajax/dbview_kepegawaian.php?action=update";
   var formdata = new FormData();      
     $.each($('#modalData form').serializeArray(), function(a, b){
      formdata.append(b.name, b.value);
   });
   $.ajax({
       url : url,
      data : formdata,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
         if(data=="ok"){
            $('#modalData').modal('hide');
            table.ajax.reload();
         }else{
            alert(data);
         }
      },
      error: function(data){
         alert('Tidak dapat menyimpan data!');
      }
   });
   return false;
}

function form_edit(id){
   save_method = "edit";
   $('#modalData form')[0].reset();
   $.ajax({
      url : "ajax/dbview_kepegawaian.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modalData').modal('show');
         $('.modal-title').text('Ubah Data Kepegawaian');
         
         $('#id').val(data.id);
         $('#nama').val(data.nama);
         $('#nip').val(data.nip);
         $('#pangkat').val(data.pangkat);
         $('#jabatan').val(data.jabatan);
         $('#ttd').val(data.ttd);
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}

//Ketika tombol hapus diklik
function delete_data(id){
   if(confirm("Apakah yakin data akan dihapus?")){
      $.ajax({
        url : "ajax/dbview_kepegawaian.php?action=delete&id="+id,
        type : "GET",
        success : function(data){
           table.ajax.reload();
        },
        error : function(){
           alert("Tidak dapat menghapus data!");
        }
     });
   }
}