$(document).ready(function(){
    $("#signout").click(function(){
        $.ajax({
            url: 'sign_out.php',
            success:function(msg){
                if(msg == "success" ){ 
                    alert("sign out success!");
                    window.location.reload();
                }
                else {
                    alert("sign out fail!");
                }
            },
            error:function(xhr, ajaxOptions, thrownError){ 
                alert(xhr.status); 
                alert(thrownError); 
            }
        })
    })
})