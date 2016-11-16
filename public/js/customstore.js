 $(document).ready(function() {
	   
		var id= $(".departments_id").val();
		
		var ids= $(".departments_productid").val();
		if(ids !=undefined){
			id =ids;
		}
		
		
		if(id){
			
		var category= $("#categorys_id").val();
		var producttype= $("#producttype").val();
		
		cats_id=$('#cats_id').val();
			if(cats_id ==undefined){
			cats_id='';
		    }
		if(category ==undefined){
			category='';
		}
		var parents =$("#category").val();
		//alert(parents);
		 jQuery.ajax({
             type: 'POST',
             url: base_url + '/changedpt',
             dataType: 'json',
             data: {'id':id},
             success: function(res) {
                 if(res){
					  var active ='';var red ='';
					  var active1 =''; var red2 ='';var red3 ='';
					  var red1 ='';
					  var active2 =''; 
					  var active3 ='';
					 var newOption ="<ul class='category'>";
					 $(res).each(function() {
                          if(this.subCategory.length==0){
							  var active ="active";
						  }
						  if(parents==this.id){
							  var red ="red";
						  }
						  if(cats_id==this.id){
							  var onclick ='data-toggle="modal" data-target="#DeleteModalparent"';
						  }else{
							   var onclick ="onClick='getCategory(this)'";
						  }
						  console.log(1);
                         newOption += '<li class="active"><a class='+red+' '+onclick+' data-id='+this.id+'>'+this.categoryname+'</a><ul style="display:block">';
                         $(this.subCategory).each(function() {
							   if(this.subCategory.length==0){
							     var active1 ="active";
						       }
							    if(parents==this.id){
							       var red1 ="red";
						       }
							   if(cats_id==this.id){
							      var onclick ='data-toggle="modal" data-target="#DeleteModalparent"';
						       }else{
							      var onclick ="onClick='getCategory(this)'";
						       }
							   newOption +='<li  class="active"><a class='+red1+' '+onclick+'  data-id='+this.id+'>'+this.categoryname+'</a><ul style="display:block">';  
					            $(this.subCategory).each(function() {
									if(this.subCategory.length==0){
							          var active2 ="active";
						            }
									if(parents==this.id){
							           var red2 ="red";
						           }
								   if(cats_id==this.id){
							          var onclick ='data-toggle="modal" data-target="#DeleteModalparent"';
						            }else{
							          var onclick ="onClick='getCategory(this)'";
						           }
									newOption +='<li  class="active"><a class='+red2+'  '+onclick+'  data-id='+this.id+'>'+this.categoryname+'</a><ul style="display:block">';  
					               $(this.subCategory).each(function() {
								      if(parents==this.id){
							           var red3 ="red";
						              }
									  if(producttype =='product'){
											var model ='onClick="getCategory(this)" ';
										}else{
											
											var model ='data-toggle="modal" data-target="#DeleteModal" ';
										}
									  
									 newOption +='<li><a  class='+red3+' '+model+' data-id='+this.id+'>'+this.categoryname+'</a> </li>';  
						           });
								   newOption +='</ul></li>';
							   });
								newOption +='</ul></li>';
								
						   });
						   newOption +='</ul></li>';
					 });
					 newOption +='</ul>';
					 $(".sss").html(newOption);
					 $('.tree li').each(function() {
						 if ($(this).children('ul').length > 0) {
							 $(this).addClass('parent');
						 }
					 });
				 }

                }
         });
		}
	   
	    var url      = window.location.href;
        $('.sidebar-menu li a').each(function(){
        var li_url=$(this).attr('href');
          if(li_url==url){
           $(this).parents('li').addClass('active');
           }
        });
		 $('#side-menu').metisMenu();
     var type = $("input[name=type]:checked").val();
     if (type) {
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/getdepatments',

             data: {
                 'type': type
             },
             dataType: 'JSON',
             success: function(res) {

                 var newOption = '';
				  if(res[0].name!='general'){
					  newOption += '<option selected="selected">Select option</option>';
				 }
                 if (res != '') {
                     $(res).each(function() {

                         newOption += '<option value=' + this.id + '>' + this.name + '</option>';
                     });
                 } else {
                     newOption += '<option ></option>';
                     alert("Please add Departments");
                 }
                 $('#departments_id').html(newOption);
				 var dpt =$("#dpt_id").val();
				 if(dpt !=undefined){
				 setTimeout(function() {
                     $("#departments_id").val(dpt);
                     
                 }, 500);
			     }
                 if (type == '1') {

                     $(".dpts").removeClass("hide");
                     $(".sdpt").removeClass("hide");
                     $(".nodpt").addClass("hide");

                 } else {

                     $(".dpts").addClass("hide");
                     $(".sdpt").addClass("hide");
                     $(".nodpt").removeClass("hide");
                 }
             }
         });

     }
     $('.tree li').each(function() {
         if ($(this).children('ul').length > 0) {
             $(this).addClass('parent');
         }
     });

     /*$('.tree li.parent > a').click(function() {
         $(this).parent().toggleClass('active');
         $(this).parent().children('ul').slideToggle('fast');
     });

     $('#all').click(function() {

         $('.tree li').each(function() {
             $(this).toggleClass('active');
             $(this).children('ul').slideToggle('fast');
         });
     });*/
     var types = $("input[name=type]:checked").val();
     if (types == 1) {
         $(".dpts").removeClass("hide");
     } else {
         $(".dpts").addClass("hide");

     }
     var max_fields = 10; //maximum input boxes allowed
     var wrapper = $(".input_fields_wrap"); //Fields wrapper
     var add_button = $(".add_field_button");
     var x = 1;
     var y = $(".dpti").val();
     $("#add").click(function(e) { //on add input button click
         e.preventDefault();
         if (y < max_fields) { //max input box allowed
             y++; //text box increment
             $(wrapper).append('<div class="form-group" ><label class="col-lg-2 control-label">Dept ' + y + '</label><div class="col-lg-8"><input type="text" placeholder="Department ' + y + '" class="form-control" name="name[]" required><br><input type="file" name="image"></div> <span class="" onClick="remove(this)"><img src="' + base_url + '/img/remove-icon.png" ></span></div>'); //add input box
         }
     });
     // $(".stores").hide();
 });

 function remove(sel) {
     //alert("df");
     //var y = $(".dpti").val();
     $(sel).parent().remove();
 }

/* function Editstore() {
     if ($('#store').parsley().validate()) {
         var form = $('#store').serializeArray();
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/editstoredata',

             dataType: 'json',
             data: form,

             success: function(res) {
                 $(".changepasres").show();
                 $(".changepasres").focus();

                 $('html, body').animate({
                     scrollTop: $(".changepasres").offset().top - 100
                 }, 'fast');
                 $(".changepasres").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".changepasres").hide();
                 }, 2000);

             }
         });
     }
 }*/
 function Editstore() {  
     if ($('#store').parsley().validate()) {
        

         $('#store').ajaxForm(function(options) {
             var items = JSON.parse(options);
              var s = items.msg;
             $('html, body').animate({
                 scrollTop: $(".changepasres").offset().top - 100
             }, 'fast');
             $(".changepasres").show();
             $(".changepasres").html('<p class="alert alert-success">' + s + '</p>');
			 if(items.image){
				 $(".imageshow").html('<img src=' + base_url + '/' + items.image + ' width="50%" height="50px">');
			 }
              

              setTimeout(function() {
                        $(".changepasres").hide();location.reload();
                        //window.location.replace(base_url + "/editstore");
                    }, 1500);

         });
     }
 }
 function deleteuser(elm) {

     var id = $(elm).data("id");



     var r = confirm("Are you sure want to delete the user details ");
     if (r == true) {
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/deleteuser',

             dataType: 'json',
             data: {
                 'id': id
             },
             success: function(res) {
                 $(".usersres").html('<p class="alert alert-success">' + res.msg + '</p>');
                 location.reload();


             }
         });

     }


 }

 function edituser(elm) {

     var id = $(elm).data("id");
     jQuery.ajax({
         type: 'POST',
         url: base_url + '/getuserdetails',

         dataType: 'json',
         data: {
             'id': id
         },
         success: function(res) {
             var ids = res[0].uneaque_id;
             var role_id = res[0].role_id;
             var firstname = res[0].firstname;
             var lastname = res[0].lastname;
             var email = res[0].email;
             //alert(role_id);
             $('#uneaque_ids').val(ids);
             $('#role_id').val(role_id);
             //$("#role_id").val(role_id);
             $("#role_id").val(role_id).trigger("change");
             $('#role_id').find('option[value="' + role_id + '"]').prop('selected', true);
             $('#firstname').val(firstname);
             $('#id_edit').val(id);
             $('#lastname').val(lastname);
             $('#email').val(email);
             $(".edit").click();
         }
     });


 }

 function editCreated() {
     if ($('.edituser').parsley().validate()) {
         var form = $('.edituser').serializeArray();
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/edituser',

             dataType: 'json',
             data: form,
             success: function(res) {
                 $(".editsucess").show();
                 $('html, body').animate({
                     scrollTop: $(".editsucess").offset().top - 100
                 }, 'fast');
                 $(".editsucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                 if (res.status == 'success') {
                     // $('.edituser')[0].reset();
                     location.reload();

                 }

             }
         });
     }
 }

 function Create() {
     if ($('.create_user').parsley().validate()) {
         var form = $('.create_user').serializeArray();
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/createuserstore',

             dataType: 'json',
             data: form,
             success: function(res) {
                 $(".usersucess").show();
                 $('html, body').animate({
                     scrollTop: $(".usersucess").offset().top - 100
                 }, 'fast');
                 $(".usersucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                 if (res.status == 'success') {
                     $('.create_user')[0].reset();
                     location.reload();

                 }

             }
         });
     }
 }
function dept() {
    if ($('#dept').parsley().validate()) {
        var form = $('#dept').serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: base_url + '/adddept',

            dataType: 'json',
            data: form,
            success: function(res) {
                $(".dptsucess").show();
                 $('html, body').animate({
                     scrollTop: $(".dptsucess").offset().top - 100
                 }, 'fast');
                 $(".dptsucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".dptsucess").hide();
                     location.reload();
                 }, 1500);
                if (res.status == 'success') {
                    //$('#dept')[0].reset();
                   // location.reload();

                }

            }
        });
    }
}

 function editdept() {
     if ($('#dept').parsley().validate()) {
         var form = $('#dept').serializeArray();
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/editdept',

             dataType: 'json',
             data: form,
             success: function(res) {
                 $(".dptsucess").show();
                 $('html, body').animate({
                     scrollTop: $(".dptsucess").offset().top - 100
                 }, 'fast');
                 $(".dptsucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".dptsucess").hide();
                    // location.reload();
                 }, 1500);
                 if (res.status == 'success') {
                     //$('#dept')[0].reset();
                     //location.reload(); 

                 }

             }
         });
     }
 }

 function Getdpttype(sel) {
     var type = jQuery(sel).val();
     var id = jQuery(sel).data('id');

     jQuery.ajax({
         type: 'POST',
         url: base_url + '/getdepatments',

         data: {
             'type': type
         },
         dataType: 'JSON',
         success: function(res) {

             var newOption = '';
             if (res != '') {
				 
				 if(res[0].name!='general'){
					  newOption += '<option selected="selected">Select option</option>';
				 }
				
                 $(res).each(function() {

                     newOption += '<option value="' + this.id + '">' + this.name + '</option>';
                 });
             } else {
                 newOption += '<option ></option>';
                 alert("Please add Departments");
             }
             $('#departments_id').html(newOption);
			 var dpt =$("#dpt_id").val();
			 if(dpt!=undefined){
			 $("#departments_id").val(dpt).trigger("change");
			 }
             if (type == '1') {
                 $('#category').val(id);
                 $(".dpts").removeClass("hide");
                 $(".sdpt").removeClass("hide");
                 $(".nodpt").addClass("hide");

             } else {
                 $('#category').val(id);
                 $(".dpts").addClass("hide");
                 $(".sdpt").addClass("hide");
                 $(".nodpt").removeClass("hide");
             }
         }
     });




 } function GetdpttypeSearch(sel) {
     var type = jQuery(sel).val();
     var id = jQuery(sel).data('id');

     jQuery.ajax({
         type: 'POST',
         url: base_url + '/getdepatments',

         data: {
             'type': type
         },
         dataType: 'JSON',
         success: function(res) {

             var newOption = '';
             if (res != '') {
				 
				 if(res[0].name!='general'){
					  newOption += '<option selected="selected">Select option</option>';
					  newOption += '<option value="0">All</option>';
				 }
				
                 $(res).each(function() {

                     newOption += '<option value="'+ this.name +'">' + this.name + '</option>';
                 });
             } else {
                 newOption += '<option ></option>';
                 alert("Please add Departments");
             }
             $('#departments_id').html(newOption);
			 var dpt =$("#dpt_id").val();
			 if(dpt!=undefined){
			 $("#departments_id").val(dpt).trigger("change");
			 }
             if (type == '1') {
                 $('#category').val(id);
                 $(".dpts").removeClass("hide");
                 $(".sdpt").removeClass("hide");
                 $(".nodpt").addClass("hide");

             } else {
                 $('#category').val(id);
                 $(".dpts").addClass("hide");
                 $(".sdpt").addClass("hide");
                 $(".nodpt").removeClass("hide");
             }
         }
     });




 }

 function getCategory(elm) {
     $(".category li a").removeClass("red");
     $(elm).addClass("red");
     var id = $(elm).data("id");
     $("#category").val(id);
$(elm).parent().toggleClass('active');
         $(elm).parent().children('ul').slideToggle('fast');
 }

 /*function Catogoryadd() {
     if ($('#Catogoryadd').parsley().validate()) {
         if (!$("#category").val()) {
             alert("Please Select Category");
             return false;
         }
         var form = $('#Catogoryadd').serializeArray();
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/addcategory',

             dataType: 'json',
             data: form,
             success: function(res) {
                 $(".dptsucess").show();
                 $('html, body').animate({
                     scrollTop: $(".dptsucess").offset().top - 100
                 }, 'fast');
                 $(".dptsucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".dptsucess").hide();
                     location.reload();
                 }, 1500);
                 if (res.status == 'success') {
                     $('#Catogoryadd')[0].reset();
                     //location.reload(); 

                 }

             }
         });
     }
 }*/
 function Catogoryadd() {
     if ($('#Catogoryadd').parsley().validate()) {
		  
         $('#Catogoryadd').ajaxForm(function(options) {
             var items = JSON.parse(options);
             var s = items.msg;
                if (items.pic) {

                 $(".imageshow").html('<img src=' + base_url + '/' + items.pic + ' width="69%" height="100px">');
                 }
              $(".dptsucess").show();
                 $('html, body').animate({
                     scrollTop: $(".dptsucess").offset().top - 100
                 }, 'fast');
				 
                 $(".dptsucess").html('<p class="alert alert-success">' + items.msg + '</p>');
                 setTimeout(function() {
                     $(".dptsucess").hide();
                     location.reload();
                 }, 2000);
                 if (items.status == 'success') {
                     $('#Catogoryadd')[0].reset();
                     //location.reload(); 

                 }
         });
     }
 }
function Catogoryedit() {
     if ($('#Catogoryadd').parsley().validate()) {
		  
         $('#Catogoryadd').ajaxForm(function(options) {
             var items = JSON.parse(options);
             var s = items.msg;
                if (items.pic) {

                 $(".imageshow").html('<img src=' + base_url + '/' + items.pic + ' width="69%" height="100px">');
                 }
              $(".dptsucess").show();
                 $('html, body').animate({
                     scrollTop: $(".dptsucess").offset().top - 100
                 }, 'fast');
				 
                 $(".dptsucess").html('<p class="alert alert-success">' + items.msg + '</p>');
                 
                 if (items.status == 'success') {
                     //$('#Catogoryadd')[0].reset();
                     //location.reload(); 
                    setTimeout(function() {
                     $(".dptsucess").hide();
                     location.reload();
                 }, 2000);
                 }
         });
     }
 }

 /*function Catogoryedit() {
     if ($('#Catogoryadd').parsley().validate()) {
         if (!$("#category").val()) {
             alert("Please Select Category");
             return false;
         }
         var form = $('#Catogoryadd').serializeArray();
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/editscategorylist',

             dataType: 'json',
             data: form,
             success: function(res) {
                 $(".dptsucess").show();
                 $('html, body').animate({
                     scrollTop: $(".dptsucess").offset().top - 100
                 }, 'fast');
                 $(".dptsucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".dptsucess").hide();
                     location.reload();
                 }, 1500);
                 if (res.status == 'success') {
                     // $('#Catogoryadd')[0].reset();
                     //location.reload(); 

                 }

             }
         });
     }
 }*/

 function TakeId(elm) {
     var id = $(elm).data("id");
     $("#addCategory_id").val(id);
 }

 function DeleteCategory() {
     var id = $("#addCategory_id").val();

     jQuery.ajax({
         type: 'POST',
         url: base_url + '/deletecategory',

         dataType: 'json',
         data: {
             'id': id
         },
         success: function(res) {
             $(".deletesucess").show();


             if (res.status == 'success') {
                 $(".deletesucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".deletesucess").hide();
                     $('#DeleteModal').modal('hide');
                     location.reload();
                 }, 2000);


             } else {
                 $(".deletesucess").html('<p class="alert alert-danger">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".deletesucess").hide();
                 }, 2000);
             }

         }
     });

 }

 function DeleteProduct() {
     var id = $("#addCategory_id").val();

     jQuery.ajax({
         type: 'POST',
         url: base_url + '/deleteproduct',

         dataType: 'json',
         data: {
             'id': id
         },
         success: function(res) {
             $(".deletesucess").show();


             if (res.status == 'success') {
                 $(".deletesucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".deletesucess").hide();
                     $('#DeleteModal').modal('hide');
                     location.reload();
                 }, 2000);


             }

         }
     });

 }

 function AddProduct() {
     if ($('#addproduct').parsley().validate()) {
         $('#addproduct').ajaxForm(function(options) {
             var items = JSON.parse(options);
             var s = items.msg;

             //var url =base_url;
             if (items.pic) {

                 $(".imageshow").html('<img src=' + base_url + '/' + items.pic + ' width="69%" height="100px">');
             }
             $('html, body').animate({
                 scrollTop: $(".uploadsucess").offset().top - 100
             }, 'fast');
             $(".uploadsucess").show();
             $(".uploadsucess").html('<p class="alert alert-success">' + s + '</p>');

             setTimeout(function() {
                 $(".uploadsucess").hide();window.location.href=base_url+"/listproduct"; 
             }, 2000);

         });
     }
 }

 function EditProduct() {
     if ($('#addproduct').parsley().validate()) {
         $('#addproduct').ajaxForm(function(options) {
             var items = JSON.parse(options);
             var s = items.msg;

             //var url =base_url;
             if (items.pic) {
                 $(".imageshow").show();
                 $(".imageshow").html('<img src=' + base_url + '/' + items.pic + ' width="69%" height="100px">');
             }
             $('html, body').animate({
                 scrollTop: $(".uploadsucess").offset().top - 100
             }, 'fast');
             $(".uploadsucess").show();
             $(".uploadsucess").html('<p class="alert alert-success">' + s + '</p>');

             setTimeout(function() {
                 $(".uploadsucess").hide();
                 location.reload();
             }, 2000);

         });
     }
 }

 function RemovePic(elm) {
     var id = $(elm).data('id');

     jQuery.ajax({
         type: 'POST',
         url: base_url + '/removepic',

         dataType: 'json',
         data: {
             'id': id
         },
         success: function(res) {
             $(".deletesucess").show();
             $(".deletesucess").html('<p class="alert alert-success">' + res.msg + '</p>');
             setTimeout(function() {
                 $(".deletesucess").hide();
                 $('#DeleteModal').modal('hide');
                 location.reload();
             }, 2000);




         }
     });

 }

 function Departments(elm) {
     var id = $(elm).val();
     jQuery.ajax({
         type: 'POST',
         url: base_url + '/selectcategory',

         dataType: 'json',
         data: {
             'id': id
         },
         success: function(res) {
             var newOption = '<ul class="category">';
             //var  newOption='';
             $(res).each(function() {

                 newOption += '<li><a  onClick="getCategory(this)" data-id="' + this.id + '">' + this.categoryname + '</a><ul>';
                 $(this.children).each(function() {
                     newOption += '<li  ><a  onClick="getCategory(this)" data-id="' + this.id + '"> ' + this.categoryname + '</a></li>';
                 });
                 newOption += '</ul>';
             });
             $('.tree').html(newOption);

         }
     });


 }

 function profile() {
     if ($('.profile').parsley().validate()) {
         var form = $('.profile').serializeArray();
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/storeprofiles',
             dataType: 'json',
             data: form,
             success: function(res) {

                 if (res.status == 'success') {
                     // $('#dept')[0].reset();
                     //location.reload(); 
                     $(".profilesucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                     setTimeout(function() {
                         $(".profilesucess").hide();
                     }, 1000);
                 }

             }
         });
     }
 }

 function Changepass() {
     if ($('#changepass').parsley().validate()) {
         var form = $('#changepass').serializeArray();
         jQuery.ajax({
             type: 'POST',
             url: base_url + '/changepassed',
             dataType: 'json',
             data: form,
             success: function(res) {
                 $(".changepasres").html('<p class="alert alert-success">' + res.msg + '</p>');
                 if (res.status == 'success') {
                     $('#changepass')[0].reset();
                     //location.reload(); 

                 }

             }
         });
     }
 }
  function SaveImportss(){
	  alert($("#category").val());
	  var id =$("#category").val();
	 if (!id) {
             alert("Please Select Category");
             return false;
            }
	if (!id) {
             alert("Please Select Category");
             return false;
       }
			SaveImport();	
			
			
 }
 function SaveImport(){
	     var id =$("#category").val();
	 if (!id) {
             alert("Please Select Category");
             return false;
            }
	   if ($('#form').parsley().validate()) {
		   
		    $('#form').ajaxForm(function(options) {
             var items = JSON.parse(options);
             var s = items.msg;
                $('html, body').animate({
					scrollTop: $(".uploadsucess").offset().top - 100
				 }, 'fast');
				 $(".uploadsucess").show();
             //var url =base_url;
              if (items.status == 'success') {
				 
				 
				  $(".uploadsucess").html('<p class="alert alert-success">' + s + '</p>');
			    }else{
					$(".uploadsucess").html('<p class="alert alert-success">errror</p>');
				}
             setTimeout(function() {
                 $(".uploadsucess").hide();
             }, 3000);

         });
		   
	   }
	 
    }function departmnt(elm){
		var id= $(elm).val();
		
		var category= $("#categorys_id").val();
		
		if(category ==undefined){
			category='';
		}
		 jQuery.ajax({
             type: 'POST',
             url: base_url + '/changedpt',
             dataType: 'json',
             data: {'id':id},
             success: function(res) {
                 if(res.length>0){
					  var active ='';
					  var active1 ='';
					 var newOption ="<ul class='category'>";
					 $(res).each(function() {
                          if(this.subCategory.length==0){
							  var active ="active";
						  }
                         newOption += '<li class='+active+'><a  onClick="getCategory(this)" data-id="'+this.id+'">'+this.categoryname+'</a><ul>';
                         $(this.subCategory).each(function() {
							   if(this.subCategory.length==0){
							     var active1 ="active";
						       }
							   newOption +='<li  class='+active1+'><a  onClick="getCategory(this)" data-id="'+this.id+'">'+this.categoryname+'</a><ul>';  
					            $(this.subCategory).each(function() {
									if(this.subCategory.length==0){
							          var active2 ="active";
						            }
									newOption +='<li  class='+active2+'><a  onClick="getCategory(this)" data-id="'+this.id+'">'+this.categoryname+'</a><ul>';  
					               $(this.subCategory).each(function() {
								
									 newOption +='<li><a  data-toggle="modal" data-target="#DeleteModal" data-id="'+this.id+'">'+this.categoryname+'</a> </li>';  
						           });
								   newOption +='</ul></li>';
							   });
								newOption +='</ul></li>';
						   });
						   newOption +='</ul></li>';
					 });
					 newOption +='</ul>';
					 $(".sss").html(newOption);
					 $('.tree li').each(function() {
						 if ($(this).children('ul').length > 0) {
							 $(this).addClass('parent');
						 }
					 });
				 }else{
					
					 $(".sss").html('<p>No Categories Found</p>');
				 }

             }
         });
	}function departmntSearch(elm){
		var id= $(elm).val();
		
		var category= $("#categorys_id").val();
		
		if(category ==undefined){
			category='';
		}
		 jQuery.ajax({
             type: 'POST',
             url: base_url + '/changedpt',
             dataType: 'json',
             data: {'id':id},
             success: function(res) {
                 if(res){
					  var active ='';
					  var active1 ='';
					 var newOption ="<ul class='category'>";
					 $(res).each(function() {
                          if(this.subCategory.length==0){
							  var active ="active";
						  }
                         newOption += '<li class='+active+'><a  onClick="getCategory(this)" data-id="'+this.categoryname+'">'+this.categoryname+'</a><ul>';
                         $(this.subCategory).each(function() {
							   if(this.subCategory.length==0){
							     var active1 ="active";
						       }
							   newOption +='<li  class='+active1+'><a  onClick="getCategory(this)" data-id="'+this.categoryname+'">'+this.categoryname+'</a><ul>';  
					            $(this.subCategory).each(function() {
									if(this.subCategory.length==0){
							          var active2 ="active";
						            }
									newOption +='<li  class='+active2+'><a  onClick="getCategory(this)" data-id="'+this.categoryname+'">'+this.categoryname+'</a><ul>';  
					               $(this.subCategory).each(function() {
								
									 newOption +='<li><a  data-toggle="modal" data-target="#DeleteModal" data-id="'+this.categoryname+'">'+this.categoryname+'</a> </li>';  
						           });
								   newOption +='</ul></li>';
							   });
								newOption +='</ul></li>';
						   });
						   newOption +='</ul></li>';
					 });
					 newOption +='</ul>';
					 $(".sss").html(newOption);
					 $('.tree li').each(function() {
						 if ($(this).children('ul').length > 0) {
							 $(this).addClass('parent');
						 }
					 });
				 }

             }
         });
	}function parentclick(elm){
		$(elm).parent().toggleClass('active');
         $(elm).parent().children('ul').slideToggle('fast');
	}
	function departmnts(elm){
		var id= $(elm).val();
		
		var category= $("#categorys_id").val();
		if(category ==undefined){
			category='';
		}
		 jQuery.ajax({
             type: 'POST',
             url: base_url + '/changedpt',
             dataType: 'json',
             data: {'id':id},
             success: function(res) {
                 if(res.length>0){
					  var active ='';
					  var active1 ='';
					 var newOption ="<ul class='category'>";
					 $(res).each(function() {
                          if(this.subCategory.length==0){
							  var active ="active";
						  }
                         newOption += '<li class='+active+'><a  onClick="getCategory(this)" data-id="'+this.id+'">'+this.categoryname+'</a><ul>';
                         $(this.subCategory).each(function() {
							   if(this.subCategory.length==0){
							     var active1 ="active";
						       }
							   newOption +='<li  class='+active1+'><a  onClick="getCategory(this)" data-id="'+this.id+'">'+this.categoryname+'</a><ul>';  
					            $(this.subCategory).each(function() {
									if(this.subCategory.length==0){
							          var active2 ="active";
						            }
									newOption +='<li  class='+active2+'><a  onClick="getCategory(this)" data-id="'+this.id+'">'+this.categoryname+'</a><ul>';  
					               $(this.subCategory).each(function() {
								
									 newOption +='<li><a  onClick="getCategory(this)"  data-id="'+this.id+'">'+this.categoryname+'</a> </li>';  
						           });
								   newOption +='</ul></li>';
							   });
								newOption +='</ul></li>';
						   });
						   newOption +='</ul></li>';
					 });
					 newOption +='</ul>';
					 $(".sss").html(newOption);
					 $('.tree li').each(function() {
						 if ($(this).children('ul').length > 0) {
							 $(this).addClass('parent');
						 }
					 });
				 }else{
					  $(".sss").html('<p>No Categories Found</p>');
				 }

             }
         });
	}
	
 function GetDptid(elm) {
     var id = $(elm).data("id");
     $("#get_dptid").val(id);
 }
 
function Deletedpt() {
    
        var id=$("#get_dptid").val();
     jQuery.ajax({
         type: 'POST',
         url: base_url + '/deletedpartmt',

         dataType: 'json',
         data:{'id':id},
         success: function(res) {
             $(".deletedpt").show();


             if (res.status == 'success') {
                 $(".deletedpt").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".deletedpt").hide();
                     $('#Deletedpt').modal('hide');
                     location.reload(); 
                       

                 }, 2000);


             } 

         }
     });

 }
 function DeleteOrder() {
    //alert("fd");
        var id=$("#addCategory_id").val();
     jQuery.ajax({
         type: 'POST',
         url: base_url + '/deleteOrder',

         dataType: 'json',
         data:{'id':id},
         success: function(res) {
             $(".deletedpts").show();
            

             if (res.status == 'success') {
                 $(".deletedpts").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".deletedpts").hide();
                     $('#DeleteModal').modal('hide');
                   location.reload(); 
                       

                 }, 2000);


             } 

         }
     });

 }
  function SaveOrderstatus() {
    if ($('#updatestatus').parsley().validate()) {
        var form = $('#updatestatus').serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: base_url + '/updatestatus',

            dataType: 'json',
            data: form,
            success: function(res) {
                $(".custmstatus").show();
               
               
                    $('html, body').animate({
                        scrollTop: $(".custmstatus").offset().top - 100
                    }, 'fast');
                    $(".custmstatus").html('<p class="' + res.class + '">' + res.msg + '</p>');
					setTimeout(function() {
                     $(".custmstatus").hide();
                    // location.reload();
                 }, 2000);

                post_data  ={'id': res.id};
		    link="/getsingleorder";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.getsingleorder=response.single;
				$scope.getitemlist=response.itemlist;
			});

            }
        });
    }
  }
  	function AddBanner() {
	 
     if ($('#addbanner').parsley().validate()) {
		 

         $('#addbanner').ajaxForm(function(options) {
             var items = JSON.parse(options);
              var s = items.msg;
             $('html, body').animate({
                 scrollTop: $(".uploadsucess").offset().top - 100
             }, 'fast');
             $(".uploadsucess").show();
             $(".uploadsucess").html('<p class="alert alert-success">' + s + '</p>');
			 

             setTimeout(function() {
                 $(".uploadsucess").hide(); $('#addbanner')[0].reset();
             }, 2000);

         });
     }
 }
 function editbanner(elm) {
    var id = $(elm).data("id");
    jQuery.ajax({
        type: 'POST',
        url: base_url + '/banneredit',
        dataType: 'json',
        data: {
            'id': id
        },
        success: function (res) {


            var title = res.title;
            var imagess = res.image;
            var panid = res.id;
    
            $('#title').val(title);
            //$('#imaged').val(imaged);
            $('#panid').val(panid);
			$(".imageshow").html('<img src=' + base_url + '/' + imagess + ' width="50" height="50px">');
           
        }
    });


}function bannerCreated() {
 
    if ($('.editbanner').parsley().validate()) {
   

         $('.editbanner').ajaxForm(function(options) {
             var items = JSON.parse(options);
              var s = items.msg;
			   imagess=items.img;
             $('html, body').animate({
                 scrollTop: $(".uploadsucess").offset().top - 100
             }, 'fast');
             $(".uploadsucesss").show();
             $(".uploadsucesss").html('<p class="alert alert-success">' + s + '</p>');
             $(".imageshow").html('<img src=' + base_url + '/' + imagess + ' width="50" height="50px">');
             setTimeout(function() {
                 $(".uploadsucesss").hide(); 
             }, 2000);

         });
	}
 }
 function deletebanner() {
 
        var id=$("#get_id").val();
     jQuery.ajax({
         type: 'POST',
         url: base_url + '/bannerdelete',

         dataType: 'json',
         data:{'id':id,'_token':$("#token").val()},
         success: function(res) {
             $(".deleteroles").show();


             if (res.status == 'success') {
				 
                 $(".deleteroles").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".deleteroles").hide();
//                     $('#Deletedpt').modal('hide');
                     location.reload(); 
                       

                 }, 2000);
			             } 

         }
     });

 }function Takeids(elm) {
     var id = $(elm).data("id");
     $("#get_id").val(id);
 }