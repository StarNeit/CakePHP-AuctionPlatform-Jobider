<style type="text/css">
    .error-message {
        color: #ff0f14;
    }
</style>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<?php echo $this->Html->script(array('../jsjquery.ajax.form.min')); ?>
<script type="text/javascript">
    $(document).ready(function () {
        // Signup Sumbit with ajax
        var options = {
            beforeSubmit: showRequest,
            success: showResponse
        };
        $('#SignupForm').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });

        function showRequest(formData, jqForm, options) {
            //$('.popupbx').show();
        }

        function showResponse(responseText, statusText, xhr, $form) {
            data = $.parseJSON(responseText);
            console.log(data);
            $('div.error-message').remove();

            if (data.email) {
                errorDiv = '<div class="error-message">' + data.email[0] + '</div>';
                $('input[name="data[User][email]"]').after(errorDiv);
            }
            if (data.password) {
                errorDiv = '<div class="error-message">' + data.password[0] + '</div>';
                $('input[name="data[User][password]"]').after(errorDiv);
            }
            if (data.confirm_password) {
                errorDiv = '<div class="error-message">' + data.confirm_password[0] + '</div>';
                $('input[name="data[User][confirm_password]"]').after(errorDiv);
            }

            if (data.first_name) {
                errorDiv = '<div class="error-message">' + data.first_name[0] + '</div>';
                $('input[name="data[User][first_name]"]').after(errorDiv);
            }

            if (data.last_name) {
                errorDiv = '<div class="error-message">' + data.last_name[0] + '</div>';
                $('input[name="data[User][last_name]"]').after(errorDiv);
            }
            //$('.popupbx').hide();
            if (data.status == 'success') {
                $("#signup").modal("hide");
                $("#signup_confiramation").modal("show");
                return false;
//              window.location.href = data.url;
            }
            else {
                return false;
//                $(".errorMsg").html('Please fill in the missing fields.');
//                $(".SignupErrorDiv").show();
//                document.getElementById("ScrollUp").scrollIntoView();
            }
        }
    });
</script>