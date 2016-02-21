<div class="row">
    
    <div class="span6">


        <form id="register_form" class="form-horizontal" method="post" action="<?=site_url('user/register'); ?>">

            <?php /*
            <div id="register_form_alert" style="display: none;"></div>
            */ ?>

            <div class="control-group">
                <label class="control-label">&nbsp;</label>
                <div class="controls">
                    <div id="register_form_error" class="alert alert-error"><!-- Dynamic --></div>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">First Name</label>
                <div class="controls">
                    <input type="text" name="first_name" class="input-xlarge" value=""  />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Last Name</label>
                <div class="controls">
                    <input type="text" name="last_name" class="input-xlarge" value=""  />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Login</label>
                <div class="controls">
                    <input type="text" name="login" class="input-xlarge" value=""  />
                </div>
            </div>

            <div class="control-group" style="display: none;">
                <label class="control-label">City</label>
                <div class="controls">
                    <input type="text" name="city" class="input-xlarge" value="" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input type="text" name="email" class="input-xlarge" value=""  />
                </div>
            </div>

            <?php /*
            <div class="control-group">
                <label class="control-label">Email Again</label>
                <div class="controls">
                    <input type="text" name="email_again" class="input-xlarge" value="" />
                </div>
            </div>
            */ ?>

            <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                    <input type="password" name="password" class="input-xlarge" value="" />
                </div>
            </div>

            <?php /*
            <div class="control-group">
                <label class="control-label">Password Again</label>
                <div class="controls">
                    <input type="password" name="password_again" class="input-xlarge" value=""  />
                </div>
            </div>
            */ ?>

            <div class="control-group">
                <label class="control-label">&nbsp;</label>
                <div class="controls">
                    <div class="g-recaptcha" data-sitekey="6Lf-vxgTAAAAABPe3UFgdIqsGxC8PafHr8JPrIf7"></div>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input type="submit" value="Register" class="btn btn-primary" />
                </div>
            </div>

            <input type="hidden" name="register_referrer" value="<?=$this->agent->referrer(); ?>" />
            <input type="hidden" name="register_domain" value="<?=$_SERVER['HTTP_HOST']; ?>" />
            <input type="hidden" name="register_url" value="<?=current_url(); ?>" />

        </form>

        <a href="<?=site_url('/')?>">Back</a>

    </div>

</div>

<script type="text/javascript">
    
    /*
    // JQuery Test
    $(function() {
        alert(1);
    });
    */

    $("#register_form_error").hide();

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
                var output = '<ul>';
                // for (var i = 0, i < o.eror.length; i++ ) {
                for (var key in o.error) {
                    var value = o.error[key];
                    // console.log(key);
                    output += '<li>' + value + '</li>';
                }
                output += '</ul>';
                $("#register_form_error").html(output);
                $("#register_form_error").fadeIn("slow");

                /*
                $("#register_form_alert")
                    .html('Invalid login.')
                    .css('background-color','#f80')
                    .css('padding','10px 15px')
                    .fadeIn( "slow" );
                */
            }
        }, 'json');

    });

</script>

<script src='https://www.google.com/recaptcha/api.js'></script>
