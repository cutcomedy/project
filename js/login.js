$(document).ready(function(){
    $("#signup").click(function(){
        $.ajax({
                url: 'SQL_login_check.php',
                type:'POST',
                data:{account:$('#account').val(), password:$("#password").val()},
                dataType:'text',
                success:function(msg){
                    var state = msg.replace(/\s/g,'');
                    if(state == "success"){
                        alert("Log in success!");
                        window.location.reload();
                    }
                    else {
                       alert("Log in fail! Please check account or password." + msg);
                    }
                },
                error:function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
        })
    })
})
