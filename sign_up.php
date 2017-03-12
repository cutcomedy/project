<div id="sign_up_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 style="text-align:center;">註冊</h1>
            </div>
            <div class="modal-body">
                <label for="account">account</label>
                <input type="text" size="20" id="account_s" name="account" placeholder="8 - 20 characters" class="form-control">
                <span id="warning_account" style="color:red"></span>
                <br>
                <label for="password1">password</label>
                <input type="password" size="20" id="password1" placeholder="8 - 20 characters" class="form-control">
                <span id="warning_password1" style="color:red"></span>
                <br>
                <label for="password2">password again</label>
                <input type="password" size="20" id="password2" placeholder="8 - 20 characters" class="form-control">
                <span id="warning_password2" style="color:red"></span>
                <br>
                <label for="email">E-mail</label>
                <input type="text" size="60" id="email" name="email" class="form-control">
                <span id="warning_email" style="color:red"></span>
                <br>
                <div class="modal-footer">
                    <input type="button" class="btn btn-success" id="submit_sign_up" disabled="disabled" value="註冊">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
