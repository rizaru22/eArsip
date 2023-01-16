var save_method, table;
//Menampilkan data dengan plugin datatables dan konfigurasi datepicker
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbsuratMasuk.php?action=table_data",    //"ajax/ajax_ujian.php?action=table_data",
         "type" : "POST"
      }
   });

   //Konfigurasi datepicker
   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd', 
      autoclose: true
   });
   
});

 //Menampilkan modal form  
 function form_add(){
   save_method = "add";
   $('#modalData').modal('show');
   $('#modalData form')[0].reset();
   $('.modal-title').text('Input Surat Masuk');
}

//Ketika tombol simpan diklik
function save_data(){
   if(save_method == "add") url = "ajax/dbsuratMasuk.php?action=insert";
   else url = "ajax/dbsuratMasuk.php?action=update";
   var formdata = new FormData();      
   var file = $('#file')[0].files[0];
   formdata.append('file', file);
   $.each($('#modalData form').serializeArray(), function(a, b){
      formdata.append(b.name, b.value);
   });
   $.ajax({
      url : url,
      data: formdata,
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

//Ketika tombol edit diklik
function form_edit(id){
   save_method = "edit";
   $('#modalData form')[0].reset();
   $.ajax({
      url : "ajax/dbsuratMasuk.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modalData').modal('show');
         $('.modal-title').text('Ubah Data Surat Masuk');
			
         $('#id').val(data.idSuratMasuk);
         $('#noAgenda').val(data.noAgenda);
         $('#noSurat').val(data.noSurat);
         $('#tanggalSurat').val(data.tanggalSurat);
         $('#tanggalTerima').val(data.tanggalTerima);
         $('#sumber').val(data.sumber);
         $('#tujuan').val(data.tujuan);
         $('#perihal').val(data.perihal);
         $('#keterangan').val(data.keterangan);
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
        url : "ajax/dbsuratMasuk.php?action=delete&id="+id,
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