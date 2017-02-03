<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Email-Template</title>
</head>
<body>
<table cellspacing="0px" cellpadding="10px" style="margin:0px auto; width:600;  font-family: 'Open Sans',sans-serif; border:1px solid #cccccc;">
  <tbody>
    <tr style="background:#434343;">
      <td><img alt="logo image" src="http://jobider.com/img/logo.png" /></td>
    </tr>
    <tr>
      <td>
<!--          <p style="color:#757575; margin-bottom:10px; font-size:14px;"> Hello </p>-->
          <p style="color:#757575; margin-bottom:10px; font-size:14px;"><strong><?php echo $data['User']['first_name'].' '.$data['User']['last_name']; ?></strong> has registered as <?php  echo $data['User']['type']; ?>   </p>
<!--        <p style="color:#757575; margin:0px; font-size:14px;"><?php //echo $client_fname.' '.$client_lname; ?> </p>-->
        <hr style="border:1px solid #EDEDED;" /></td>
    </tr>
   
  
    <tr style="background:#424242; padding:15px 0px; float:left;"> 
     <td> 
         <table>
     <td width="60%;"> 
         <p style="color:#ffffff; font-size:13px;"> <a href="http://jobider.com/client/notifications" target="_blank" style="color: #C7CBD6">Change Notification settings</a> | <a href="http://jobider.com/privacy" target="_blank" style="color: #C7CBD6">Privacy Policy</a> | <a href="http://jobider.com/contactus" target="_blank" style="color: #C7CBD6">Contact & Support </a> </p>
     </td>
     <td width="40%"><p style="text-align:right;"> <a href="https://dribbble.com/Jobider" style="text-decoration:none;"> <img alt="dribble" src="http://www.jobider.com/img/driible.png" /> </a> 
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
