<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Email-Template</title>
    </head>
    <body>
        <table cellspacing="0px" cellpadding="10px" style="margin:0px auto; width:600;  font-family: 'Open Sans',sans-serif; border:1px solid #cccccc;">
            <tbody>
                <tr style="background:#434343;">
                    <td><img alt="logo" src="http://www.jobider.com/img/logo.png" /></td>
                </tr>
                <tr>
                    <td><p style="color:#757575; margin-bottom:10px; font-size:14px;"> Hello <?php echo ucfirst($admin['User']['first_name']).' '.ucfirst($admin['User']['last_name']); ?></p>
                        <p style="color:#757575; margin-bottom:10px; font-size:14px;"> <?php echo ucfirst($session['User']['first_name']) . ' ' . ucfirst($session['User']['last_name']); ?> has been closed the project <?php  echo $job_title?>. with <?php  echo $rating; ?>star and <?php  echo $remarks;?>.Thanks for being a part.</br>
            
                        
                     </td>
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
                           <td width="40%"><p style="text-align:right;"> <a href="https://dribbble.com/Jobider" style="text-decoration:none;"> <img  alt="dribble"src="http://www.jobider.com/img/driible.png" /> </a> 
                                    <a href="https://plus.google.com/u/0/+jafarAdam/posts" style="text-decoration:none;"> <img alt="gplus" src="http://www.jobider.com/img/gplus.png" /> </a>
                                    <a href="https://twitter.com/vine" style="text-decoration:none;"> <img alt="vine" src="http://www.jobider.com/img/v.png" /></a>
                                    <a href="https://twitter.com/Solidhds" style="text-decoration:none;"> <img alt="twitter" src="http://www.jobider.com/img/twitter.png" /> </a>
                                    <a href="https://www.facebook.com/pages/Jobider/839942349415993" style="text-decoration:none;"> <img alt="fb" src="http://www.jobider.com/img/fb.png" /> </a>
                                </p> 
                            </td>
                        </table>
                    </td>
                </tr>


            </tbody>
        </table>
    </body>
</html>