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

});
