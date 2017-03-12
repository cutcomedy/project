<div id="change_email_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 style="text-align:center;">修改E-mail</h1>
            </div>
            <div class="modal-body">
                    <label for="email_pwd">password</label>
                    <input type="text" size="20" id="email_pwd" name="email_pwd" placeholder="8 - 20 characters" class="form-control">
                    <br>
                    <br>
                    <label for="new_email">new e-mail</label>
                    <input type="text" size="80" id="new_email" name="new_email" placeholder="8 - 20 characters" class="form-control">
                    <span id="warning_new_email" style="color:red"></span>
                    <br>

                    <div class="modal-footer">
                        <input type="button" class="btn btn-success" style="text-align:center;" id="signup" value="修改" disabled="disabled">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

            </div>
        </div>
    </div>
</div>
