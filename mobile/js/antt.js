function check_login(){
 var username=document.getElementById("username").value;
 var password=document.getElementById("password").value;
 var password2=document.getElementById("password2").value;
 var email=document.getElementById("email").value;
 var params = "username="+username+"&password="+password+"&password2="+password2+"&email="+email;
		   var url = "checkdangky.php";
				$.ajax({
							   type: 'POST',
							   url: url,
							   dataType: 'html',
							   data: params,
							   beforeSend: function() {
							     document.getElementById("status").innerHTML= ''  ;
										 },
							   complete: function() {
										
							   },
							   success: function(html) {
							   
							   		 
									 document.getElementById("status").innerHTML= html;
									 if(html=="Thành công"){
									  
									   window.location = "dangkythanhcong.html"
									 
									 }
									 
							    }
					   });
}
function login_antt(){
  var username=document.getElementById("username").value;
  var password=document.getElementById("password").value;
 
    var params = "username="+username+"&password="+password;
		   var url = "checkuser.php";
				$.ajax({
							   type: 'POST',
							   url: url,
							   dataType: 'html',
							   data: params,
							   beforeSend: function() {
							     document.getElementById("status").innerHTML= ''  ;
										 },
							   complete: function() {
										
							   },
							   success: function(html) {
							   
							   		 
									 document.getElementById("status").innerHTML= html;
									 if(html=="Thành công"){
									  
									   window.location = "danh-muc.html"
									 
									 }
									 
							    }
					   });
 }
 function Add_Song(add_id,type){
  var add_id=document.getElementById("btnLiked").name;
     var params = "FAV=1&add_id="+add_id+"&type="+type;
		   var url = "addsong.php";
				$.ajax({
							   type: 'POST',
							   url: url,
							   dataType: 'html',
							   data: params,
							   beforeSend: function() {
							     document.getElementById("status").innerHTML= ''  ;
										 },
							   complete: function() {
										
							   },
							   success: function(html) {
							   
							   		 
									 document.getElementById("status").innerHTML= html;
									 if(html=="success"){
									  
									   window.location = "danh-muc.html"
									 
									 }
									 
							    }
					   })
  
}
function Add_Video(add_id,type){
  var add_id=document.getElementById("btnLiked").name;
     var params = "FAV=1&add_id="+add_id+"&type="+type;
		   var url = "addvideo.php";
				$.ajax({
							   type: 'POST',
							   url: url,
							   dataType: 'html',
							   data: params,
							   beforeSend: function() {
							     document.getElementById("status").innerHTML= ''  ;
										 },
							   complete: function() {
										
							   },
							   success: function(html) {
							   
							   		 
									 document.getElementById("status").innerHTML= html;
									 if(html=="success"){
									  
									   window.location = "danh-muc.html"
									 
									 }
									 
							    }
					   });

}
function Add_List(add_id,type){
  var add_id=document.getElementById("btnLiked").name;
     var params = "FAV=1&add_id="+add_id+"&type="+type;
		   var url = "addalbum.php";
				$.ajax({
							   type: 'POST',
							   url: url,
							   dataType: 'html',
							   data: params,
							   beforeSend: function() {
							     document.getElementById("status").innerHTML= ''  ;
										 },
							   complete: function() {
										
							   },
							   success: function(html) {
							   
							   		 
									 document.getElementById("status").innerHTML= html;
									 if(html=="success"){
									  
									   window.location = "danh-muc.html"
									 
									 }
									 
							    }
					   });
}
