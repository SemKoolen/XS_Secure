function loginRequest() {

    var form = $("#login-form")[0];
    var inputs = $("input");
    var username = $("#lg_username")[0].value;
    var password = $("#lg_password")[0].value;

    $.ajax({
        url : 'components/request.php',
        type : 'POST',
        data : { "userLogin" : true, "username" : username, "password" : password },
        success : function(data){
            debugger;
            console.log(data)
        },
        error : function(request,error, data) {
            debugger;
            alert('Error = ' + error + 'data:' + data)
        }
    });
}
