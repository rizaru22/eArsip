
var save_method, table;
//Menampilkan data dengan plugin datatables dan konfigurasi datepicker
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" :  "ajax/dbsuratumum.php?action=table_data",    //"ajax/ajax_ujian.php?action=table_data",
         "type" : "POST"
      }
   });

   //Konfigurasi datepicker
   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd', 
      autoclose: true
   });
   tinymce_config();
   
});
function reset_form(){
   save_method ="";
   $("#form_suratumum")[0].reset();
   $('#isi').hide().load('view/suratumum.php').fadeIn('normal');   
}

function daftar(){
   $('#DaftarSurat').modal('show');
   $('#DaftarSurat form')[0].reset();
   $('.modal-title').text('Daftar Surat Keterangan Sehat');
}
function loadOtherPage1(id) {
    $("<iframe id='printabel'>")    
        //.hide()                     
        .attr("style","width:0;height:0;border:0;border:none;")
        .attr("src", "include/surat_umum.php?action=tampil&id="+id) 
        .appendTo("body");           
    }

    function form_cetak(id){
       $("#printabel").remove();
    loadOtherPage1(id);
    }

function simpandata(){
   if (save_method=='edit'){
    url="ajax/dbsuratumum.php?action=update";
    id=$('#id').val();
  }
      else url="ajax/dbsuratumum.php?action=insert";
   $.ajax({
      url : url,
      data : $('#form_obat').serialize(),
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
                .attr("src", "include/surat_umum.php?action=cetak") 
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
function form_edit(id){
   save_method = "edit";
   $('#form_suratumum')[0].reset();
   $.ajax({
      url : "ajax/dbsuratumum.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
             
         $('#id').val(data.id);
         $('#nosurat').val(data.nosurat);
         $('#lampiran').val(data.lampiran);
         $('#perihal').val(data.perihal);
         $('#tanggal').val(data.tanggal);
         $('#tujuan').val(data.tujuan);
         $('#tempat').val(data.tempat);
         $('#isisurat').val(data.isi);
         $('#ttd').val(data.pejabat_ttd);
         $('#tembusan').val(data.tembusan);
         tinymce.get('isisurat').setContent(data.isi);
         tinymce.get('tembusan').setContent(data.tembusan);
          $('#DaftarSurat').modal('hide');
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}



 function tinymce_config(){
   tinyMCE.init({
      selector: "textarea",
      height: 250,
      fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
      setup: function (editor) {
         editor.on('change', function () {
            tinymce.triggerSave();
         });
      },
      plugins: [
         "advlist autolink lists link image charmap print preview anchor",
         "searchreplace visualblocks code fullscreen",
         "insertdatetime table contextmenu paste "
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | sizeselect | fontselect |  fontsizeselect",
	      
      //external_filemanager_path:"assets/filemanager/",
      //filemanager_title:"File Manager" ,
      //external_plugins: { "filemanager" : "../filemanager/plugin.min.js"}
   });
}
