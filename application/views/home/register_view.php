<div class="row">
    
    <div class="span6">

        <form id="register_form" class="form-horizontal" method="post" action="<?=site_url('user/register'); ?>">

            <div id="register_form_alert" style="display: none;"></div>

            <div class="control-group">
                <label class="control-label">Login</label>
                <div class="controls">
                    <input type="text" name="login" class="input-xlarge" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input type="text" name="email" class="input-xlarge" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Password Again</label>
                <div class="controls">
                    <input type="password" name="password_again" class="input-xlarge" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                    <input type="password" name="password" class="input-xlarge" />
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input type="submit" value="Login" class="btn btn-primary" />
                </div>
            </div>

        </form>

        <a href="<?=$site_url('/')?>">Back</a>

    </div>

</div>

<script type="text/javascript">
    
    /*
    // JQuery Test
    $(function() {
        alert(1);
    });
    */

    $("#register_form").submit(function(evt) {
        evt.preventDefault();
        var url = $(this).attr('action');
        var postData = $(this).serialize();

        $.post(url, postData, function(o) {
            if (o.result == 1) {
                // alert('Login success.');
                window.location.href = '<?=site_url('dashboard') ?>';
            } else {
                // alert('Invalid login');
                $("#register_form_alert")
                    .html('Invalid login.')
                    .css('background-color','#f80')
                    .css('padding','10px 15px')
                    .fadeIn( "slow" );
            }
        }, 'json');

    });

</script>
