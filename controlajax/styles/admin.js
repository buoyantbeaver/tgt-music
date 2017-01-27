$().ready(function() {  
   $('#add').click(function() {  
    return !$('#fromBoxCat option:selected').remove().appendTo('#cat');  
   });  
   $('#remove').click(function() {  
    return !$('#cat option:selected').remove().appendTo('#fromBoxCat');  
   });  
});
function xSongAlbum(album_id,remove_id) {
				 var order = "xSongAlbum=1&album_id="+album_id+'&remove_id='+remove_id;
				 $.post("update-album.php", order, function(theResponse){
						 	$('#LoadSongAlbum').html(theResponse);
						 });
}
function docheck(status,from_){

	var alen=document.media_list.checkbox.length;

	cb = document.media_list.checkbox;

	if (alen>0)

	{

		for(var i=0;i<alen;i++)

			if(document.media_list.checkbox[i].disabled==false)

				document.media_list.checkbox[i].checked=status;

	}

	else

		if(cb.disabled==false)

			cb.checked=status;

	if(from_>0)

		document.media_list.chkall.checked=status;

}



function docheckone(id){

	var alen=document.media_list.checkbox.length;

	var isChecked=true;

	if (alen>0){

		for(var i=0;i<alen;i++){

			if(document.media_list.checkbox[i].checked==false){

				isChecked=false;

			}

		}

	}else{

		if(document.media_list.checkbox.checked==false){

			isChecked=false;

		}

	}				

	document.media_list.chkall.checked=isChecked;

}

function check_checkbox()

{

	var alen=document.media_list.checkbox.length;

	var isChecked=false;

	if (alen>0) {

		for(var i=0;i<alen;i++)

			if(document.media_list.checkbox[i].checked==true) isChecked=true;

	}

	else {

		if(document.media_list.checkbox.checked==true) isChecked=true;

	}

	if (!isChecked){

		alert("Bạn chưa chọn ");

	}

	else if (confirm('Bạn có muốn thực hiên không ?')) return true;

		else return false;

	return isChecked;

}