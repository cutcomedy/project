$(document).ready(function(){
    var account_check = 0;
    var password1_check = 0;
    var password2_check = 0;
    var email_check = 0;


    function check_all_data(){
        var rule_account = /^[^\s]{8,20}$/;
        var rule_password = /^[^\s]{8,20}$/;
        var rule_email = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
        if(rule_account.test($("#account_s").val()) && rule_password.test($("#password1").val()) && $("#password1").val() == $("#password2").val() && rule_email.test($("#email").val())){
            $.ajax({
                   url: 'SQL_sign_up.php',
                   type:'POST',
                   data:{
                       account:$('#account_s').val(),
                       password:$("#password1").val(),
                       email:$("#email").val()
                   },
                   dataType:'text',
                   success:function(msg){
                       var state = msg.replace(/\s/g,'');
                       if(state == "success"){
                           alert("Sign up success!");
                           window.location.href="price.php";
                       }
                       else {
                          alert("Sign up fail!" + msg);
                       }
                   },
                   error:function(xhr, ajaxOptions, thrownError){
                       alert(xhr.status);
                       alert(thrownError);
                   }
           })
        }
        else{
            alert("資料填寫有誤!");
        }
    }
    $("#submit_sign_up").click(function(){
        check_all_data();
    });

    $("#account_s").keyup(function(){
        var rule_account = /^[^\s]{8,20}$/;
        var again = 0;
        if(rule_account.test($("#account_s").val())){
            $.ajax({
                url: 'SQL_check_account.php',
                type:'POST',
                data:{account:$('#account_s').val()},
                dataType:'text',
                async: false,
                success:function(msg){
                    $('#warning_account').html(msg);
                    if(msg == "OK!" ){
                        again = 1;
                    }
                    else {
                       again = 0;
                    }
                },
                error:function(xhr, ajaxOptions, thrownError){
                        alert(xhr.status);
                        alert(thrownError);
                    }
            })
            if(again == 1){
                $("#warning_account").html("");
                account_check = 1;
            }
            else{
                account_check = 0;
            }
            var num_check = account_check + password1_check + password2_check + email_check;
            if(num_check == 4){
                $("#submit_sign_up").prop("disabled", false);
            }
            else{
                $("#submit_sign_up").prop("disabled", true);
            }
        }
        else{
            account_check = 0;
            $("#warning_account").html("account 輸入有誤 請輸入 8 - 20 字");
            var num_check = account_check + password1_check + password2_check + email_check;
            if(num_check != 4){
                $("#submit_sign_up").prop("disabled", true);
            }
        }

    });

    $("#password1").keyup(function(){
        var rule_password = /^[^\s]{8,20}$/;
        if(rule_password.test($("#password1").val())){
            password1_check = 1;
            $("#warning_password1").html("");
            var num_check = account_check + password1_check + password2_check + email_check;
            if(num_check == 4){
                $("#submit_sign_up").prop("disabled", false);

            }
        }
        else{
            password1_check = 0
            $("#warning_password1").html("password 輸入有誤 請輸入 8 - 20 字");
            var num_check = account_check + password1_check + password2_check + email_check;
            if(num_check != 4){
                $("#submit_sign_up").prop("disabled", true);
            }
        }
    });


    $("#password2").keyup(function(){
        if($("#password1").val() == $("#password2").val()){
            password2_check = 1;
            $("#warning_password2").html("");
            var num_check = account_check + password1_check + password2_check + email_check;
            if(num_check == 4){
                $("#submit_sign_up").prop("disabled", false);
            }
        }
        else{
            password2_check = 2;
            $("#warning_password2").html("與password不同");
            var num_check = account_check + password1_check + password2_check + email_check;
            if(num_check != 4){
                $("#submit_sign_up").prop("disabled", true);
            }
        }
    });

    $("#email").keyup(function(){
        var rule_email = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
        if(rule_email.test($("#email").val())){
            email_check = 1;
            $("#warning_email").html("");
            var num_check = account_check + password1_check + password2_check + email_check;
            if(num_check == 4){
                $("#submit_sign_up").prop("disabled", false);
            }
        }
        else{
            email_check = 0;
            $("#warning_email").html("e-mail格式錯誤");
            var num_check = account_check + password1_check + password2_check + email_check;
            if(num_check != 4){
                $("#submit_sign_up").prop("disabled", true);
            }
        }
    });
})
