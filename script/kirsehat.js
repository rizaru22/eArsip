var save_method, table;
//Menampilkan data dengan plugin datatables dan konfigurasi datepicker
$(function(){
   table = $('#table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbkirsehat.php?action=table_data",    //"ajax/ajax_ujian.php?action=table_data",
         "type" : "POST"
      }
   });

   //Konfigurasi datepicker
   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      startView:"decade",
      minView:"decade",      
      autoclose: true
   });
  
});

function loadOtherPage1(id) {
    $("<iframe id='printabel'>")    
        //.hide()                   
        .attr("style","width:0;height:0;border:0;border:none;")  
        .attr("src", "include/surat_kirsehat.php?action=tampil&id="+id) 
        .appendTo("body");           
    }

    function form_cetak(id){
       $("#printabel").remove();
    loadOtherPage1(id);
    }

function reset_form(){
  save_method='';
   $("#form_kirsehat")[0].reset();
   $('#isi').hide().load('view/kirsehat.php').fadeIn('normal');   
}

function simpandata(){
   if (save_method=='edit') {
    url="ajax/dbkirsehat.php?action=update";
    id=$('#id').val();
  }
   else url="ajax/dbkirsehat.php?action=insert";
   $.ajax({
      url : url,
      data : $('#form_kirsehat').serialize(),
      type: 'POST',
      success: function(data) {
         if(data=="ok"){
            if(save_method=='edit'){
              form_cetak(id);
            }
            else{
               $("#printabel").remove();
                $("<iframe id='printabel'>")    
                //.hide()                     
                .attr("style","width:0;height:0;border:0;border:none;")
                .attr("src", "include/surat_kirsehat.php?action=cetak") 
                .appendTo("body");   
            }
           reset_form();
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

function daftar(){
   $('#DaftarSurat').modal('show');
   $('#DaftarSurat form')[0].reset();
   $('.modal-title').text('Daftar Surat Keterangan Sehat');
}

function form_edit(id){
   save_method = "edit";
   $('#form_kirsehat')[0].reset();
   $.ajax({
      url : "ajax/dbkirsehat.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
             
         $('#id').val(data.id);
         $('#nosurat').val(data.nosurat);
         $('#nama').val(data.nama);
         $('#tempat_lahir').val(data.tempat_lahir);
         $('#tanggal_lahir').val(data.tanggal_lahir);
         $('#pekerjaan').val(data.pekerjaan);
         $('#alamat').val(data.alamat);
         $('#berat_badan').val(data.berat_badan);
         $('#golongan_darah').val(data.golongan_darah);
         $('#tinggi_badan').val(data.tinggi_badan);
         $('#buta_warna').val(data.buta_warna);
         $('#keterangan').val(data.keterangan);
         $('#keperluan').val(data.keperluan);
         $('#dokter').val(data.dokter);
          $('#DaftarSurat').modal('hide');
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}