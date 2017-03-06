$(document).ready(function () {
    if ($("#mode").val() == "track") {
        var x = 10;
        var count = 0;
        for (var i = (parseInt($("#page").val()) - 1) * x; i < (parseInt($("#page").val()) * x); i++) {
            var jump = false;
            $.ajax({
                url: "get_track.php",
                type: 'POST',
                dataType: "html",
                async: false,
                data: {
                    print_type: $("#type").val(),
                    page: i
                },
                success: function (msg) {
                    if (x == 10) {
                        if (msg == "nothing") {
                            jump = true;
                        } else
                            $("#list").append(msg);
                    } else {
                        if (msg == "nothing") {
                            jump = true;
                        }
                        var tmp = count - 1;
                        $("#ul_" + tmp).append(msg);
                    }

                },
                error: function () {
                    alert("error");
                }
            });
            if (jump)
                break;
        }
    }

});
