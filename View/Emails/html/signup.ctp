
<body bgcolor="#fff" text="#979288" style="padding:0; margin:0;">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<style type="text/css">
 
</style>

<div style="background: #fff; font-family: 'Open Sans', sans-serif;" align="center">

  <table style="  font-size: 15px; line-height: 23px; width: 650px;" border="0" cellspacing="0" cellpadding="0" align="center">
    <tbody>
      <tr>
     
      </tr>
      <tr>
   
      </tr>
      <tr>
    
      </tr>
      <tr>
        <td width="650" align="center" valign="middle" bgcolor="#fff"><table style="font-family: 'Open Sans', sans-serif;  font-size: 15px; text-align: left; width: 575px;" border="0" cellspacing="0" cellpadding="0" align="center">
            <tbody>
              <tr>
                <td><br /> 
                 <br />
                  
                  
                    <p>Dear <?php 
     //$User=$this->Session->read('mail');
 // pr($data);
                    echo $data['User']['first_name']; ?>,</p>

<p>  Welcome to Jobider,please click below link to activate your account..</p>
<p><a href="<?php echo "http://www.jobider.com/users/activationlink/".$data['User']['token'] ;?>">Click here</a> to login</p>
<p>Regards,</p>
<p><b>Jobider team.</b></p>


<br />
                <br /></td>
              </tr>
            </tbody>
        </table></td>
      </tr> 
      <tr>
     
      </tr>
      <tr>
       
      </tr>
    </tbody>
  </table>
  <br>
  <br>
</div>
</body>

