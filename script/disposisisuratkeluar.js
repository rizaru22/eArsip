var save_method, table;
//Menampilkan data dengan plugin datatables dan konfigurasi datepicker
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbdisposisisk.php?action=table_data",    //"ajax/ajax_ujian.php?action=table_data",
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
function form_datasurat(){
   $('#dataSuratKeluar').modal('show');
   $('#dataSuratKeluar form')[0].reset();
   $('.modal-title').text('Daftar Surat Keluar');
}

function reset_form(){
	$("#formDisposisi")[0].reset();
  $('#kirim').multiselect('refresh');

	
}

function daftar(){
		$('#isi').hide().load('view/daftardisposisisk.php').fadeIn('normal');
}

//Ketika tombol simpan diklik
function simpandata(){	
       url = "ajax/dbdisposisisk.php?action=insert";
    $.ajax({
      url : url,
      data : $('#formDisposisi').serialize(),
      type: 'POST',
      success: function(data) {
         if(data=="ok"){
           $("#printabel").remove();
                $("<iframe id='printabel'>")    
                //.hide()                     
                .attr("style","width:0;height:0;border:0;border:none;")
                .attr("src", "include/lembardisposisisk.php?action=cetak") 
                .appendTo("body");  
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


function pilih_data(id){
   //save_method = "edit";
   $('#dataSuratKeluar form')[0].reset();
   $.ajax({
      url : "ajax/dbdisposisisk.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         //$('#dataSuratMasuk').modal('show');
         //$('.modal-title').text('Ubah Data Surat Masuk');
			
         $('#idsurat').val(data.idsuratkeluar);
         $('#surat').val(data.nosurat);
		  $('#dataSuratKeluar').modal('hide');
               },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}