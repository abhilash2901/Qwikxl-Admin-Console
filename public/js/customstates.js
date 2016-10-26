$(document).ready(function ()
{
    $("#loding1").hide();
    $("#loding2").hide();
    $(".country").change(function ()
    {
        $("#loding1").show();
        var id = $(this).val();
        var dataString = 'id=' + id;
        $(".state").find('option').remove();
        $(".city").find('option').remove();
        $.ajax
                ({
                    type: "POST",
                    url: base_url + '/state',
                    data: dataString,
                    cache: false,
                    success: function (html)
                    {
                        $("#loding1").hide();
                        var newOption = '';
						newOption += '<option >Select State</option>';
                        $(html).each(function () {
                            newOption += '<option value=' + this.id + '>' + this.name + '</option>';
                        });
                        $('.state').html(newOption);
                    }
                });
    });
    $(".state").change(function ()
    {
        $("#loding2").show();
        var id = $(this).val();
        var dataString = 'id=' + id;
        $.ajax
                ({
                    type: "POST",
                    url: base_url + '/city',
                    data: dataString,
                    cache: false,
                    success: function (html)
                    {
                        $("#loding2").hide();
                        var newOption = '';
						newOption += '<option >Select City</option>';
                        $(html).each(function () {
                            newOption += '<option value=' + this.id + '>' + this.name + '</option>';
                        });
                        $('.city').html(newOption);
                    }
                });
    });



//    var counter = 0;
//    $("#addButton").click(function () {
//        $(".city").hide();
////        if (counter > 1) {
////            alert("Only 1 textboxes allow");
////            return false;
////        }
//        var newTextBoxDiv = $(document.createElement('div'))
//                .attr("id", 'TextBoxDiv' + counter);
//
//        newTextBoxDiv.after().html('<input type="text" name="city" id="textbox" placeholder="city name" value="" required>'+  
//                '<a  onclick="removed();"><span class="glyphicon glyphicon-minus"></span></a>');
//        newTextBoxDiv.appendTo("#TextBoxesGroup");
////        counter--;
//    });

//     $("#removeButton").click(function () {
//	if(counter==1){
//          alert("No more textbox to remove");
//          return false;
//       }
//
//	counter--;
//
//        $("#TextBoxDiv" + counter).remove();
//  $(".city").show();
//     });

//     $("#getButtonValue").click(function () {
//
//	var msg = '';
//	for(i=1; i<counter; i++){
//   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
//	}
//    	  alert(msg);
//     });
//     
//     $("#save").click(function ()
//  {
//         
//        $("#loding2").show();
//        
//         if ($('.state').parsley().validate()) {
//          var id = $("#textbox").val();
//        var id1 = $(".state").val();
//
//        var dataString = id;
//        $.ajax
//                ({
//                    type: "POST",
//                    url: base_url + '/createcity',
//                    data: {'id':id,'id1':id1},
//                    cache: false,
//                    
//                        success: function (html)
//                    {
//                       alert("saved");
//                         $(".city").show();
//                         $("#textbox").hide();
//                    }                
//                });
//            }
//    });

    var maxField = 2; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="mcity" class="form-control" style="width:275px;" placeholder="Enter the city" value=""/><a href="javascript:void(0);" class="fa fa-minus-circle remove_button" aria-hidden="true" title="Remove City"></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    $(addButton).click(function () { //Once add button is clicked
	    var country = $('.country').val();
		var city = $('.state').val();
	    if(country && city){
			$(".city").hide();
        $(".fie").hide();
        if (x < maxField) { //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
		}
        
    });
    $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
        $(".city").show();
        $(".fie").show();
    });
    
    
    
    
    
   $(".answer").hide();
$(".coupon_question").click(function() {
    if($(this).is(":checked")) {
        $(".answer").show();
           $(".city").hide();
    } else {
        $(".answer").hide();
         $(".city").show();
         
    }
}); 
 $(document).ready(function(){
    $('[id^=valid]').keypress(validateNumber);
});   

});

//function removed(){
//  $("#TextBoxDiv1").remove();
//  $(".city").show();
//
//}
//function saved() {
//    if ($('.state').parsley().validate()) {
//        var id = $("#textbox").val();
//        var id1 = $(".state").val();
//        var dataString = id;
//        $.ajax
//                ({
//                    type: "POST",
//                    url: base_url + '/createcity',
//                    data: {'id': id, 'id1': id1},
//                    cache: false,
//                    success: function (html)
//                    {
//                        alert("saved");
//                        $(".city").show();
//                        $("#textbox").hide();
//                        $("#removeButtonh").hide();
//                        $("#save").hide();
//                    }
//                });
//    }
//}


//function stateadd() {
//            $.ajax
//                ({
//                    type: "POST",
//                    url: base_url + '/city',
//                    data: dataString,
//                    cache: false,
//                    success: function (html)
//                    {
//                        $("#loding2").hide();
//                        var newOption = '';
//                        $(html).each(function () {
//                            newOption += '<option value=' + this.id + '>' + this.name + '</option>';
//                        });
//                        $('.city').html(newOption);
//                    }
//                });
//}



function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode === 8 || event.keyCode === 46
        || event.keyCode === 37 || event.keyCode === 39) {
        return true;
    }
    else if ( key < 48 || key > 57 ) {
        return false;
    }
    else return true;
};
    
