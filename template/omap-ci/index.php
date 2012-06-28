<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{TITLE}</title>
<link href="{STYLE}style.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg_all">
<div id="layout" class="all">
    <div id="search">
    </div>
    <div id="body">
    	<div id="header"><div align="center" valign="middle"> == HEADER == </div></div>
        <!-- Top Menus -->
        <div id="menus"></div>
        <!-- Content -->
        <div id="content">
            <table border="0">
            	<tr valign="top">
                	<td>
                    	<div id="content-left"> 
                    		<div align="center">== SIDE LEFT ==</div>
                        </div>
                    </td>
                    <td>
                    	<div id="content-center">
                    		{DASBOR}
                        </div>
                    </td>
                    <td>
                    	<div id="content-right">
                    		<div align="center">== SIDE RIGHT ==</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Footer -->
        <div id="footer">&copy; <?=date('Y')?> omap-ci - All Right Reserved</div>
    </div>
</div>
<br /><br />
</body>
</html>