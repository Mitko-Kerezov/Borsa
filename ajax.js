$(document).ready(
	function(){
		$("#username").keyup(
		    function(){
			$.ajax({
				type: "POST",
				url: "reg_check.php",
				data: ({
					check: "user",
				       	username: $("#username").val()
				}),
				contentType: "application/x-www-form-urlencoded; charset=windows-1251",
				success:function(data){
        				$("#check_user").html(data);
				}
			});
		    }
		);
		$("#email").keyup(
		    function(){
			$.ajax({
				type: "POST",
				url: "reg_check.php",
				data: ({
					check: "email",
                    email: $("#email").val()
				}),
				contentType: "application/x-www-form-urlencoded; charset=windows-1251",
				success: function(data){
        				$("#check_email").html(data);
				}
			});
		    }
		);
		$("#pass2").keyup(
		    function(){
			$.ajax({
				type: "POST",
				url: "reg_check.php",
				data: ({
					check: "pass",
				       	pass1: $("#pass1").val(),
					pass2: $("#pass2").val()
				}),
				contentType: "application/x-www-form-urlencoded; charset=windows-1251",
				success: function(data){
        				$("#check_pass").html(data);
				}
			});
		    }
		);
	}
);