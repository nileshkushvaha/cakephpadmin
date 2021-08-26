<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
</head>
<body>
  <div>
    <table style="border-collapse:collapse!important;border-spacing:0;vertical-align:top;text-align:left;background-color:#f5f5f5;height:100%;width:100%;color:#1a1a1a;">
      <tbody>
        <tr style="vertical-align:top;text-align:left;padding:0">
          <td align="center" valign="top" style="word-wrap:break-word;border-collapse:collapse!important;vertical-align:top;text-align:left;color:#1a1a1a;">
            <center style="width:100%;min-width:600px">
              <table align="center" bgcolor="#ffffff" style="border-collapse:collapse!important;border-spacing:0;vertical-align:top;text-align:center;background-color:#ffffff;width:600px;float:none;margin:0 auto;padding:0">
                <tbody>
                  <tr style="vertical-align:top;text-align:left;padding:0">
                    <td border="0">                               
                      <table style="border-collapse:collapse!important;border-spacing:0;vertical-align:top;text-align:left;width:100%;padding:0">
                        <tbody>
                          <tr style="vertical-align:top;text-align:left;padding:0">
                            <th style="color:#1a1a1a;font-weight:normal;text-align:left;line-height:1.5;font-size:17px;margin:0;padding:0">
                              <a href="#" style="color:#2199e8;font-weight:normal;text-align:left;line-height:1.3;text-decoration:none;margin:0;padding:0" target="_blank">
                                <center style="width:100%;min-width:552px;padding-top:40px;padding-bottom:40px">
                                  <img alt="logo" height="52" src="http://wh485650.ispot.cc/dev/drivers-hub/assets/img/logo.jpg" width="250" align="center" style="height:auto;line-height:100%;outline:none;text-decoration:none;max-width:100%;clear:both;display:block;float:none;text-align:center;margin:0 auto;border:0 none" class="CToWUd">
                                </center>
                              </a>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" style="padding-left: 10px;padding-right: 10px;">
                      <table bgcolor="#ffffff" style="border-collapse:collapse!important;vertical-align:top;text-align:left;background-color:#ffffff;width:600px;float:none;margin:0 auto;">
                        <tbody>
                          <tr>
                            <td>
                              <p><?= __('Dear').' '.$user->name; ?>,</p>
								<p><?=__('We heard that you lost your password, Sorry about that!');?></p>
								<p><?=__('But don\'t worry! You can use the following link within the next day to reset your password:');?></p>
							</td>
						</tr>
						<tr>
						<td>
							<center style="width:100%;min-width:552px">
								<a class="button" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'resetPassword', $user->fp_token, '_full' => true]); ?>" align="center" style="color:#ffffff;font-weight:normal!important;text-align:center!important;line-height:25px!important;text-decoration:none!important;border-radius:8px!important;display:inline-block!important;font-size:18px!important;background-color:#046186;margin:0;padding:12px 25px;border:0px solid #046186" target="_blank">
									<font color="#ffffff" style="color:#ffffff;background-color:#046186;border:0px solid #046186">Reset Password</font>
								</a>
							</center>
						</td>
					</tr>
						<tr>
							<td>
								<p><?=__('If you don\'t use this link within 24 hours, it will expire. To get a new password reset link,');?></p>
								<p><?=__('Visit : ');?>
									<?=$this->Html->link(
								    $this->Url->build(['controller' => 'Users', 'action' => 'forgotPassword', '_full' => true]),
								    ['controller' => 'Users', 'action' => 'forgotPassword', '_full' => true],
								    ['escape' => false]
								);?></p>
								<p><?=__('Thanks and have a nice day!');?></p>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:13px;line-height:14px;font-weight:bold" align="left" valign="top">
                              <br><br>
                              <p>Kind regards,</p>
                              <p>Drivers Hub</p>
                              <p><a href="<?= $this->Url->build('/', true);?>"><?= $this->Url->build('/', true);?></a></p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td align="center" valign="middle" style="background-color:#046186;color:#ffffff;padding:20px;border-bottom:5px solid #1a73e8">
                      <p style="text-align:center;color:#ffffff">Copyright @ 2020 Drivers Hub.</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </center>
          </td>
        </tr>
      </tbody>
    </table>

  </div>
</body>
</html>