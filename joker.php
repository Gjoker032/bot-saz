
<?php
ob_start();
define('API_KEY','*token*');
function bot($method,$datas=[]){ 
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$result=json_decode($message,true);
//0000000|API_REQ|
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
}

function sendaction($chat_id,$action){
bot('sendchataction',[
'chat_id'=>$chat_id,
'action'=>$action
 ]);
}
function senddocument($chat_id, $document, $caption){
 bot('senddocument',[
 'chat_id'=>$chat_id,
 'document'=>$document,
 'caption'=>$caption
 ]);
 }
 function sendmessage($chat_id, $text, $pars_mde){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>$pars_mde
 ]);
 }
 function save($filename,$TXTdata)
{
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, "$TXTdata");
    fclose($myfile);
}
//-//////honor_tm
$update = json_decode(file_get_contents('php://input'));
$message = $update->message; 
$chat_id = $message->chat->id;
$text = $message->text;
$from_id = $message->from->id;
$message_id = $message->message_id;
mkdir("data");
$ADMIN = *admin*;
$step = file_get_contents("data/step.txt");
$chat = $update->message->chat->type;
//-//////honor_tm

if (preg_match('/^\/([Ss][Tt][Aa][Rr][Tt])/',$text)){
if ($chat == 'private') {
$user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('Member.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('Member.txt',$add_user);
    }
sendaction($chat_id,typing);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"سلام دوست خوبم با من میتونی از تو ربات برنامه نویسی کنی جالب هست نه 
آموزش کار که خیلی راحته زبان برنامه نویسیتو از کیبورد زیر انتخاب کن 
---------------
Hi, my dear friend, you can program your robot with you
Learn how to easily select the language you want from the keyboard below",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"php"],['text'=>"py"]
    ],
     ],
    ]) 
   ]);
  }
}
 elseif($text == "/joker" && $from_id == $ADMIN){
sendaction($chat_id, typing);
        bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' =>"ادمین عزیز به پنل مدیریتی ربات خودش امدید",
                'parse_mode'=>'html',
      'reply_markup'=>json_encode([
            'keyboard'=>[
              [
              ['text'=>"آمار"],['text'=>"پیام همگانی"]
              ],
              ],'resize_keyboard'=>true
        ])
            ]);
        }
elseif($text == "آمار" && $from_id == $ADMIN){
 sendaction($chat_id,'typing');
    $user = file_get_contents("Member.txt");
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
 sendmessage($chat_id , " آمار کاربران : $member_count" , "html");
}
elseif($text == "پیام همگانی" && $from_id == $ADMIN){
    file_put_contents("ali.txt","bc");
 sendaction($chat_id,'typing');
 bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>" پیام مورد نظر رو در قالب متن بفرستید:",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
   [['text'=>'/joker']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "bc" && $from_id == $ADMIN){
    file_put_contents("ali.txt","none");
 SendAction($chat_id,'typing');
 bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>" پیام همگانی فرستاده شد.",
  ]);
 $all_member = fopen( "Member.txt", "r");
  while( !feof( $all_member)) {
    $user = fgets( $all_member);
   SendMessage($user,$text,"html");
  }
}
elseif ($text == 'Back Menu/برگشت') {
if ($chat == 'private') {
file_put_contents("data/step.txt","none");
sendaction($chat_id,typing);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Ok Well ...
The Main Menu Came Back !
-----------
خب دوست خوبم...
به منوی اصلی برگشتیم !",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"php"],['text'=>"py"]
      ],
     ],
    ]) 
   ]);
  }
return false;
}
elseif ($text == 'php'){
if ($chat == 'private'){
file_put_contents("data/step.txt","php");
sendaction($chat_id,typing);
 bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Ok Well ...
Please Send Your Text !
---------
خب...
لطفا متن خود را بفرستید!",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"Back Menu/برگشت"]
      ],
     ],
    ]) 
   ]);
  }
}
elseif ($step == "php"){

file_put_contents("data/step.txt","none");
$rand = rand(33411,8858);
$ce = $rand;	
file_put_contents("file$ce.php","<?php
$text

?>");
bot('SendDocument',[
    'chat_id'=>$chat_id,
    'document'=>new CURLFILE("file$ce.php"),
    'caption'=>"بیا داداش اینم کدت که به صورت php بهت تحویل دادم
کد نویسی های قبلی سوء تفاهم بوده😁❤️
—--------------------
Let me give you that code that I delivered to you as php
Previous coding was misunderstood",
 ]);
}

elseif ($text == 'py'){
if ($chat == 'private'){
file_put_contents("data/step.txt","py");
sendaction($chat_id,typing);
 bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Ok Well ...
Please Send Your TEXT !
--------
خب....
لطفا متن خود را بفرستید!",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"Back Menu/برگشت"]
      ],
     ],
    ]) 
   ]);
  }
}
elseif ($step == "py"){

file_put_contents("data/step.txt","none");
$r = rand(33411,8858);
$ce = $r;	
file_put_contents("file$ce.py","$text");
bot('SendDocument',[
    'chat_id'=>$chat_id,
    'document'=>new CURLFILE("file$ce.py"),
    'caption'=>"بیا داداش اینم کدت که به صورت py بهت تحویل دادم
کد نویسی های قبلی سوء تفاهم بوده😁❤️
@$idbot
—--------------------
Let me give you that code that I delivered to you as py
Previous coding was misunderstood
@$idbot",
 ]);
}
if($text == '/creator'){
bot('sendMessage',[
'chat_id'=>$chat_id,
 'text'=>"این ربات توسط @gjoker032 نوشته شده است
---------
This robot is programmed by @gjoker032",
'parse_mode'=>"markdown",
  ]);
}
if($text == '/chaneel'){
bot('sendMessage',[
'chat_id'=>$chat_id,
 'text'=>"این ربات توسط کانال
 @legendry_team
 ساخته شده است",
'parse_mode'=>"markdown",
  ]);
}
if($text == '/help'){
bot('sendMessage',[
'chat_id'=>$chat_id,
 'text'=>"آموزش:ابتدا زبان برنامه نویسی مورد نظرت رو انتخاب کن فعلا php و py ولی بعدا زبان های دیگه ساخته میشه بعد از انتخاب زبان مورد نظرت تیکه کد یا کدی که میخوای بسازم برات بفرس
--------
php: خب شما کافیه فقط تیکه کد را بفرستی من کد شما رو بین <?php و
?> میزارم تمام
----------
py:حرفی ندارم فقط تیکه کد را بفرست
----------
Tutorial: First, select the programming language you want, then select the code you want
--------",
'parse_mode'=>"markdown",
  ]);
}      
?>
