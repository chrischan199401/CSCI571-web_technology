<?php 
	header('Access-Control-Allow-Origin: *'); 
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();

    require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
	$fb = new Facebook\Facebook([
              'app_id' => '210808026061279',
              'app_secret' => '79a577cadd48e3edf497f08279677c5f',
              'default_graph_version' => 'v2.8',
            ]);
	$fb->setDefaultAccessToken('EAACZCupGCWd8BAJbTGbTaptfd5KnhSD715Ez0t5yfxSABA6vPOO3xLZAbvm1xUIV66q5xqZBhrMtILfVuCtNEg63F9CzZARcmiHzXWibKv0Sgbp7ZCzs26butA9dL05CKaUAxkkvQLR1cBkPaMm5bw0QnahjOgugZD');
  $typeArray = array("user", "page", "event", "place", "group");


  if(isset($_GET["id"]) && isset($_GET["type"]) && $_GET["type"] =="event"){

      $id = $_GET["id"];

      $search_str = "$id?fields=id,name,picture.width(700).height(700),posts.limit(5)";
  }elseif(isset($_GET["id"])){


  }else{
      $resJSON = array();

      for($i =0; $i<5; $i++){
        $type = $typeArray[$i];
        $keyword = $keyword = isset($_GET["keyword"])? $_GET["keyword"]:"";
        $search_str = "search?q=".rawurlencode($keyword)."&type=".$type."&fields=id,name,picture.width(700).height(700)";

      try {
          $response = $fb->get($search_str);
          $JSON = $response->getDecodedBody();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        array_push($resJSON[$type], $JSON);
      }

      echo json_encode($resJSON);

  }


?>