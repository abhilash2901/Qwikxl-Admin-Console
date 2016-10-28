$(document).ready(function() {
        var url      = window.location.href;
        $('.sidebar-menu li a').each(function(){
        var li_url=$(this).attr('href');
          if(li_url==url){
           $(this).parents('li').addClass('active');
           }
        });
    var types = $("input[name=type]:checked").val();
    if (types) {
        jQuery.ajax({
            type: 'POST',
            url: base_url + '/type',

            data: {
                'type': types
            },
            dataType: 'JSON',
            success: function(res) {

                var newOption = '';
                var newOption1 = '';
                 newOption += '<option selected="selected">No Role</option>';
                $(res['roles']).each(function() {

                    newOption += '<option value=' + this.id + '>' + this.display_name + '</option>';
                });
				
				
                $('#roles').html(newOption);
				var role_id=$("#role_id").val();
				if(role_id){
					$("#roles").val(role_id).trigger("change");
				}
				
                if (types == 1) {
                    $(".stores").removeClass('hide');
                    $(res['stores']).each(function() {

                        newOption1 += '<option value=' + this.id + '>' + this.name + '</option>';
                    });
                    $('#store_id').html(newOption1);
					
                } else {
                    $(".stores").addClass('hide');

                    $('#getstore_id').val('0');
                }

            }
        });

    }
    jQuery.ajax({
        type: 'POST',
        url: base_url + '/storedetails',
        data: {
            'id': $("#store_ids").val(),'_token':$("#token").val()
        },
        dataType: 'json',

        success: function(res) {
            if (res[0].unique_id != '') {
                var ids = res[0].unique_id;
                var sname = res[0].name;
                var snumber = res[0].corporateidentifier;
                var saddress = res[0].address;
                var saddress2 = res[0].address2;
                var city = res[0].city;
                var country = res[0].cname;
                var state = res[0].state;
                var zip = res[0].zip;
                var phone = res[0].phone;
                var mail = res[0].mail;
                var website = res[0].website;
                
                $('#store_id').val(res[0].id);
                $('#ids').val($("#store_ids").val());
                $('#sname').val(sname);
                $('#uneaque_id').val(ids);
                $('#saddress').val(saddress);
                $('#snumber').val(snumber);
                $('#saddress2').val(saddress2);
                //$("#role_id").val(role_id);
				
                $(".country").val(country).trigger("change");
				//selectcountry();
				
				
                //$('#role_id').find('option[value="'+role_id+'"]').prop('selected', true); 
                $('#city').val(city);
                $('#state').val(state);
                $('#zip').val(zip);
                $('#phone').val(phone);
                $('#website').val(website);

                $('#mail').val(mail);
				setTimeout(function() {
                    $(".state").val(state).trigger("change");
					
                }, 500);
				setTimeout(function() {
                    $(".city").val(city).trigger("change");

					
                }, 1000);
				
				
            }

        }
    });
    $('#side-menu').metisMenu();
    var session = $("#session").val();
    if (session == '0') {
        //  window.location.replace(base_url+"/users");

    }
    $("#search-input").autocomplete({
        source: base_url + '/autocomplete',
        minlength: 1,
        type: 'POST',
        autoFocus: true,

        select: function(event, ui) {
            $('#Destination').append(
                "<li class='clickable' role='presentation' data-value='" + ui.firstname + "' ng-click=='search()'><a>" + ui.firstname + "</a></li>"
            );
        },


        /*           select: function(event,ui){
                    console.log("nouar");
                       $('#search-input').val(ui.item.value);
                        $('#employee_N').val(ui.item.employee_N);
                        $('#first_name').val(ui.item.first_name);
                        $('#last_name').val(ui.item.last_name);
                        $('#status').val(ui.item.status);
                        }*/
    });
    $("#search-input2").autocomplete({
        source: base_url + '/autocompletes',
        minlength: 1,
        type: 'POST',
        autoFocus: true,

        select: function(event, ui) {
            $('#Destination').append(
                "<li class='clickable' role='presentation' data-value='" + ui.firstname + "' onClick='selectA(this)'><a>" + ui.firstname + "</a></li>"
            );
        },


        /*           select: function(event,ui){
                    console.log("nouar");
                       $('#search-input').val(ui.item.value);
                        $('#employee_N').val(ui.item.employee_N);
                        $('#first_name').val(ui.item.first_name);
                        $('#last_name').val(ui.item.last_name);
                        $('#status').val(ui.item.status);
                        }*/
    });
    
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button");
    var x = 1;
    $("#add").click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="form-group" ><label class="col-lg-2 control-label">Dept ' + x + '</label><div class="col-lg-8"><input type="text" placeholder="Department ' + x + '" class="form-control" name="name[]" required></div> <span class="" onClick="remove(this)"><img src="' + base_url + '/img/remove-icon.png" ></span></div>'); //add input box
        }
    });
    // $(".stores").hide();
});

function gettype(sel) {
    var type = jQuery(sel).val();

    jQuery.ajax({
        type: 'POST',
        url: base_url + '/type',

        data: {
            'type': type
        },
        dataType: 'JSON',
        success: function(res) {

            var newOption = '';
            var newOption1 = '';
 
             newOption += '<option selected="selected">No Role</option>';
            $(res['roles']).each(function() {

                newOption += '<option value=' + this.id + '>' + this.display_name + '</option>';
            });
            $('#roles').html(newOption);
            if (type == 1) {
                $(".stores").removeClass('hide');
				
                $(res['stores']).each(function() {

                    newOption1 += '<option value=' + this.id + '>' + this.name + '</option>';
                });
                $('#store_id').html(newOption1);
            } else {
				
                $(".stores").addClass('hide');

                $('#getstore_id').val('0');
            }

        }
    });

}
setTimeout(function() {
    var editsid = $("#edit_store_id").val();
    if (editsid != '0') {
        $('#store_id').val(editsid).trigger("change");
        $('#store_id').find('option[value="' + editsid + '"]').prop('selected', true);
    };
}, 1000);
var ids = $('#store_id').val();
$('#getstore_id').val(ids);

function Getstore(elm) {
    var id = $(elm).val();
    $('#getstore_id').val(id);

}

function Savedetails() {
    if ($('.create_user').parsley().validate()) {
        var form = $('.create_user').serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: base_url + '/createuser',

            dataType: 'json',
            data: form,
            success: function(res) {



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
                $(".usersucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                if (res.status == 'success') {
                    $('.create_user')[0].reset();
                    location.reload();

                }

            }
        });
    }
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
                $(".editsucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                if (res.status == 'success') {
                    $('.edituser')[0].reset();
                    location.reload();

                }

            }
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
            var ids = res[0].unique_id;
            var role_id = res[0].role_id;
            var firstname = res[0].firstname;
            var lastname = res[0].lastname;
            var email = res[0].email;
            //alert(role_id);
            $('#uneaques_ids').val(ids);
            $('#role_id').val(role_id);
            //$("#role_id").val(role_id);
            $("#role_id").val(role_id).trigger("change");
            $('#role_id').find('option[value="' + role_id + '"]').prop('selected', true);
            $('#firstname').val(firstname);
            $('#id').val(id);
            $('#lastname').val(lastname);
            $('#email').val(email);
            $(".edit").click();
        }
    });


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
                $(".dptsucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                if (res.status == 'success') {
                    //$('#dept')[0].reset();
                    location.reload();

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
            url: base_url + '/changepass',

            dataType: 'json',
            data: form,
            success: function(res) {
                $(".changepasres").show();
                $(".changepasres").html('<p class="alert alert-success">' + res.msg + '</p>');
                if (res.status == 'success') {
                    $('#changepass')[0].reset();
                    location.reload();

                }

            }
        });
    }
}

function Addstore() {
    if ($('#store').parsley().validate()) {
        var form = $('#store').serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: base_url + '/storecreate',

            dataType: 'json',
            data: form,
            success: function(res) {

                //setTimeout(function(){$(".changepasres").hide();location.reload(); }, 1000);
                if (res.status == 'success') {
                    //$('#store')[0].reset();
                    //location.reload(); 

                    // $(".updatemessage").focus();
                    $(".updatemessage").show();
                    $('html, body').animate({
                        scrollTop: $(".updatemessage").offset().top - 100
                    }, 'fast');
                    $(".updatemessage").html('<p class="alert alert-success">' + res.msg + '</p>');
                    setTimeout(function() {
                        $(".updatemessage").hide();
                        window.location.replace(base_url + "/editstore");
                    }, 1500);


                }

            }
        });
    }
}

function Edistore() {
    if ($('#store').parsley().validate()) {
        var form = $('#store').serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: base_url + '/storeedit',

            dataType: 'json',
            data: form,
            success: function(res) {
                $(".changepasres").show();
                // $(".changepasres").focus();
                $('html, body').animate({
                    scrollTop: $(".changepasres").offset().top - 100
                }, 'fast');
                $(".changepasres").html('<p class="alert alert-success">' + res.msg + '</p>');
                setTimeout(function() {
                    $(".changepasres").hide();
                    window.location.replace(base_url + "/editstore");
                }, 1500);
                if (res.status == 'success') {

                    //$('#store')[0].reset();
                    //location.reload(); 

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
                $(".dptsucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                setTimeout(function() {
                    $(".dptsucess").hide();
                    location.reload();
                }, 1000);
                if (res.status == 'success') {
                    $('#dept')[0].reset();
                    //location.reload(); 

                }

            }
        });
    }
}

function profile() {
    if ($('.profile').parsley().validate()) {
        var form = $('.profile').serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: base_url + '/updatesprofile',

            dataType: 'json',
            data: form,

            success: function(res) {
                $(".profilesucess").show();
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

function remove(sel) {
    //alert("df");
    $(sel).parent().remove();
}function Permissiontype(sel) {
    //alert("df");
   var type = $(sel).val();
  
   if(type==1){
	  
	    $("#system").addClass('hide');
		 $("#storess").removeClass('hide');
   }else{
	  
	   $("#storess").addClass('hide');
	    $("#system").removeClass('hide');
   }
}
function DeleteStore() {
    
      var id=$("#get_storesid").val();
     jQuery.ajax({
         type: 'POST',
         url: base_url + '/deletestore',

         dataType: 'json',
         data:{'id':id},
         success: function(res) {
             $(".deletesucess").show();


             if (res.status == 'success') {
                 $(".deletesucess").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".deletesucess").hide();
                     $('#DeleteModal').modal('hide');
                    window.location.href = base_url+"/findstore";
                 }, 2000);


             } else {
                 $(".deletesucess").html('<p class="alert alert-danger">' + res.msg + '</p>');
                 
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
 function Takestore(elm) {
     var id = $(elm).data("id");
     $("#get_storesid").val(id);
 }
 function Takeid(elm) {
     var id = $(elm).data("id");
     $("#get_id").val(id);
 }
 function Roleupdate() {
    if ($('#role_update').parsley().validate()) {
        var form = $('#role_update').serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: base_url + '/roleupdate',

            dataType: 'json',
            data: form,
            success: function(res) {
                $(".role_update").show();
               
               
                    $('html, body').animate({
                        scrollTop: $(".role_update").offset().top - 100
                    }, 'fast');
                    $(".role_update").html('<p class="' + res.class + '">' + res.msg + '</p>');
					setTimeout(function() {
                     $(".role_update").hide();
                    // location.reload();
                 }, 2000);

                

            }
        });
    }
}
function Deleterole() {
	
        var id=$("#get_id").val();
     jQuery.ajax({
         type: 'POST',
         url: base_url + '/deleterole',

         dataType: 'json',
         data:{'id':id,'_token':$("#token").val()},
         success: function(res) {
             $(".deleterole").show();


             if (res.status == 'success') {
                 $(".deleterole").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".deleterole").hide();
                     $('#Deletedpt').modal('hide');
                     location.reload(); 
                       

                 }, 2000);


             } 

         }
     });

 }function Deleteduser() {
    
        var id=$("#get_id").val();
     jQuery.ajax({
         type: 'POST',
         url: base_url + '/deleteduser',

         dataType: 'json',
         data:{'id':id},
         success: function(res) {
             $(".deleterole").show();


             if (res.status == 'success') {
                 $(".deleterole").html('<p class="alert alert-success">' + res.msg + '</p>');
                 setTimeout(function() {
                     $(".deleterole").hide();
                     $('#Deletedpt').modal('hide');
                     location.reload(); 
                       

                 }, 2000);


             } 

         }
     });

 }
	