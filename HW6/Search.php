<html>
<head>
	<title>Facebook Search</title>
	<?php $keyword ="";
		  $type ="users";
		  $location = "";
		  $distance = "";
	?>
	<script type="text/javascript">
		function init() {
			// body...
			var s = document.getElementById("type");
			if(s.value =="place"){
				addLocation("place");
			}
		}

		function addLocation(value){
			var f = document.getElementsByClassName("locationHidden");
			if(value =="place"){
				for (var i = 0; i < f.length; i++) 
					f[i].removeAttribute('hidden');
				
			}else{
				for (var i = 0; i < f.length; i++) {
					f[i].setAttribute('hidden', true);
				}
			}

		}

		function submitCheck(evt) {
			var flag = false;
			var str = "";
			
			if(document.getElementById("keyword").value ==""){
				str += "keyword could not be Empty\n";
				flag = true;
			}

			if(document.getElementById("type").value == "place"){
				if(document.getElementById("location").value==""){
					str += "location could not be Empty\n";
					flag = true;
				}
				if(document.getElementById("distance").value==""){
					str += "distance could not be Empty\n";
					flag = true;
				}
			}

			if(flag){
				alert(str);
				evt.preventDefault();
			}

		}

		function clearForm(){
			document.getElementById("keyword").value ="";
			document.getElementById("type").value = "user";
			document.getElementById("")
			addLocation("user");

			if (document.getElementById("d1") != null)
				document.getElementById("d1").innerHTML ="";

		}

	</script>

	<style type="text/css">

		h1{
			font-style:italic;
			font-weight: 400;
			font-family: "Times New Roman", Times, serif;
			text-align: center; 
			margin:8px;
		}
		#block{
			margin-left: auto;
			margin-right: auto;
			border-style: solid;
  			border-color: rgb(150, 150, 150);
			width: 700px;
			height: 170px;
			background-color: rgb(213,213,213);
		}
		#divlocation{
			height: 30px;
		}

		table{
			margin-left: auto;
			margin-right: auto;
			border:2px solid rgb(150, 150, 150);
			border-collapse: collapse;
		}
		th, td{
			border:1px solid rgb(150, 150, 150);
			border-collapse: collapse;
		}
		thead{
			text-align: left;
			background-color: rgb(213,213,213);
		}
		tbody{
			background-color: rgb(240, 240, 240);
		}

		.textblock{
			height: 30px;
			width: 820px;
			margin-left: auto;
			margin-right: auto;
			border:2px solid rgb(150, 150, 150);
			text-align: center;
			font-size: 17px;

			background-color: rgb(213,213,213);
		}


	</style>


</head>
<body onload="init()">

<div id="block" name ="block">
	<h1>Facebook Search</h1>
	<hr style="border: 1px solid;" />

	<form method="POST" id="Form" name="form" action ="Search.php">
			
			<label>Keyword</label>
			<input type="text" name="keyword" id = "keyword" value="<?php if(isset($_POST[keyword])) echo $_POST[keyword];
				if(isset($_GET[keyword])) echo $_GET[keyword]; ?>"><br>


			
			<label>Type&nbsp&nbsp&nbsp&nbsp&nbsp</label>
			<select name="type" id ="type" onchange="addLocation(this.options[this.selectedIndex].value)">
				<option value="user" <?php if(isset($_POST["type"])&& $_POST["type"] =="user") echo "selected";
				if(isset($_GET["type"])&& $_GET["type"] =="user") echo "selected";?>>Users</option>

				<option value="page"<?php if(isset($_POST["type"])&& $_POST["type"] =="page") echo "selected";
				if(isset($_GET["type"])&& $_GET["type"] =="page") echo "selected";?>>Pages</option>

				<option value="event" <?php if(isset($_POST["type"])&& $_POST["type"] =="event") echo "selected";
				if(isset($_GET["type"])&& $_GET["type"] =="event") echo "selected";?>>Events</option>

				<option value="place" <?php if(isset($_POST["type"])&& $_POST["type"] =="place") echo "selected";
				if(isset($_GET["type"])&& $_GET["type"] =="place") echo "selected";?>>Places</option>

				<option value="group"<?php if(isset($_POST["type"])&& $_POST["type"] =="group") echo "selected";
				if(isset($_GET["type"])&& $_GET["type"] =="group") echo "selected";?>>Groups</option>
			</select><br>



			<input type="hidden" name="fields" value="id,name,picture.width(700).height(700)" />
			<input type="hidden" name="access_token" value="EAACZCupGCWd8BAJbTGbTaptfd5KnhSD715Ez0t5yfxSABA6vPOO3xLZAbvm1xUIV66q5xqZBhrMtILfVuCtNEg63F9CzZARcmiHzXWibKv0Sgbp7ZCzs26butA9dL05CKaUAxkkvQLR1cBkPaMm5bw0QnahjOgugZD">

			<div id='divlocation'>
			<label class='locationHidden' hidden>Location</label>
			<input class='locationHidden' type=text id=location name=location value="<?php if(isset($_POST[location])) echo $_POST[location];if(isset($_GET[location])) echo $_GET[location];?>" hidden>

			<label class='locationHidden' hidden>Distance(meters)</label>

			<input class='locationHidden' type=text id=distance name=distance value="<?php if(isset($_POST[distance])) echo $_POST[distance];if(isset($_GET[distance])) echo $_GET[distance];?>" hidden>
			</div>



			<button type="submit" name="submit" onclick="submitCheck(event)" style="margin-left: 68px">Submit</button>
			<button type="button" name="reset" onclick="clearForm()">Clear</button>
	</form>

</div>

<h1 id ="test"></h1>

<?php 
	
	require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
	$fb = new Facebook\Facebook([
              'app_id' => '210808026061279',
              'app_secret' => '79a577cadd48e3edf497f08279677c5f',
              'default_graph_version' => 'v2.8',
            ]);
	$fb->setDefaultAccessToken('EAACZCupGCWd8BAJbTGbTaptfd5KnhSD715Ez0t5yfxSABA6vPOO3xLZAbvm1xUIV66q5xqZBhrMtILfVuCtNEg63F9CzZARcmiHzXWibKv0Sgbp7ZCzs26butA9dL05CKaUAxkkvQLR1cBkPaMm5bw0QnahjOgugZD');


	define('facebooKey', 'EAACZCupGCWd8BAJbTGbTaptfd5KnhSD715Ez0t5yfxSABA6vPOO3xLZAbvm1xUIV66q5xqZBhrMtILfVuCtNEg63F9CzZARcmiHzXWibKv0Sgbp7ZCzs26butA9dL05CKaUAxkkvQLR1cBkPaMm5bw0QnahjOgugZD');
	define('googleKey', "AIzaSyCQxV6-81P7qpbNLOPt5pVrvW-zl5yVxak");

	if(isset($_GET["id"])){
		$id = $_GET["id"];

		$search_str = "$id?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name,picture}},posts.limit(5)";

		try {
                  $response = $fb->get($search_str);
                  $JSON = $response->getBody();
                } catch(Facebook\Exceptions\FacebookResponseException $e) {
                  // When Graph returns an error
                  echo 'Graph returned an error: ' . $e->getMessage();
                  exit;
                } catch(Facebook\Exceptions\FacebookSDKException $e) {
                  // When validation fails or other local issues
                  echo 'Facebook SDK returned an error: ' . $e->getMessage();
                  exit;
        }

       	$objArray = json_decode($JSON, true);
		$albums = $objArray['albumss'];
		$posts = $objArray['posts'];

		echo "<div id=d1>";

		if($albums == NULL){
			echo "<div class=textblock>No Album has been found</div>";
		}else{

			echo "<div class=textblock><a href= javascript:clickAlbums()>Albums</a></div><br>";

			echo "<table id=t1 width= 820px>";

			$i =0;

			foreach($albums['data'] as $arr){
				if(count($arr['photos']['data']) != 0 )
					echo "<tr  class=album hidden><td><a href=javascript:clickTitle(".$i.") >$arr[name]</a></td></tr>";
				else
					echo "<tr  class=album hidden><td>$arr[name]</td></tr>";
				echo "<tr id=album_pic".$i." hidden><td>";

				foreach ($arr['photos']['data'] as $value) {
					# code...
					echo "<a href =https://graph.facebook.com/v2.8/".$value['id']."/picture?access_token=".facebooKey." target=_blank>";
					echo "<image src=$value[picture] width=80px height=80px></a>";

				}
				echo "</td></tr>";
				$i++;
			}
			echo "</table>";
		}

		echo "<br>";

		if($posts == NULL){
			echo "<div class=textblock>No Post has been found</div>";
		}else{

			echo "<div class=textblock><a href=javascript:clickPosts()>Posts</a></div><br>";

			echo "<table id=t2 width=820px>";
			echo "<tr class=post hidden><th>Message</th></tr>";
			$i =0;
			foreach ($posts['data'] as $arr) {
				# code...
				echo "<tr class=post hidden><td>".$arr['message']."</td></tr>";

			}

			echo "</table>";
		}
		echo "</div>";

	?>

	<script type="text/javascript">
		function clickAlbums(){

			var albumsArray = document.getElementsByClassName('album');
			for(i =0;i<albumsArray.length;i++){
				if(albumsArray[i].hasAttribute('hidden'))
					albumsArray[i].removeAttribute('hidden');
				else{
					albumsArray[i].setAttribute('hidden', true);

					var pic = document.getElementById("album_pic"+ i);
					pic.setAttribute('hidden',true);

				}
			}


			//close post
			var postArray = document.getElementsByClassName("post");
			for (var i = 0; i < postArray.length; i++) {
					postArray[i].setAttribute('hidden', true);
			}

		}
		function clickTitle(index){

			var pic = document.getElementById("album_pic"+ index);
			if(pic.hasAttribute('hidden')){
				pic.removeAttribute('hidden');
			}else{
				pic.setAttribute('hidden', true);
			}

		}

		function clickPosts(){

			var postArray = document.getElementsByClassName("post");
			for (var i = 0; i < postArray.length; i++) {
				if(postArray[i].hasAttribute('hidden'))
					postArray[i].removeAttribute('hidden');
				else
					postArray[i].setAttribute('hidden', true);
			}


			//close album
			var albumsArray = document.getElementsByClassName('album');
			for(i =0;i<albumsArray.length;i++){
				
				albumsArray[i].setAttribute('hidden', true);
				var pic = document.getElementById("album_pic"+ i);
				if(pic != null)
					pic.setAttribute('hidden',true);
			}

		}
	</script>

<?php 	

	}else if(isset($_POST["submit"])){

		// echo "keyword   ". $_POST["keyword"]."<br/>";
		// echo "type     ". $_POST["type"]."<br/>";
		// echo "fields.  ". $_POST["fields"]."<br/>";
		// echo "access_token  ". $_POST["access_token"]."<br/>";

		$keyword = $_POST["keyword"];
		$type = $_POST["type"];
		$location = isset($_POST["location"]) ? $_POST["location"]: "";
		$distance = isset($_POST["distance"]) ? $_POST["distance"]: "";

		if($type == "event"){
			$search_str = "search?q=".rawurlencode($keyword)."&type=".$type."&fields=id,name,picture.width(700).height(700),place";

  			try {
                  $response = $fb->get($search_str);
                  $objArray = $response->getGraphEdge();
                } catch(Facebook\Exceptions\FacebookResponseException $e) {
                  // When Graph returns an error
                  echo 'Graph returned an error: ' . $e->getMessage();
                  exit;
                } catch(Facebook\Exceptions\FacebookSDKException $e) {
                  // When validation fails or other local issues
                  echo 'Facebook SDK returned an error: ' . $e->getMessage();
                  exit;
                }


			// $data = file_get_contents("https://graph.facebook.com/v2.8/search?q=". rawurlencode($keyword).
			// 	"&type=".$type."&fields=id,name,picture.width(700).height(700),place&access_token=".facebook_token);
			// $objArray = json_decode($data);

			$html = "<div id=d1>";
			if(count($objArray) == 0){
				$html .= "<div class=textblock>No Record has been found</div>";
			}else{
				//create table
				$html .= "<table>  <col width=220px><col width=450px><col width150px>
  						<thead><tr><th>Profile Photo</th> <th>Name</th><th>Place</th></tr></thead><tbody>";
					foreach ($objArray as $value) {
						$html.= '<tr><td><a href ="'. $value->getProperty('picture')->getProperty('url'). '" target=_blank><image src="'. $value->getProperty('picture')->getProperty('url').'" style="with:30px; height:40px;"/></a></td>';
						$html .= '<td>'. $value->getProperty('name').'</td>';
						
						if($value->getProperty('place') != null)
							$html .= '<td>'.$value->getProperty('place')->getProperty('name')."</td></tr>";
						else
							$html .= "<td></td></tr>";
						
					}
				$html .="</tbody></table>";
			}
			$html .="</div>";
			echo $html;
			return;
		}


		if($type != "place"){
			//request Facebook API
			// $data = file_get_contents("https://graph.facebook.com/v2.8/search?q=".rawurlencode($keyword).
			// 	"&type=".$type."&fields=id,name,picture.width(700).height(700)&access_token=".facebook_token);
			$search_str = "search?q=".rawurlencode($keyword)."&type=".$type."&fields=id,name,picture.width(700).height(700)";
		}else{// type == place
			//request google maps API
			$google = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$location."&key=".googleKey);

			$googleArray = json_decode($google, true);

			$lat =$googleArray['results'][0]['geometry']['location']['lat'];
			$lng =$googleArray['results'][0]['geometry']['location']['lng'];

			$search_str = "search?q=".rawurlencode($keyword)."&type=".$type."&center=".$lat.','.$lng."&distance=".$distance."&fields=id,name,picture.width(700).height(700)";
			// $data = file_get_contents("https://graph.facebook.com/v2.8/search?q=".rawurlencode($keyword).
			// 	"&type=".$type."&center=".$lat.','.$lng."&distance=".$distance."&fields=id,name,picture.width(700).height(700)&access_token=".facebook_token);
		}

		try {
              $response = $fb->get($search_str);
              $objArray = $response->getGraphEdge();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
        }

		$html = "<div id=d1>";
		if(count($objArray) == 0){
			$html .= "<div class =textblock>No Record has been found</div>";
		}else{
			//create table
			$html .= "<table><col width=220px><col width=450px><col width=150px>
			<thead><tr><th>Profile Photo</th> <th>Name</th><th>Details</th></tr></thead><tbody>";
				foreach ($objArray as $value) {
					$html.= '<tr><td><a href ="'. $value->getProperty('picture')->getProperty('url'). '" target=_blank><image src="'.$value->getProperty('picture')->getProperty('url') .'" style="with:30px; height:40px;"/></a></td>';
					$html .= '<td>'. $value->getProperty('name').'</td>';
					
					$html .= '<td><a href=Search.php?id='.$value->getProperty('id')."&keyword=$keyword&type=$type&location=$location&distance=$distance>Details</a></td></tr>";
					
				}
			$html .="</tbody></table>";
		}
		$html .="</div>";
		echo $html;
	}

?>
</body>
</html>