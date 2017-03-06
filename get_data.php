<script>
    if ($("#mode").val() == "search") {
        if($("#type").val() == "0")
            var data_string = window.localStorage.product;
        else
            var data_string = window.localStorage.similarity;
        var data = JSON.parse(data_string);
        if($("#sort").val() == "0")
            var data_object = data["score"];
        else
            var data_object = data["hot"];
        var print_page = parseInt($("#page").val()) - 1;
        var price = 0;
        var len_object = Object.keys(data_object).length;
        for(var print_count = print_page * 10; print_count < (print_page * 10 + 10); print_count++) {
                var print_index = print_count.toString();
                $.ajax({
                    url: 'get_price.php',
                    type: 'POST',
                    dataType: "text",
                    async: false,
                    data: {
                        product_id: data_object[print_index]["id"],
                    },
                    success: function(msg) {
                        price = msg;

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                })
                var fb_share = data_object[print_index]["url"].replace("%", "%25");
                fb_share = "https://www.facebook.com/sharer/sharer.php?u=" + fb_share.replace(":", "%3A");
                var html_score = '<div class="" id="' + data_object[print_index]["id"] + '"><div class="row"><div class="col-sm-3" style="padding:0px;"><div class="col-sm-5 well well-sm" style="background:#dff0d8;width:48%;"><br><br><br><br><p style="text-align:center; font-size:17px;">' + (parseFloat(data_object[print_index]["score"])*100).toFixed(1) + '%</p><br><br><br></div><div class="col-sm-5 well well-sm" class="col-sm-5 well well-sm" style="background:#dff0d8; margin-left:5px;width:48%;"><br><br><br><br><p style="text-align:center; font-size:17px;">' + parseFloat(data_object[print_index]["popularity"]).toFixed(1) + '</p><br><br><br></div></div>';
                var html_img = '<div class="col-sm-9 well well-sm" style="background:#dff0d8;"><div class="col-sm-4"><img class="img" style=" width: 170px;height: 170px;" src =" ' + data_object[print_index]["pic"] + '"></div>';
                var html_detail = '<div class="col-sm-5"><br><h4 style="word-break:break-all">' + data_object[print_index]["name"] + '</h4><br><h4>NT : ' + price + '</h4></div>';
                var html_btn_url = '<div class="col-sm-2"><button type="button" style="margin:4px;" id="' + data_object[print_index]["id"] + '" class="btn btn-info shop" onclick="javascript:location.href=\'' + data_object[print_index]["url"] + '\'">' + data_object[print_index]["shop"] + '<span class="glyphicon glyphicon-chevron-right"></span></button>';
                var login = 0;
                $.ajax({
                    url: 'iflogin.php',
                    type: 'POST',
                    dataType: "text",
                    async: false,
                    data: {
                        product_id: data_object[print_index]["id"],
                    },
                    success: function(msg) {
                        if(msg == "1"){
                            login = 1;
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                })
                if(login == "1"){
                    var html_btn_track = '<button type="button" style="margin:4px;" class="btn btn-primary track" value="' + data_object[print_index]["url"] + '" id="' + data_object[print_index]["id"] + '">追蹤<span class="glyphicon glyphicon-heart"></span></button>';
                    var html_btn_share = '<button type="button" style="margin:4px;" class="btn btn-primary share" value="' + data_object[print_index]["url"] + '" id="' + data_object[print_index]["id"] + '" onclick="javascript:location.href=\'' + fb_share + '\'">share   <span class="glyphicon glyphicon-share"></span></button></div></div></div></div>';
                }
                else{
                    var html_btn_track = '<button type="button" style="margin:4px;" class="btn btn-primary" value="' + data_object[print_index]["url"] + '" id="' + data_object[print_index]["id"] + '" data-toggle="modal" data-target="#login_Modal">追蹤<span class="glyphicon glyphicon-heart"></span></button>';
                    var html_btn_share = '<button type="button" style="margin:4px;" class="btn btn-primary" value="' + data_object[print_index]["url"] + '" id="' + data_object[print_index]["id"] + '" data-toggle="modal" data-target="#login_Modal">share   <span class="glyphicon glyphicon-share"></span></button></div></div></div></div>';

                }
                $("#list").append(html_score + html_img + html_detail + html_btn_url + html_btn_track + html_btn_share);
        }
    }

</script>
