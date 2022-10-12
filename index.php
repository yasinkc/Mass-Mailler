
<?php
session_start ();

echo $_SESSION["echoList"];
 $_SESSION["echoList"] = "";

if ($_POST){
    
    
    $key="1234"; // PHP code will work if it matches the password specified in the

    $m_title=$_POST["m_title"];
    $m_body=$_POST["m_body"];
    $mailList=$_POST["mailList"];
    $password=$_POST["password"];


    // Your email information START

    $senderUserName="Web Tasarım";

    $senderMailAdres  = "example@gmail.com";
    $senderMailPass   = "password123";

    $senderMailPort   = 465; // 25 or 587 or 465
    $senderMailSecure = "ssl"; // ssl or tsl
    $senderMailHost   = "smtp.gmail.com";

    // Your email information END

    $datas = "";
    include 'class.phpmailer.php';
     
    if($password==$key){
            
            $mailAdresDizi = explode("\n",$mailList);

            foreach($mailAdresDizi as $mAdres) {

                $uyku = 0;
                //$uyku = rand(1,3);
                //sleep($uyku);
               
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = $senderMailHost;
                $mail->Port = $senderMailPort;
                $mail->SMTPSecure = $senderMailSecure;
                $mail->Username = $senderMailAdres;
                $mail->Password = $senderMailPass;
                $mail->SetFrom($mail->Username, $senderUserName);
                $mail->AddAddress($mAdres, 'SendUser');
                $mail->CharSet = 'UTF-8';
                $mail->Subject = $m_title;
                $mail->MsgHTML($m_body);
                if(!$mail->Send())
                {
                    $errorInfo = $mail->ErrorInfo;
                    $datas .= "<div class='alert alert-danger centr col-md-7'><strong>Error!</strong> Mail could not be sent. -> -> ".$errorInfo."</div>";
                }else{
                    $datas .= "<div class='alert alert-success centr col-md-7'><strong>Succes!</strong> E-Mail Adress: ".$mAdres." - Sleep Time: ".$uyku."</div>";
                }
                
        }


    }else{
        $datas .= "<div class='alert alert-danger centr col-md-7'><strong>Error!</strong> Password does not match php code.</div>";
    }
    $_SESSION["echoList"] = $datas;
    
    header('Location: index.php');
}





?>

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/summernote.css">
    <script src="js/jquery/jquery-2.2.1.js"></script>
    <script src="js/jquery/jquery-2.2.1.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        td{
            padding-top: 25px;
        }
        input, textarea{
            width: 100%;
        }
        body{
            background-color: #0CF;
        }
        .panel-body{
			background: #F9F9F9;
			padding: 25px;
			float:none;
        }
		.centr{
            float: none;
            margin: 10 auto;
        }
        .panelop{
			margin: 50px 0;
        }
    </style>
    <title>Mass Mailler | No Spam</title>
</head>

<body>

<div class="container-padding">
    <div class="col-md-8 centr">


				<div class="panel-body panelop">
				
				<form action="index.php" method="post" class="form-horizontal">

                <div class="form-group">
						<label for="input002" class="col-sm-2 control-label form-label"></label>
						<div class="col-sm-10">
							<img src="logo.png" />
						</div>
					</div>
				

					<div class="form-group">
						<label for="input002" class="col-sm-2 control-label form-label">Title</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="m_title" placeholder="example: Big Campaign | MediaMarkt">
						</div>
					</div>
					<div class="form-group">
						<label for="input002" class="col-sm-2 control-label form-label">Body</label>
						<div class="col-sm-10">
							<textarea class="form-control summernote" name="m_body" ></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="input002" class="col-sm-2 control-label form-label">Mail List</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="10" name="mailList" placeholder="Each line one email address &#10;mark@gmail.com&#10;alice@example.com&#10;jonathandoe@hotmail.com"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="input002" class="col-sm-2 control-label form-label">Code Key</label>
						<div class="col-sm-10">
							<input type="password" name="password" class="form-control" placeholder="PHP code will work if it matches the password specified in the.">
						</div>
					</div>
					<div class="form-group">
						<label for="input002" class="col-sm-2 control-label form-label"></label>
						<div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Send Mail</button>
						</div>
					</div>
					
					
				</form>
		</div>
</div>
</div>

</body>
    <script type="text/javascript">
        $(function() {
            // Control editor height
            $('.summernote').summernote({
                height: 300,
                lang: "en-EN"
            });
        });
    </script>
    <script type="text/javascript" src="js/summernote/summernote.min.js"></script>
    <script type="text/javascript" src="js/summernote/lang/summernote-tr-TR.js"></script>
    <script src="js/bootstrap.min.js"></script>
</html>

