<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Email-Template</title>
    </head>
    <body>
        <table cellspacing="0px" cellpadding="10px" style="margin:0px auto; width:600;  font-family: 'Open Sans',sans-serif; border:1px solid #cccccc;">
            <tbody>
                <tr style="background:#434343;">
                    <td><img alt="logo image" src="http://www.jobider.com/img/logo.png" /></td>
                </tr>
                <tr>
                    <td><p style="color:#757575; margin-bottom:10px; font-size:14px;"> Hello <?php echo $client_fname; ?></p>
                        <p style="color:#757575; margin-bottom:10px; font-size:14px;"> <?php echo ucfirst($free_fname) . ' ' . ucfirst($free_lname); ?> accepted your invitation to interview for the job <a href="http://jobider.com/client/job_application/<?php echo $Job_id ?>"> <?php echo $data; ?></a></p>
                        <p style="color:#757575; margin:0px; font-size:14px;">To view <?php echo $client_fname; ?>'s  message  and  start  your  interview, visit your Jobider Message Center here: <a href="http://www.jobider.com/client/mymessages">http://www.jobider.com/client/mymessages</a> </p>
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
                           <td width="80%"><p style="text-align:right;"> <a href="https://dribbble.com/Jobider" style="text-decoration:none;"> <img alt="dribble" src="http://www.jobider.com/img/driible.png" /> </a> 
                                    <a href="https://plus.google.com/u/0/+jafarAdam/posts" style="text-decoration:none;"> <img alt="gplus" src="http://www.jobider.com/img/gplus.png" /> </a>
                                    <a href="https://twitter.com/vine" style="text-decoration:none;"> <img alt="vine" src="http://www.jobider.com/img/v.png" /></a>
                                    <a href="https://twitter.com/Solidhds" style="text-decoration:none;"> <img alt="twitter" src="http://www.jobider.com/img/twitter.png" /> </a>
                                    <a href="https://www.facebook.com/pages/Jobider/839942349415993" style="text-decoration:none;"> <img alt="Faceboook" src="http://www.jobider.com/img/fb.png" /> </a>
                                </p> 
                            </td>
                        </table>
                    </td>
                </tr>


            </tbody>
        </table>
    </body>
</html>