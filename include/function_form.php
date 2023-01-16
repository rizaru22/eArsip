<?php
//Fungsi untuk membuka modal dan form
function open_form($modal_id, $action){
   echo '<div class="modal fade" id="'.$modal_id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
				  
<form class="form-horizontal" enctype="multipart/form-data"  onsubmit="'.$action.'">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
      <h3 class="modal-title"></h3>
   </div>
				
   <div class="modal-body">
      <input type="hidden" name="id" id="id">';
}

//Fungsi untuk membuat kotak input
function create_textbox($label, $name, $type="text", $width='5', $class="", $attr=""){
   echo'<div class="form-group">
   <label for="'.$name.'" class="col-sm-2 control-label"> '.$label.'</label>
   <div class="col-sm-'.$width.'">
      <input type="'.$type.'" class="form-control '.$class.'" id="'.$name.'" name="'.$name.'" '.$attr.'>
   </div> </div>';
}

//Fungsi untuk membuat textarea
function create_textarea($label, $name, $class='', $attr='',$width='4'){
   echo'<div class="form-group">
   <label for="'.$name.'" class="col-sm-2 control-label"> '.$label.'</label>
   <div class="col-sm-'.$width.'">
     <textarea class="form-control '.$class.'" id="'.$name.'" rows="4" name="'.$name.'" '.$attr.'></textarea>
   </div> </div>';
}

//Fungsi untuk membuat checkbox
function create_checkbox($label, $name, $list){
   echo '<div class="form-group" id="'.$name.'">
   <label class="col-sm-2 control-label">'.$label.'</label>
   <div class="col-sm-6">';

foreach($list as $ls){
   echo' <input type="checkbox" name="'.$name.'[]" value="'.$ls[0].'" style="margin-left: 30px"> '.$ls[1];
}
	
   echo '</div></div>';
}

//Fungsi untuk membuat combobox / select box
function create_combobox($label, $name, $list, $width='5', $class="", $attr=""){
   echo'<div class="form-group">
   <label for="'.$name.'" class="col-sm-2 control-label"> '.$label.'</label>
   <div class="col-sm-'.$width.'">
      <select class="form-control '.$class.'" name="'.$name.'" id="'.$name.'" '.$attr.'>
         <option value="">- Pilih -</option>';

foreach($list as $ls){
   echo '<option value='.$ls[0].'>'.$ls[1].'</option>';
}
	
   echo '</select>
   </div> </div>';
}

function create_combobox_multi($label, $name, $list, $width='5', $class="", $attr=""){
   echo'<div class="form-group">
   <label for="'.$name.'" class="col-sm-2 control-label"> '.$label.'</label>
   <div class="col-sm-'.$width.'">
      <select class="form-control '.$class.'" multiple name="'.$name.'[]" id="'.$name.'" '.$attr.'>';
         
foreach($list as $ls){
   echo '<option value='.$ls[0].'>'.$ls[1].'</option>';
}
   
   echo '</select>
   </div> </div>';
}

function create_mediapicker($label, $nama, $lebar='4', $tipe="0", $modal_id="" ){
	?>
		<script>
			$(function(){
				$('#filemanager-<?php echo $nama; ?>').on('hidden.bs.modal', function (e) {
					$('#<?php echo $modal_id; ?>').modal('show');
				})
			});
		</script>
	<?php
	echo'<div class="form-group">
			<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">
			<div class="input-group">
			  <input type="text" class="form-control input-'.$nama.'" id="'.$nama.'" name="'.$nama.'"  readonly>
			  <a data-toggle="modal" data-target="#filemanager-'.$nama.'" class="input-group-addon btn btn-primary pilih-'.$nama.'">...</a>
			</div>
			</div>
			<div class="modal fade mediapicker" id="filemanager-'.$nama.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">File Manager</h4>
						</div>
						<div class="modal-body">
							<iframe src="../assets/filemanager/dialog.php?type='.$tipe.'&field_id='.$nama.'&relative_url=1" width="100%" height="400" style="border: 0"></iframe>
						</div>
					</div>
				</div>
			</div>
		 </div>';
}

function close_form($icon="floppy-disk", $button="Simpan"){
   echo'</div>
   <div class="modal-footer">
   <button type="submit" class="btn btn-primary btn-save">
   <i class="glyphicon glyphicon-'.$icon.'"></i> '.$button.'
   </button>
   <button type="button" class="btn btn-warning" data-dismiss="modal">
   <i class="glyphicon glyphicon-remove-sign"></i> Close
   </button>
   </div>
		
   </form></div></div></div>';
}
function close_form2(){
   echo'</div>
   <div class="modal-footer">
   <button type="button" class="btn btn-warning" data-dismiss="modal">
   <i class="glyphicon glyphicon-remove-sign"></i> Close
   </button>
   </div>
		
   </form></div></div></div>';
}
?>