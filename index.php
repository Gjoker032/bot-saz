<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تکمیل ساخت ربات</title>
</head>
<body style="font-family:tahoma; font-size:12px">
<?php
//شما با این اسکریپت میتوانید یک سایت ربات ساز ارائه کنید
// در اینجا متغیر ها رو که از فرم دریافت میشن تعریف می کنیم

//متغیر دریافت آی پی مخاطب

@$ip= $_SERVER['REMOTE_ADDR'];

//متغیر دریافت Token

@$Token = addslashes($_POST['token']);

//متغیر دریافت آدی عددی مخاطب

@$id = addslashes($_POST['id']);



// در اینجا فرم رو اعتبار سنجی می کنیم یعنی فیلدهایی رو که پر کردن اونها رو اجباری کردید تعریف می کنید

// اعتبار سنجی اینکه فیلد Token خالی نباشد

if (strlen($Token) == 0 )

{

die("لطفا Token را وارد کنید");

}

//اعتبار سنجی آیدی عددی که ساختار پست آیدی عددی وارد شده را بررسی می کند
if(!preg_match('([0]|[1]|[2]|[3]|[4]|[5]|[6]|[7]|[8]|[9])', $id))


{

die("آیدی عددی  شما معتبر نمی باشد لطفا آن را بررسی نموده و دوباره امتحان کنید");

}

//اعتبار سنجی اینکه فیلد آیدی عددی خالی نباشد (بهتر است این بخش را پاک نکنید)

if (strlen($id) == 0 )

{

die("لطفا آیدی عددی خود را وارد نمایید");

}



//بخش ساخت ربات

//مکان سورس 
$url = "bots/$id/index.php";

//دریافت آیدی ربات
$getme = json_decode(file_get_contents("https://api.telegram.org/bot$Token/getme"));
$username = $getme->result->username;

//آدرس سورسی که سایت میسازع
$bot = file_get_contents("joker.php");

//گزاشتن توکن و آیدی عددی تو سورس
$bot = str_replace("*token*", "$Token", $bot);
$bot = str_replace("*admin*", "$id", $bot);

//ساخت پوشه 
mkdir("bots/$id");

//ساخت فایل اصلی
file_put_contents("bots/$id/index.php","$bot");

//ست وبهوک فایل
file_get_contents("https://api.telegram.org/bot$Token/setwebhook?url=https://honor.golden-cloud.ir/bot-saz/bots/$id/index.php");

//خروجی
echo"رباتت ساخته شد<br>";
echo $username;

//t.me/honor_tm
?>
</body>
</html>
