        $(document).ready(function () {
            var count = 1;
            var count_6 = 0;
            var count_7 = 0;
            var count_arr = [];
            count_arr[0] = [0, 1, 1];
            $("#array").val(count_arr);
            /*create condition*/
            $(".no").on('click', function () {
                if ($(this).hasClass('done'))
                    return false;
                var tmp = $(this).text();
                var val = $(this).attr("value");

                create_condition(val, count);
                if (val != "6" && val != "7") {
                    $(this).attr('class', 'done');
                } else if (val == "6")
                    count_6 += 1;
                else if (val == "7")
                    count_7 += 1;
                count = count + 1;
            });
            /*delete condition*/
            $('body').on('click', '.b_del', function () {
                var tmp = $(this).attr('id');
                var x = tmp.replace(/[^0-9-\.]/g, '');
                var num = x.split("-");
                $("#all_" + x).remove();
                var i = 0;
                while(i < count_arr.length){
                    if(count_arr[i][0] == num[0]){
                        count_arr.splice(i, 1);
                        $("#array").val(count_arr);
                        break;
                    }
                    i+=1;
                }
                $("#li_" + num[0]).attr('class', 'no');

            });
            /*delete input*/
            $('body').on('click', '.b_c_del', function () {
                var tmp = $(this).attr('id');
                var b_add_id = tmp.replace(/[^0-9-\.]/g, '');
                var num = b_add_id.split("-");
                var num_1 = parseInt(num[1]);
                num_1 = num_1 - 1;
                tmp = '#' + tmp;
                var i = "add_" + num[0] + "-" + num_1;
                $(b_add_id).attr('id', i);
                $(tmp).remove();
                for(var i = 0; i < count_arr.length; i++){
                    if(count_arr[i][0] == num_1){
                        count_arr[i][2] -= 1;
                        $("#array").val(count_arr);
                        break;
                    }
                }
            });
            /*add input */
            $('body').on('click', '.b_add_condition', function () {
                var tmp = $(this).attr('id');
                var id_now = tmp.replace(/[^0-9-\.]/g, '');
                var num = id_now.split("-");
                var val = num[0];
                if (val == "6" || val == "7") {
                    var num_end = parseInt(num[2]);
                    var num_next = num_end + 1;
                    var id_next = val + "-" + num[1] + "-" + num_next;
                    id_now = val + "-" + num[1];
                } else {
                    var num_end = parseInt(num[1]);
                    var num_next = num_end + 1;
                    var id_next = val + "-" + num_next;
                    id_now = val;
                }
                $(this).attr("id", "add_" + id_next);
                create_conform(0, val, count, id_next, id_now)

            })
            $(".k").click(function(){
                $(".highlight").removeClass('done');
                $("#kind").text($(this).text());
                var output = condition_display($(this).text());
                for(var i = 0; i < 21; i++){
                    $("#li_" + i).addClass('done');
                }
                for(var i = 0; i < output.length; i++){
                    $("#li_" + output[i]).removeClass('done');
                }
                var condition_now = $("#array").val();
                condition_now = condition_now.split(",");
                for(var j = 3; j < condition_now.length; j+=3){
                    $("#delete_" + condition_now[j]).click();
                }
            })

            $("#submit").click(function(){
                $('select').attr('disabled', false);
            })
            function condition_display(val){
                switch(val){
                    case "美妝":
                        var result = [1, 5, 6, 7, 18, 19, 20];
                        return result;
                    case "家用品":
                        var result = [1, 2, 3, 4, 5, 6, 7, 8, 10, 11, 12, 14, 15, 20];
                        return result;
                    case "家電器":
                        var result = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 14, 15, 20];
                        return result;
                    case "鞋款":
                        var result = [1, 5, 6, 7, 8, 17, 20];
                        return result;
                    case "服飾":
                        var result = [1, 5, 6, 7, 8, 16, 20];
                        return result;
                    case "3C與周邊":
                        var result = [1, 2, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 20];
                        return result;
                    case "食品與藥品":
                        var result = [1, 4, 5, 6, 7, 19, 20];
                        return result;
                    case "所有商品":
                        var result = [1, 2, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
                        return result;

                }
            }
            function set_condition(val, condition, id_next) {
                const weight = '<option value="1">m.t(公噸) </option> <option value="2">kg(公斤) </option><option value="3">g(克) </option><option value="4">mg(毫克) </option>';
                const capacity = '<option value="5"> L(公升) </option><option value="6"> ml(毫升) </option>';
                const long = '<option value="7"> cm(公分) </option><option value="8">m(公尺) </option>';
                const time = '<option value="10">年</option><option value="11">月</option>';
                const byte = '<option value="12"> MB </option><option value="13"> GB </option><option value="14"> TB </option>';

                const unit_none_1 = '<div class="col-sm-3"><div class="input-group"><span class="input-group-addon">單位</span><select required class="form-control input-sm"  disabled="disabled" name="unit_' + id_next + '" id="unit_' + id_next + '"><option selected value="0">'
                const unit_none_2 = '</option><select></div></div>';
                const unit_none_hidden = '<select style="display:none;" disabled="disabled" name="unit_' + id_next + '" id="unit_' + id_next + '"><option selected value="0"></option><select>'
                const unit_normal = '<div class="col-sm-3"><div class="input-group"><span class="input-group-addon">單位</span><select required class="form-control input-sm" name="unit_' + id_next + '" id="unit_' + id_next + '">';
                const nothing = '<option value="0">無單位</option>';
                const unit_end = '</select></div></div>';

                switch (val) {
                    case "0":
                        condition.discrete = 1;
                        condition.condition_name = '品牌<input type="hidden" name="condition_input_1" value="品牌">';
                        condition.conform_name = "名稱";
                        condition.unit = unit_none_hidden;
                        break;
                    case "1":
                        condition.discrete = 1;
                        condition.condition_name = '品牌<input type="hidden" name="condition_input_1" value="品牌">';
                        condition.conform_name = "品牌";
                        condition.unit = unit_none_1 + '無單位' + unit_none_2;
                        break;
                    case "2":
                        condition.discrete = 0;
                        condition.condition_name = '保固<input type="hidden" name="condition_input_2" value="保固">';
                        condition.conform_name = "保固";
                        condition.unit = unit_normal + time + unit_end;
                        break;
                    case "3":
                        condition.discrete = 0;
                        condition.condition_name = '尺寸<input type="hidden" name="condition_input_3" value="尺寸">';
                        condition.conform_name = "尺寸";
                        condition.unit = unit_normal + long + unit_end;
                        break;
                    case "4":
                        condition.discrete = 0;
                        condition.condition_name = '重量<input type="hidden" name="condition_input_4" value="重量">';
                        condition.conform_name = "重量";
                        condition.unit = unit_normal + weight + unit_end;
                        break;
                    case "5":
                        condition.discrete = 0;
                        condition.condition_name = '價格<input type="hidden" name="condition_input_5" value="價格">';
                        condition.conform_name = "新台幣";
                        condition.unit = unit_none_1 + '元' + unit_none_2;
                        break;
                    case "6":
                        condition.discrete = 1;
                        condition.condition_name = '條件<br><input type="text" size="6" name="condition_input_6-' + count_6 + '" id="condition_input_6-' + count_6 + '">';
                        condition.conform_name = "條件";
                        condition.unit = unit_normal + nothing + weight + capacity + long + time + byte + unit_end;
                        condition.count += 1;
                        condition.id = condition.id + '-' + (count_6);
                        break;
                    case "7":
                        condition.discrete = 0;
                        condition.condition_name = '條件<br><input type="text" size="6" name="condition_input_7-' + count_7 + '" id="condition_input_7-' + count_7 + '">';
                        condition.conform_name = "條件";
                        condition.unit = unit_normal + nothing + weight + capacity + long + time + byte + unit_end;                        condition.count += 1;
                        condition.id = condition.id + '-' + (count_7);
                        break;
                    case "8":
                        condition.discrete = 1;
                        condition.condition_name = '顏色<input type="hidden" name="condition_input_8" value="顏色">';
                        condition.conform_name = "顏色";
                        condition.unit = unit_none_1 + '無單位' + unit_none_2;
                        break;
                    case "9":
                        condition.discrete = 0;
                        condition.condition_name = '螢幕尺寸<input type="hidden" name="condition_input_9" value="螢幕尺寸">';
                        condition.conform_name = "尺寸";
                        condition.unit = unit_none_1 + '吋' + unit_none_2;
                        break;
                    case "10":
                        condition.discrete = 0;
                        condition.condition_name = '長<input type="hidden" name="condition_input_10" value="長">';
                        condition.conform_name = "長";
                        condition.unit = unit_normal + long + unit_end;
                        break;
                    case "11":
                        condition.discrete = 0;
                        condition.condition_name = '寬<input type="hidden" name="condition_input_11" value="寬">';
                        condition.conform_name = "寬";
                        condition.unit = unit_normal + long + unit_end;
                        break;
                    case "12":
                        condition.discrete = 0;
                        condition.condition_name = '高<input type="hidden" name="condition_input_12" value="高">';
                        condition.conform_name = "高";
                        condition.unit = unit_normal + long + unit_end;
                        break;
                    case "13":
                        condition.discrete = 0;
                        condition.condition_name = '畫素<input type="hidden" name="condition_input_13" value="畫素">';
                        condition.conform_name = "畫素";
                        condition.unit = unit_none_1 + '畫素' + unit_none_2;
                        break;
                    case "14":
                        condition.discrete = 0;
                        condition.condition_name = '深<input type="hidden" name="condition_input_14" value="深">';
                        condition.conform_name = "深";
                        condition.unit = unit_normal + long + unit_end;
                        break;
                    case "15":
                        condition.discrete = 1;
                        condition.condition_name = '材質<input type="hidden" name="condition_input_15" value="材質">';
                        condition.conform_name = "材質";
                        condition.unit = unit_none_1 + '無單位' + unit_none_2;
                        break;
                    case "16":
                        condition.discrete = 1;
                        condition.condition_name = 'SIZE<input type="hidden" name="condition_input_16" value="SIZE">';
                        condition.conform_name = "SIZE";
                        condition.unit = '<select name="unit_' + id_next + '" id="unit_' + id_next + '"><option value="xxl">XXL</option><option value="xl">XL</option><option value="l">L</option><option value="m">M</option><option value="s">S</option><option value="xs">XS</option><select>';
                        break;
                    case "17":
                        condition.discrete = 0;
                        condition.condition_name = '鞋碼<input type="hidden" name="condition_input_17" value="鞋碼">';
                        condition.conform_name = "鞋碼";
                        condition.unit = unit_none_1 + '碼' + unit_none_2;
                        break;
                    case "18":
                        condition.discrete = 0;
                        condition.condition_name = '容量<input type="hidden" name="condition_input_18" value="容量">';
                        condition.conform_name = "容量";
                        condition.unit = unit_normal + capacity + unit_end;
                        break;
                    case "19":
                        condition.discrete = 0;
                        condition.condition_name = '使用期限<input type="hidden" name="condition_input_19" value="使用期限">';
                        condition.conform_name = "使用期限";
                        condition.unit = unit_normal + time + unit_end;
                        break;
                    case "20":
                        condition.discrete = 1;
                        condition.condition_name = '產地<input type="hidden" name="condition_input_19" value="產地">';
                        condition.conform_name = "產地";
                        condition.unit = unit_none_1 + '無單位' + unit_none_2;
                        break;


                }
            }

            function create_condition(val, count) {
                var condition = {
                    condition_name: "",
                    conform_name: "",
                    unit: "",
                    id: val
                }
                if (val == "6") {
                    var num = val + '-' + count_6;
                }
                else if(val == "7"){
                    var num = val + '-' + count_7;
                }
                else {
                    var num = val;
                }

                set_condition(val, condition, num + '-0');
                var begin = '<div class="media" id="all_' + num + '"><div class="media-left well well-sm" style="background:#8080ff;">';
                var title = '<span style="font-size:18px">' + condition.condition_name + '</span></div>';
                var condition_imp = '<div class="media-body" style="background: #b3b3ff;"><table class="table"  style="background: #b3b3ff; margin:0px;" id="no_' + num + '"><thead><th><div class="col-sm-5"></div><div class="col-sm-5"><div class="input-group"><span class="input-group-addon">重要程度</span><select required name="condition_imp_' + condition.id + '" id="condition_imp_' + condition.id + '" class="form-control input-sm"><option selected=""></option><option value="6">最重要</option><option value="5">非常重要</option><option value="4">比較重要</option><option value="3">普通</option><option value="2">比較不重要</option><option value="1">非常不重要</option><option value="0">完全不重要</option></select></div></div>';
                var add_condition = '<div class="col-sm-1"><button type="button" class="btn btn-success b_add_condition btn-sm" id="add_' + condition.id + '-0"><span class="glyphicon glyphicon-plus"></span></button></div>';
                var del = '<div class="col-sm-1"><button type="button" class="btn btn-danger b_del btn-sm" id="delete_' + num + '"><span class="glyphicon glyphicon-remove"></span></button></div></th></thead>';
                var conform_input = '<tbody><tr id = "conform_in_tr_' + condition.id + '-0"><td><div class="row"><div class="col-sm-4"><div class="input-group"><span class="input-group-addon">' + condition.conform_name + '</span><input required class="form-control input-group input-sm" type="text" size="20" name="conform_in_' + condition.id + '-0" id="conform_in_' + condition.id + '-0"></div></div>' + condition.unit;
                var conform_degree = '<div class="col-sm-4"><div class="input-group"><span class="input-group-addon">符合程度</span><select required class="form-control input-sm" name="conform_imp_' + condition.id + '-0" id="conform_imp_' + condition.id + '-0"><option></option><option value="6">完全符合</option><option value="5">非常符合</option><option value="4">比較符合</option><option value="3">普通</option><option value="2">比較不符合</option><option value="1">非常不符合</option><option value="0">完全不符合</option></select></div></div></div></td></tr></tbody></table>';
                $("#upup").before(begin + title + condition_imp + add_condition + del + conform_input + conform_degree);
                if(condition.discrete == 0){
                    create_conform(1, val, count, condition.id + "-1", condition.id);
                    $("#conform_imp_" + condition.id + "-0").val('6').change();
                    $("#conform_imp_" + condition.id + "-1").val('0').change();
                    $("#conform_imp_" + condition.id + "-0").attr('disabled', 'disabled');
                    $("#conform_imp_" + condition.id + "-1").attr('disabled', 'disabled');
                    $("#add_" + condition.id + "-0").attr('id', "#add_" + condition.id + "-1");
                    count_arr.push([num, condition.discrete, 2]);
                }
                else{
                    count_arr.push([num, condition.discrete, 1]);
                }
                if(val == 16)
                    $("#conform_in_" + condition.id + "-0").remove();
                $("#array").val(count_arr);
            }

            function create_conform(mode, val, count, id_next, id_now) {
                var condition = {
                    condition_name: "",
                    conform_name: "",
                    unit: "",
                    id: val
                }
                set_condition(val, condition, id_next);

                if (val == 0){
                    var class_input = "col-sm-6";
                    var class_degree = "col-sm-5";
                }
                else{
                    var class_input = "col-sm-4";
                    var class_degree = "col-sm-4";
                }
                var htm_tr = '<tr id = "conform_in_tr_' + id_next + '"><td><div class="row"><div class="' + class_input + '"><div class="input-group"><span class="input-group-addon">' + condition.conform_name + '</span><input required class="form-control input-sm" type="text" size="20" name="conform_in_' + id_next + '" id="conform_in_' + id_next + '"></div></div>' + condition.unit;
                var htm_degree = '<div class="' + class_degree + '"><div class="input-group"><span class="input-group-addon">符合程度</span><select required class="form-control input-sm" name="conform_imp_' + id_next + '" id="conform_imp_' + id_next + '"><option></option><option value="6">完全符合</option><option value="5">非常符合</option><option value="4">比較符合</option><option value="3">普通</option><option value="2">比較不符合</option><option value="1">非常不符合</option><option value="0">完全不符合</option></select></div></div>';
                var htm_x = '<div class="col-sm-1"><button type="button" class="btn btn-danger btn-sm b_c_del" id="conform_in_tr_' + id_next + '"><span class="glyphicon glyphicon-remove"></span></button></div></div></td>'
                if(condition.discrete == 0 && mode == 1){
                    htm_x = '</td></tr>';
                }
                var loc_t = "#no_" + id_now;
                $(loc_t).append(htm_tr + htm_degree + htm_x);
                for(var i = 0; i < count_arr.length; i++){
                    if(count_arr[i][0] == id_now){
                        count_arr[i][2] += 1;
                        $("#array").val(count_arr);
                        break;
                    }
                }

            }
        });
