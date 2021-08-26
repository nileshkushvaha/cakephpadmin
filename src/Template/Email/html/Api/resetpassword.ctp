<!DOCTYPE html>
<html>
<head>
	<title>Reset Template</title>
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
															<p>Dear <?= $name ?>,</p>
															<p>Greetings from Drivers Hub.</p>
															<p>Your password has been changed successfully.</p>
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