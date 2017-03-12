$(document).ready(function(){
    $("#change_email").click(function(){
        $.ajax({
            url: 'SQL_change_email.php',
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

    })
    $("#new_email").keyup(function(){
        var rule_email = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
        if(rule_email.test($("#new_email").val())){
            $("#warning_new_email").html("");
            $("#submit_sign_up").prop("disabled", false);
        }
        else{
            $("#warning_new_email").html("e-mail格式錯誤");
            $("#submit_sign_up").prop("disabled", true);
        }
    });
})
