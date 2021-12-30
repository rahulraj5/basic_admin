
$(document).ready(function() {
    var user_list_tab = $('#user_list_tab').DataTable({
        //responsive: true
    });

    var view_user_tour = $('#view_user_tour').DataTable({
        //responsive: true
    });    

    $("body").on("click",".user_status", function(e){
        var status = $(this).attr("href-status");
        var id = $(this).attr("href-id");
        var act = $(this).attr("href-act");
        var userrole = $(this).attr("href-role");
        var cur = $(this);    
         
        if(confirm("Sure you want to change "+act+" ?"))
        {
            $.ajax({
              type: "POST",
              url: baseurl+"admin/changestatus",
              data:{tabname:'users',status:status,id:id,useract:act,userrole:userrole},
              dataType: 'json',
              success: function(response) {
                if (response.success == 1)
                {
                    showMessage(response.msg,"","success");
                    setTimeout(function(){ window.location.reload(); },500);                 
                }
                else
                {
                    showMessage(response.msg,"","error");
                }
              }
            });
        }
    });

    $("body").on("click",".tour_status", function(e){
        var status = $(this).attr("href-status");
        var id = $(this).attr("href-id");
        var act = $(this).attr("href-act");
        var userrole = $(this).attr("href-role");
        var cur = $(this);    
         
        if(confirm("Sure you want to change "+act+" ?"))
        {
            $.ajax({
              type: "POST",
              url: baseurl+"admin/changestatus",
              data:{tabname:'tours',status:status,id:id,useract:act,userrole:userrole},
              dataType: 'json',
              success: function(response) {
                if (response.success == 1)
                {
                    showMessage(response.msg,"","success");
                    setTimeout(function(){ window.location.reload(); },500);                 
                }
                else
                {
                    showMessage(response.msg,"","error");
                }
              }
            });
        }
    });

    $("body").on("click",".destination_status", function(e){
        var status = $(this).attr("href-status");
        var id = $(this).attr("href-id");
        var act = $(this).attr("href-act");
        var userrole = $(this).attr("href-role");
        var cur = $(this);    
         
        if(confirm("Sure you want to change "+act+" ?"))
        {
            $.ajax({
              type: "POST",
              url: baseurl+"admin/changestatus",
              data:{tabname:'destinations',status:status,id:id,useract:act,userrole:userrole},
              dataType: 'json',
              success: function(response) {
                if (response.success == 1)
                {
                    showMessage(response.msg,"","success");
                    setTimeout(function(){ window.location.reload(); },500);                 
                }
                else
                {
                    showMessage(response.msg,"","error");
                }
              }
            });
        }
    });

    
    /************** Add Tour Page ***************/

    // Hide show tour name
    $("body").on("click",".tour_name_flag", function(){
      var cur = $(this);
      var lid = $(this).data("tn_id");
      $(".tour_name").addClass("hidden");
      $("#tour_name_"+lid).removeClass("hidden");
    });

    // Hide show tour description
    $("body").on("click",".tour_description_flag", function(){
      var cur = $(this);
      var lid = $(this).data("td_id");
      $(".tour_description").addClass("hidden");
      $("#tour_description_"+lid).removeClass("hidden");
    });

    $("#tour_end_time_div").datetimepicker({
      format: 'hh:mm',
      pickDate: false,
      pickSeconds: false
    });

    $("#tour_start_time_div").datetimepicker({
      format: 'hh:mm',
      pickDate: false,
      pickSeconds: false
    });

    $("body").on("change","#tour_image", function(){
        var input = $("#tour_image")[0];
        readFile(input,"tour_image_prev");
    });

    $("body").on("click",".tour_image_remove", function(){
      var url = baseurl+"assets/img/user-medium.png";
      $(".tour_image_prev").attr("src",url);
    })

});

function showMessage(title,msg,msg_type)
{
    var topt = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "200",
      "hideDuration": "600",
      "timeOut": "1000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    if(msg_type == "info")
    {
        toastr.info(msg,title,topt);
    }
    
    if(msg_type == "warning")
    {
        toastr.warning(msg,title,topt);
    }

    if(msg_type == "success")
    {
        toastr.success(msg,title,topt);
    }
    
    if(msg_type == "error")
    {
        toastr.error(msg,title,topt);
    }
    return true;
    //toastr.clear();
}

function readFile(input,cls)
{
  file = input.files[0];
  fr = new FileReader();
  fr.readAsDataURL(file);
  fr.onload = function(){
    $("."+cls).attr("src",fr.result);
  }
}


/* Map code start */
// var map;

// function initialize() {
//     var myLatlng = new google.maps.LatLng(25.1195881,55.1351961);

//     var myOptions = {
//         zoom: 15,
//         center: myLatlng,
//         mapTypeId: google.maps.MapTypeId.ROADMAP
//     };
//     //map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
//     map = new google.maps.Map(document.getElementById("map_go"), myOptions);

//     var marker = new google.maps.Marker({
//         draggable: true,
//         position: myLatlng,
//         map: map,
//         title: "Your location"
//     });

//     /*google.maps.event.addListener(marker, 'dragend', function (event) {
//         var lat = document.getElementById("lat").value = event.latLng.lat();
//         var lng = document.getElementById("long").value = event.latLng.lng();
//         GetAddress(lat,lng);
//     });*/

//     google.maps.event.addListener(map, "click", function (e) {
// 		marker.setPosition(e.latLng);
// 		var t = e.latLng;
// 		console.log("hkjh",e);
// 		var o = "(" + t.lat().toFixed(6) + ", " + t.lng().toFixed(6) + ")";
// 		//infowindow.setContent(o);
// 		var lat = document.getElementById("lat").value = e.latLng.lat();
//         var lng = document.getElementById("lng").value = e.latLng.lng();
// 		//document.getElementById("latlngspan").innerHTML = o, 
// 		//document.getElementById("coordinatesurl").value = "http://www.latlong.net/c/?lat=" + t.lat().toFixed(6) + "&long=" + t.lng().toFixed(6), document.getElementById("coordinateslink").innerHTML = '&lt;a href="http://www.latlong.net/c/?lat=' + t.lat().toFixed(6) + "&amp;long=" + t.lng().toFixed(6) + '" target="_blank"&gt;(' + t.lat().toFixed(6) + ", " + t.lng().toFixed(6) + ")&lt;/a&gt;", dec2dms()
// 		GetAddress(lat,lng);
// 	});
// }

// function GetAddress(lat,lng) 
// {
//     var latlng = new google.maps.LatLng(lat, lng);
//     var geocoder = geocoder = new google.maps.Geocoder();
//     geocoder.geocode({ 'latLng': latlng }, function (results, status) {
//         if (status == google.maps.GeocoderStatus.OK) {
//             if (results[1]) {
//                 //get address
//             	//document.getElementById("billing_address_1").value = results[1].formatted_address;
//             	//alert("Location: " + results[1].formatted_address);
//             }
//         }
//     });
// }

// google.maps.event.addDomListener(window, "load", initialize());
