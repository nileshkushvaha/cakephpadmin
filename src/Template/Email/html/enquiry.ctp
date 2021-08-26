<!DOCTYPE html>
<html>
  <head>
    <title>Online Enquiry</title>
    <style>
      .main-table-s th{ padding:5px; border:1px solid #ddd;text-align:left;}
      .main-table-s td{ padding:5px; border:1px solid #ddd;} 
    </style>
  </head>
  <body>
    <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td>
        <table cellpadding="0" cellspacing="0" width="650px" align="center" style="border:1px solid #ddd;background: #ffffff;">
    <tr>
      <td >
        <table cellpadding="0" cellspacing="0" width="100%" style="background: #f1f7f9" >
          <tr>
            <td style="padding:10px; text-align:center;">
              <a href="<?php echo $base_url ?>" >
                <img src="https://www.sidbi.in/assets/images/logo.png" alt="logo">
              </a>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <?php $needOptions = [1=>'Venture Funds',2=>'Refinance',3=>'NBFC assistance',4=>'Loans',5=>'Micro-Finance',6=>'PSIG Programmes',7=>'Small Finance Banks',8=>'Bonds/Debentures/Fixed Deposits',9=>'Others']; ?>
    <td style="border-top:1px solid #04b9f3;">
      <table cellpadding="0" cellspacing="0" class="main-table-s"  style="padding:10px;width:600px; margin:40px auto;" >
        <tbody>
          <tr>
            <th>Reference Number</th>
            <td><?=$referenceNumber;?></td>
          </tr>
          <tr>
            <th>Full Name</th>
            <td><?=$emailData['name'];?></td>
          </tr>
          <tr>
            <th>Email ID</th>
            <td><?=$emailData['emailid'];?></td>
          </tr>
          <tr>
            <th>Contact Number</th>
            <td><?=$emailData['mobile_number'];?></td>
          </tr>
          <tr>
            <th>Location</th>
            <td><?=$emailData['location'];?></td>
          </tr>
          <?php if(isset($emailData['product'])){?>
            <tr>
              <th>Product</th>
              <td><?=$emailData['product'];?></td>
            </tr>
          <?php }?>
          <tr>
            <th>
            <?php if(isset($emailData['product'])){?>
              Scheme
            <?php } else { ?>
              Need
            <?php } ?>
            </th>
            <td><?=$emailData['need'];?></td>
          </tr>
          <tr>
            <th>Other Need</th>
            <td><?=$emailData['other_need'];?></td>
          </tr>
          <tr>
            <th>Quantum of Assistance sought</th>
            <td><?=$emailData['qoas'];?></td>
          </tr>
          <tr>
            <th>Description</th>
            <td><?=$emailData['description'];?></td>
          </tr>
        </tbody>
        </td>
        </tr>  
      </table>
      <div style="padding-bottom:10px;text-align:center;">
        <div style="padding-bottom:10px;text-align:center;">
        <div class="footer-bottom-cont">
          <a href="https://www.facebook.com" style="padding-right:10px;">
            <img src="https://www.sidbi.in/assets/images/facebook-icon.png" alt="facebook">
          </a>
          <a href="https://twitter.com" style="padding-right:10px;">
            <img src="https://www.sidbi.in/assets/images/twitter-icon.png" alt="twitter">
          </a>
          <a href="https://plus.google.com">
            <img src="https://www.sidbi.in/assets/images/google-plus.png" alt="google-plus">
          </a>
          <p style="font-size:14px; line-height:14px; color:#4c4d4f;font-family:arial;text-align:center;">Copyright  ©2019 Small Industries Development Bank of India(SIDBI)</p>
        </div>
      </div>
      </div>
  </body>
</html>