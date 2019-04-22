<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
  function showUser(str) {
      if (str == "") {
          document.getElementById("results").innerHTML = "";
          return;
      } else {
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("results").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET","php/getuser.php?q="+str,true);
          xmlhttp.send();
      }
  }
  </script>
</head>
<body>

  <div class="col-lg-6">
  <h3><b>Search Members</b></h3>
  <label for="search">Enter Name, ID or Category</label>
  <form>
    <input type="text" name="search" onkeyup="showUser(this.value)">
  </form>
  <br>
  <div id="results"></div>
  </div>

  <?php include("header.php"); ?>
  <div class="container">
  	<div class="row">
  		<div class="col s8 offset-s2 center-align">
  			<h1>Members</h1>
  			<?php include("php/user-table.php"); ?>
  		</div>
  	</div>
  </div>
  <?php include("footer.php"); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> //load jQuery</script>
<script src="js/search.js"></script>


</body>
</html>
