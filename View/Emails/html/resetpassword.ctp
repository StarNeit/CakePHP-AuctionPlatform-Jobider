<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Email-Template</title>
    </head>
    <body>
        <table cellspacing="0px" cellpadding="10px" style="margin:0px auto; width:600;  font-family: 'Open Sans',sans-serif; border:1px solid #cccccc;">
            <tbody>
                <tr style="background:#434343;">
                    <td><img alt="dribble" src="http://www.jobider.com/img/logo.png" /></td>
                </tr>
                <tr>
                    <td><p style="color:#757575; margin-bottom:10px; font-size:14px;"> Hello </p>
                        <p style="color:#757575; margin-bottom:10px; font-size:14px;"> Please confirm your New Password. Please go through the link to reset your password <a href="<?php echo "http://www.jobider.com/login/resetpassword/" . $data['User']['user_token']; ?>">Click here</a> to reset password.</p>
                        
                        <!--        <hr style="border:1px solid #EDEDED;" />--></td>
                </tr>


                <tr>
                    <td><p style="color:#424242; margin-top:20px; font-size:14px; text-align:left;"> Thanks </p>
                        <p style="color:#424242; margin-top:20px; font-size:14px; text-align:left;"> Jobider Support </p>
                        <hr style="border:1px solid #EDEDED; margin-top:25px;" />
                    </td>
                </tr>

                <tr style="background:#434343; padding:15px 0px;  width:100%;"> 
                    <td style="width:100%;"> 
                        <table style="width:100%;">
                            <td width="70%;"> 
                                <p style="color:#ffffff; font-size:13px;"> Change Notification settings | Privacy Policy | Contact & Support </p>
                            </td>
                            <td width="40%"><p style="text-align:right;"> <a href="https://dribbble.com/Jobider" style="text-decoration:none;"> <img alt="dribble" src="http://www.jobider.com/img/driible.png" /> </a> 
                                    <a href="https://plus.google.com/u/0/+jafarAdam/posts" style="text-decoration:none;"> <img alt="dribble" src="http://www.jobider.com/img/gplus.png" /> </a>
                                    <a href="https://twitter.com/vine" style="text-decoration:none;"> <img alt="dribble" src="http://www.jobider.com/img/v.png" /></a>
                                    <a href="https://twitter.com/Solidhds" style="text-decoration:none;"> <img alt="dribble" src="http://www.jobider.com/img/twitter.png" /> </a>
                                    <a href="https://www.facebook.com/pages/Jobider/839942349415993" style="text-decoration:none;"> <img alt="dribble" src="http://www.jobider.com/img/fb.png" /> </a>
                                </p> 
                            </td>
                        </table>
                    </td>
                </tr>


            </tbody>
        </table>
    </body>
</html>