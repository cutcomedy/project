$(document).ready(function(){
    var num_check = 0, new_pwd_1_check = 0, new_pwd_2_check = 0;
    $("#change_pwd").click(function(){
        var rule_password = /^[^\s]{8,20}$/;
        if(rule_password.test($("#new_pwd_1").val()) && $("#new_pwd_1").val() == $("#new_pwd_2").val()){
            alert("新密碼填寫錯誤");
        }
        else{
            $.ajax({
                url: 'SQL_change_pwd.php',
                type:'POST',
                data:{account:$('#old_pwd').val(), password:$("#new_pwd_1").val()},
                dataType:'text',
                success:function(msg){
                    if(msg == "success" ){
                        alert("change success!");
                        window.location.reload();
                    }
                    else {
                        alert("change fail!");
                    }
                },
                error:function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            })
        }
    })

    $("#new_pwd_1").keyup(function(){
        var rule_password = /^[^\s]{8,20}$/;
        if(rule_password.test($("#new_pwd_1").val())){
            password1_check = 1;
            $("#warning_new_pwd_1").html("");
            num_check = new_pwd_1_check + new_pwd_2_check;
            if(num_check == 3){
                $("#change_pwd").prop("disabled", false);
            }
        }
        else{
            password1_check = 0
            $("#warning_new_pwd_1").html("password 輸入有誤 請輸入 8 - 20 字");
            var num_check = new_pwd_1_check + new_pwd_2_check;
            if(num_check != 2){
                $("#change_pwd").prop("disabled", true);
            }
        }
    });


    $("#new_pwd_2").keyup(function(){
        if($("#new_pwd_1").val() == $("#new_pwd_2").val()){
            password2_check = 1;
            $("#warning_new_pwd_2").html("");
            num_check = new_pwd_1_check + new_pwd_2_check;
            if(num_check == 2){
                $("#change_pwd").prop("disabled", false);
            }
        }
        else{
            password2_check = 2;
            $("#warning_new_pwd_2").html("與password不同");
            var num_check = new_pwd_1_check + new_pwd_2_check;
            if(num_check != 3){
                $("#change_pwd").prop("disabled", true);
            }
        }
    });
})
