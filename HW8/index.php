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
	$fb->setDefaultAccessToken('EAACZCupGCWd8BAIVBywZCgteM0mZA3pwdTWeDcF9xTtLsbufxYznTCOZAwYWDhn4HKX1PRsrYUolsVGwj5WJZARouxZCBcWff18ZBq8DwmyzxQkbKhvEjed431BC4e2pPPOAWbGVoO2VU8PfJy87lmYhRZCNZByuL4RcZD');

    if (isset($_GET["id"]) && isset($_GET["type"]) && $_GET["type"] =="event") {
      # code...
      $id = $_GET["id"];

      $search_str = "$id?fields=id,name,picture.width(700).height(700),posts.limit(5)";
    }elseif(isset($_GET["id"])) {
        $id = $_GET["id"];
        $search_str = "$id?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name,picture}},posts.limit(5)";

    }else{
        $type = isset($_GET["type"])? $_GET["type"]: "";
        $keyword = isset($_GET["keyword"])? $_GET["keyword"]:"";
        $search_str = "search?q=".rawurlencode($keyword)."&type=".$type."&fields=id,name,picture.width(700).height(700)";
    }

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

	echo $JSON;
?>