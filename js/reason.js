
$(document).ready(function(){
    $('body').on('click', '.track', function () {
        $.ajax({
            url: "SQL_track_add.php",
            type: 'POST',
            dataType: "text",
            data: {
              product_url: $(this).val(),
              product_id: $(this).attr('id'),
            },
            success: function(msg) {
                alert(msg);
            },

            error: function() {
                alert("error");
            }
        });
    })
    $('body').on('click', '.notrack', function () {
        $.ajax({
            url: "SQL_track_delete.php",
            type: 'POST',
            dataType: "text",
            data: {
                product_url: $(this).val(),
            },

            success: function(msg) {
                alert(msg);
                window.location.reload();
            },

            error: function() {
                alert("error");
            }
        });
    })
    $('body').on('click', '.share', function () {
        $.ajax({
            url: "SQL_share.php",
            type: "POST",
            datatype: "text",
            data: {
                product_url: $(this).val(),
                product_id: $(this).attr('id'),
            },
            success: function(msg){
                ;
            },
            error: function(msg){
        }
        });
    })
        $('body').on('click', '.shop', function () {
        $.ajax({
            url: "SQL_click_shop.php",
            type: "POST",
            datatype: "text",
            data: {
                product_id: $(this).attr('id'),
            },
            success: function(msg){
                ;
            },
            error: function(msg){
        }
        });
    })
})
