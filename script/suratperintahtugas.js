var save_method, table;
//Menampilkan data dengan plugin datatables dan konfigurasi datepicker
$(function(){
   table = $('#table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbspt.php?action=table_data",    //"ajax/ajax_ujian.php?action=table_data",
         "type" : "POST"
      }
   });

   //Konfigurasi datepicker
   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd', 
      autoclose: true
   });

    $('#daftarpegawai').multiselect({
        nonSelectedText:'Pilih Pegawai',
        enableFiltering:true,
        enableCaseInsensitiveFiltering:true,
        buttonWidth:'340px',
      });
   
});

function loadOtherPage1(id) {
    $("<iframe id='printabel'>")    
        //.hide()                
        .attr("style","width:0;height:0;border:0;border:none;")     
        .attr("src", "include/spt.php?action=tampil&id="+id) 
        .appendTo("body");           
    }

function form_cetak(id){
       $("#printabel").remove();
    loadOtherPage1(id);
}

function reset_form(){
  save_method='';
   $("#formSPT")[0].reset();
   $('#isi').hide().load('view/buatSurat.php').fadeIn('normal');   
}

function simpandata(){
   if (save_method=='edit'){ 
    url="ajax/dbspt.php?action=update";
    id=$('#id').val();
  }
      else url="ajax/dbspt.php?action=insert";
   $.ajax({
      url : url,
      data : $('#formSPT').serialize(),
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
                .attr("src", "include/spt.php?action=cetak") 
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
   $('.modal-title').text('Daftar Surat Perintah Tugas');
}

function form_edit(id){
   save_method = "edit";
    $("#formSPT")[0].reset();
   $.ajax({
      url : "ajax/dbspt.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         var daftarpegawai = data.pegawai.split(',');
         for(i=0; i<daftarpegawai.length; i++){
            //$('[value='+daftarpegawai[i]+']').attr('checked', true);
              $('option[value='+daftarpegawai[i]+']', $('#daftarpegawai')).prop('selected', true);
         }
         $('#daftarpegawai').multiselect('refresh');

         $('#id').val(data.id);
         $('#nosurat').val(data.nosurat);
         $('#tugas').val(data.tugas);
         $('#tanggal_pelaksanaan').val(data.tanggal_pelaksanaan);
         $('#lama_tugas').val(data.lama_tugas);
         $('#tempat').val(data.tempat);
         $('#pembebanan_biaya').val(data.pembebanan_biaya);
         $('#tanggal_ttd').val(data.tanggal_ttd);
         $('#ttd').val(data.pejabat_ttd);
         $('#DaftarSurat').modal('hide');
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}
