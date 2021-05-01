<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
</head>
<body>
    <style type="text/css">
		/*------ Client-Specific Style ------ */
		@-ms-viewport{width:device-width;}
		table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;}
		img{-ms-interpolation-mode:bicubic; border: 0;}
		p, a, li, td, blockquote{mso-line-height-rule:exactly;}
		p, a, li, td, body, table, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
		#outlook a{padding:0;}
		.ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
		.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td,img{line-height:100%;}

		/*------ Reset Style ------ */
		*{-webkit-text-size-adjust:none;-webkit-text-resize:100%;text-resize:100%;}
		table{border-spacing: 0 !important;}
		h1, h2, h3, h4, h5, h6{display:block; Margin:0; padding:0;}
		img, a img{border:0; height:auto; outline:none; text-decoration:none;}
		body, #bodyTable, #bodyCell{height:100%; margin:0; padding:0; width:100%;}

		.appleLinks a {color: #c2c2c2 !important; text-decoration: none;}
        span.preheader { display: none !important; }

		/*------ Google Font Style ------ */
		[style*="Open Sans"] {font-family:'Open Sans', Helvetica, Arial, sans-serif !important;}
		[style*="Poppins"] {font-family:'Poppins', Helvetica, Arial, sans-serif !important;}
		[style*="Lora"] {font-family:'Lora', Georgia, Times, serif !important;}

		/*------ General Style ------ */
		.wrapperWebview, .wrapperBody, .wrapperFooter{width:100%; max-width:600px; Margin:0 auto;}

		/*------ Column Layout Style ------ */
		.tableCard {text-align:left; font-size:0;}

		/*------ Images Style ------ */
		.imgHero img{ width:600px; height:auto; }

	</style>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F9F9F9;" id="bodyTable">
        <tr>
            <td align="center" valign="top" style="padding-right:10px;padding-left:10px;" id="bodyCell">
                <!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" style="width:600px;" width="600"><tr><td align="center" valign="top"><![endif]-->
                <!-- Email Wrapper Webview Open //-->
                <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperWebview">
                    <tr>
                        <td align="center" valign="top">
                            <!-- Content Table Open // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="right" valign="middle" style="padding-top:20px;padding-right:0px;" class="webview">

                                    </td>
                                </tr>
                            </table>
                            <!-- Content Table Close // -->
                        </td>
                    </tr>
                </table>
                <!-- Email Wrapper Webview Close //-->

                <!-- Email Wrapper Body Open // -->
                <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperBody">
                    <tr>
                        <td align="center" valign="top">

                            <table border="0" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF;border-color:#E5E5E5; border-style:solid; border-width:0 1px 1px 1px;" width="100%" class="tableCard">

                                <tr>
                                    <!-- Header Top Border // -->
                                    <td height="3" style="background-color:#2336FF;font-size:1px;line-height:3px;" class="topBorder" >&nbsp;</td>
                                </tr>

                                <!-- Table Card Open // -->
                                @yield('body')
                                <!-- Table Card Close// -->


                                <tr>
                                    <td align="right" valign="middle" style="padding-bottom: 40px;" class="emailRegards">
                                        <!-- Image and Link // -->
                                        <a href="javascript:void(0);" style="text-decoration:none;">
                                            @yield('signature')
                                        </a>
                                    </td>
                                </tr>

                            </table>

                            <!-- Space -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                <tr>
                                    <td height="30" style="font-size:1px;line-height:1px;">&nbsp;</td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
                <!-- Email Wrapper Body Close // -->

                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->

            </td>
        </tr>
    </table>
</body>
</html>
