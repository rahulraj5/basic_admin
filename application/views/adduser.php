<style type="text/css">
	.uploadBtn{
		top: 0;
		left: 0;
	}
	.uploadBtnInput{
		position: absolute;
		width: 175px;
		display: inline-table !important;
		opacity: 0;
	}
	.uploadBtnWrapper{
		position: relative;
		text-align: center;
		margin-top: 15px;
	}
	.profilePic{
		width:200px;
		height:200px; 
		background-size: cover;
		background-repeat: no-repeat;
	}
	.closeBtn:hover{
		background-color: #333; 
	}
	.closeBtn{
		position: absolute;
	    top: 1em;
	    right: 3.2em;
	    background: #d30;
	    padding: 5px;
	    border-radius: 50%;
	    cursor: pointer;
	    height: 25px;
	    width: 25px;
	    color: #fff;
	    transition: all .3s;
	}
	.with-errors{
		color: red;
	}
</style>
<form data-toggle="validator" novalidate="true" method="post" enctype="multipart/form-data" autocomplete="on">
	<div class="col-md-3 col-lg-3 " align="center"> 
		<div class="img-circle img-responsive profilePic" style="background-image: url(<?php echo (!empty($user_data) && !empty($user_data['image']) ? $user_data['image'] : "http://otechco.com/portals/oteckco/skins/oteckco/images/about%20us/man-team.jpg")?>);"></div> 
		<!-- <i class="fa fa-times closeBtn"></i> -->
		<div class="uploadBtnWrapper text-center">
			<input type="file" class="btn btn-primary uploadBtnInput" name="image">
			<div class="btn btn-primary uploadBtn">Change Profile Picture</div>
		</div>
	</div>
	
	<div class="col-md-9">
	    <div class="panel panel-card margin-b-30">
	        <!-- Start .panel -->
	        <div class="panel-heading">
	           Profile Edit Form
	            
	        </div>
	        <div class="panel-body">
	             
					<div class="form-group">
						<label>Name</label><input type="text" name="name" placeholder="Enter name" class="form-control" value="<?php echo (!empty($user_data) && !empty($user_data['name']) ? $user_data['name'] : "" )?>" data-error="Name is required field" required="">
						<div class="help-block with-errors">
						</div>
					</div>
					<div class="form-group">
						<label>Email</label><input type="email"  name="email" value="<?php echo (!empty($user_data) && !empty($user_data['email']) ? $user_data['email'] : "" )?>" placeholder="Enter email" class="form-control" data-error="Email address is invalid" required="">
						<div class="help-block with-errors">
						<?php echo (!empty($email_error)?$email_error:"");?>
						</div>
					</div>
					<div class="form-group">
						<label>Mobile</label><input type="text"  name="mobile_no" value="<?php echo (!empty($user_data) && !empty($user_data['mobile_no']) ? $user_data['mobile_no'] : "" )?>" placeholder="Enter mobile number" class="form-control" data-error="Mobile number is required field" required="">
						<div class="help-block with-errors">
							<?php echo (!empty($mobile_error)?$mobile_error:"");?>
						</div>
					</div>
					
					<!-- <div class="form-group">
						<label>Date of birth (YYYY-mm-dd)</label>

						<div class="input-group date">
	                        <input type="text" name="dob" value="<?php echo (!empty($user_data) && !empty($user_data['dob']) ? $user_data['dob'] : "" )?>" placeholder="YYYY-MM-DD" data-format="YYYY-MM-DD" id="input-date-added" class="form-control hasDatepicker" autocomplete="off">
	                        <span class="input-group-btn">
	                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
	                        </span>
	                    </div>
						<div class="help-block with-errors">
						</div>
					</div> -->

				 <?php if(!isset($user_data['id']) && empty($user_data['id']))

	             {
	               ?>

	               <!-- End .control-group  -->
		                <div class="form-group">
		                    <label>Password</label>
		                    <div >
		                        <input class="form-control" name="password" type="password" id="password" required="">
		                    </div>
		                </div>
		                <!-- End .control-group  -->
		                <div class="form-group">
		                    <label>Re-type password</label>
		                    <div >
		                        <input class="form-control" name="cpassword" type="password" id="confirmpassword" onblur="confirmthepasswords()" required="">
		                        <span id="checkpassword"></span>
		                        <span><?php echo (!empty($pass_error)?$pass_error:"");?></span>
		                    </div>
		                </div>
		            <?php 
		            }
		            ?>
		                <!-- End .control-group  -->
	                <div class="form-group">
						<label>Address</label><input id="pac-input" value="<?php echo (!empty($user_data) && !empty($user_data['address']) ? $user_data['address'] : "" )?>" name="address" type="text" placeholder="Enter your location" class="form-control" data-error="Address is required field" required="">
						<div class="help-block with-errors">
						</div>
					</div>
	                <div id="gmap" style="width: 100%;height:300px;"></div>
	                <!-- <input type="number" name="lat" id="lat">
	                <input type="number" name="lng" id="lng"> -->
	                <div id="infowindow-content">

	                        <img src="" width="16" height="16" id="place-icon">

	                        <span id="place-name"  class="title"></span><br>

	                        <span id="place-address"><?php echo (!empty($user_data) && !empty($user_data['address']) ? $user_data['address'] : "" )?></span>

	                  </div>

	                  <input type="hidden" name="latitude" id="latitude"  value="<?php echo (!empty($user_data) && !empty($user_data['latitude']) ? $user_data['latitude'] : "" )?>">



	                  <input type="hidden" name="longitude" id="longitude"  value="<?php echo (!empty($user_data) && !empty($user_data['longitude']) ? $user_data['longitude'] : "" )?>">
					<div>
						<?php if(isset($user_data['id']) && !empty($user_data['id']))

	                        {

	                      ?>

	                          <input type="hidden" name="id" value="<?php echo (!empty($user_data) && !empty($user_data['id']) ? $user_data['id'] : "" )?>">
	                          <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="update"><strong>Update</strong></button>
	                      <?php
	                      	}
	                      	else
	                      	{
	                      ?>
	                      		<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Submit</strong></button>
	                      	<?php 
	                      	}
	                      	?>
						
					</div>
				
	        </div>
	    </div>
	</div>
</form>
<?php include('datepicker.php');?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlk9jl3b8NvuKXQm6rft78c5T_PLe7gRg&libraries=places&callback=initMap" async defer></script>
 <script type="text/javascript">
	function confirmthepasswords() {

  	//alert('demo');
    	var password = document.getElementById("password").value;
    	//alert(password);
    	var confirmPassword = document.getElementById("confirmpassword").value;
    	//alert(confirmPassword);
    	if (password != confirmPassword) {
        	$("#checkpassword").html('password do not match').css({ "color": "red" });
       	// alert('password do not match');
	$('#submitform').attr("disabled", true);
        	return false;
    	}else
    	{
      	$("#checkpassword").html('password  matched').css({ "color": "green" });
	      	//document.getElementById("checkpassword").style.color = green;
	      	return true;
    	}

	}

	function initMap() {



	    var latt = ($("#latitude").val() != "")? parseFloat($("#latitude").val()) : -33.8688;

	    var longg = ($("#longitude").val() != "")? parseFloat($("#longitude").val()) : 151.2195;

	    console.log("latt =",latt," longg =",longg);

	    var map = new google.maps.Map(document.getElementById('gmap'), {

	      center: {lat: latt, lng: longg},

	      zoom: 13

	    });

	   // var card = document.getElementById('pac-card');

	    var input = document.getElementById('pac-input');

	    //var types = document.getElementById('type-selector');

	    //var strictBounds = document.getElementById('strict-bounds-selector');



	    //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);



	    var autocomplete = new google.maps.places.Autocomplete(input);



	    // Bind the map's bounds (viewport) property to the autocomplete object,

	    // so that the autocomplete requests use the current map bounds for the

	    // bounds option in the request.

	    autocomplete.bindTo('bounds', map);



	    var infowindow = new google.maps.InfoWindow();

	    var infowindowContent = document.getElementById('infowindow-content');

	    infowindow.setContent(infowindowContent);

	    var marker = new google.maps.Marker({

	      map: map,

	      //anchorPoint: new google.maps.Point(0, -29)

	      position : new google.maps.LatLng(latt, longg),

	    });



	    infowindow.open(map, marker);

	    

	    google.maps.event.addListener(marker, 'click', function() {

	        /*infowindow = new google.maps.InfoWindow({

	            content: 'Hello, World!!'

	        });*/

	        infowindow.open(map, marker);

	    });



	    autocomplete.addListener('place_changed', function() {

	      infowindow.close();

	      marker.setVisible(false);

	      var place = autocomplete.getPlace();

	      // console.log("place",place);

	      // console.log("place lat",place.geometry.location.lat().toFixed(6));

	      // console.log("place lng",place.geometry.location.lng().toFixed(6));





	      if (!place.geometry) {

	        // User entered the name of a Place that was not suggested and

	        // pressed the Enter key, or the Place Details request failed.

	        window.alert("No details available for input: '" + place.name + "'");

	        return;

	      }



	      $("#latitude").val(place.geometry.location.lat().toFixed(8));

	      $("#longitude").val(place.geometry.location.lng().toFixed(8));

	      // If the place has a geometry, then present it on a map.

	      if (place.geometry.viewport) {

	        map.fitBounds(place.geometry.viewport);

	      } else {

	        map.setCenter(place.geometry.location);

	        map.setZoom(17);  // Why 17? Because it looks good.

	      }

	      marker.setPosition(place.geometry.location);

	      marker.setVisible(true);



	      var address = '';

	      if (place.address_components) {

	        address = [

	          (place.address_components[0] && place.address_components[0].short_name || ''),

	          (place.address_components[1] && place.address_components[1].short_name || ''),

	          (place.address_components[2] && place.address_components[2].short_name || '')

	        ].join(' ');

	      }



	      infowindowContent.children['place-icon'].src = place.icon;

	      infowindowContent.children['place-name'].textContent = place.name;

	      infowindowContent.children['place-address'].textContent = address;

	      infowindow.open(map, marker);

	    });



	    // Sets a listener on a radio button to change the filter type on Places

	    // Autocomplete.

	    /*function setupClickListener(id, types) {

	      var radioButton = document.getElementById(id);

	      radioButton.addEventListener('click', function() {

	        autocomplete.setTypes(types);

	      });

	    }*/



	    //setupClickListener('changetype-all', []);

	    //setupClickListener('changetype-address', ['address']);

	   // setupClickListener('changetype-establishment', ['establishment']);

	    //setupClickListener('changetype-geocode', ['geocode']);



	    /*document.getElementById('use-strict-bounds')

	    .addEventListener('click', function() {

	      console.log('Checkbox clicked! New state=' + this.checked);

	      autocomplete.setOptions({strictBounds: this.checked});

	    });*/

	}
</script>

