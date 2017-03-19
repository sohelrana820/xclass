<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Task Manager</title>
</head>
<body style="margin:0px;font-family: Arial, Helvetica, sans-serif;font-family: Calibri;background-color: ##212121;">
<table cellpadding="0" cellspacing="0"
       style="border-collapse: collapse; width: 650px;height: auto;margin: 15px auto;background: #FFF;  border: 1px solid #DDD;border-top: 5px solid #3E4651;border-bottom: 5px solid #3E4651;">
    <!--HEADER-->
    <tr>
        <td style="width: 100%;height: auto;padding-top: 15px;text-align: center;background: #FFF;border-bottom: 1px dashed #DDD;">
            <p style="font-size: 18px;font-family: Georgia, 'Times New Roman', Times, serif;"><?php echo $data['appName'];?>
            </p>
        </td>
    </tr>
    <!--/HEADER-->
    <!--CONTENT-->
    <tr>
        <td valign="top" style="width: 100%;padding: 20px 50px;">
            <p style="color: #3E4651;font-weight: normal;font-size: 14px;">
                Dear <?php echo $data['user']['name'];?>, <br/><br/>
                Application has been installed successfully!
            </p>
            <br/>
        </td>
    </tr>
    <!--/CONTENT-->
    <!--FOOTER-->
    <tr>
        <td style="width: 100%;padding: 0px 50px;height: 80px;border-top: 1px dashed #DDD;text-align: center;">
            <p style="color: #777;line-height: 25px;font-size: 16px;"><span>All rights reserved.</span></p>
        </td>
    </tr>
    <!--/FOOTER-->
</table>
</body>
</html>