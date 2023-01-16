var save_method, table;
//Menampilkan data dengan plugin datatables dan konfigurasi datepicker
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbdisposisiin.php?action=table_data",    //"ajax/ajax_ujian.php?action=table_data",
         "type" : "POST"
      }
   });
   $('#kirim').multiselect({
        nonSelectedText:'Pilih Pegawai',
        enableFiltering:true,
        enableCaseInsensitiveFiltering:true,
        buttonWidth:'340px',
      });
});

function pilih_data(id){
  setbaca(id);
   //save_method = "edit";
   $('#modalData form')[0].reset();
    $('#kirim').multiselect('refresh');
   $.ajax({
      url : "ajax/dbdisposisiin.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modalData').modal('show');
         $('.modal-title').text('Disposisikan Kembali');
		     $('#id').val(data.iddisposisi);
         $('#indeks').val("Re :"+data.indeks);
         $('#surat').val(data.noSurat);
         $('#idsurat').val(data.idSuratMasuk);
         $('#tingkat').val(data.tingkat);
         $('#instruksi').val("Re :"+data.instruksi);
        
      },
      error : function(data){
         alert("Tidak dapat menampilkan data!");
      }
   });

}

//Ketika tombol simpan diklik
function simpan_data(){	
    url = "ajax/dbdisposisiin.php?action=insert";
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
             $('#kirim').multiselect('refresh');
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

function setbaca(id){
       
      $.ajax({
        url : "ajax/dbdisposisiin.php?action=updatebaca&id="+id,
        type : "GET",
        success : function(data){
           table.ajax.reload();
        },
        error : function(){
           alert("Tidak dapat mengupdate data!");
        }
     });

  }