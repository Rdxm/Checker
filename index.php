<html>
<head>
<link href="assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
<link href="assets/vendors/bootstrap/css/bootstrapogi.css" rel="stylesheet" id="bootstrap-css">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>The Holy Grail</title>
</head>
<body style="background-color:#343c4a;">
<br><center>
<div class="col-md-12">
<div class="card-body" style="background-color:#404552";>
<img src="assets/img/logo.png" alt="The Holy Grail" width="70" height="70"> <br><br><h3>The Holy Grail</h3><hr>


Cvv: <span id="cLive" class="text text-light">0</span>
Ccn: <span id="cWarn" class="text text-light">0</span>
Dead: <span id="cDie" class="text text-light"> 0</span>
Total: <span id="carregadas" class="text text-light">0</span></div><br>
</center>

<center>
<div class="col-md-12">
<div class="card-body" style="background-color:#404552";>
<div class="md-form">
</div>
<span style="float: center;">Credit Cards :</span>
<textarea type="text" style="text-align: center;" id="lista" class="md-textarea form-control" rows="7" placeholder="xxxxxxxxxxxxxxx|xx|xxxx|xxx"></textarea><br>


<span style="float: center;">Secret Key :</span>
<textarea type="text" style="text-align: center; height:30;" id="sk" name="sk" class="md-textarea form-control" rows="1" placeholder="sk_live_xxxxxxxxxxxxxx"></textarea>
<br>
<center>
<br>
<div class="col-md-12">
<center>
 <button class="btn btn-pogi" style="width: 90%; outline: none;" id="testar" onclick="enviar()" >START</button>


</div></div>
<br></center>
</center></center>
<div class="col-md-12">
<div class="card-body" style="background-color:#404552";>
<div class="card">
	<button id="mostra" class="btn btn-pogi">CVV</button></div><br>
    <div id="bode"><span id=".live" class="live"></span>
</div>
<div class="card">
	<button id="mostra2" class="btn btn-pogi">CCN</button></div><br>
    <div id="bode2"><span id=".live2" class="live2"></span>
</div>
<div class="card">
	<button id="mostra3" class="btn btn-pogi">DEAD</button>
<div id="bode3"><span id=".dead" class="dead"></span>
</div></div>
    </div>
  </div>
</div>
</div>
  </div>
</div>


</div>
<br>
</center>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
<script src="assets/vendors/js/process.js" type="text/javascript">
</script>

</body>

</html>
