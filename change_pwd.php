<div id="change_pwd_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 style="text-align:center;">修改密碼</h1>
            </div>
            <div class="modal-body">
                    <label for="old_pwd">old password</label>
                    <input type="text" size="20" id="old_pwd" name="old_pwd" placeholder="8 - 20 characters" class="form-control">
                    <br>
                    <br>
                    <label for="new_pwd_1">new password</label>
                    <input type="password" size="20" id="new_pwd_1" name="new_pwd_1" placeholder="8 - 20 characters" class="form-control">
                    <span id="warning_new_pwd_1" style="color:red"></span>
                    <br>
                    <label for="new_pwd_2">new password again</label>
                    <input type="password" size="20" id="new_pwd_2" name="new_pwd_2" placeholder="8 - 20 characters" class="form-control">
                    <span id="warning_new_pwd_2" style="color:red"></span>
                    <br>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-success" style="text-align:center;" id="signup" value="修改" disabled="disabled">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

            </div>
        </div>
    </div>
</div>
