<?php
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
    $fb = new Facebook\Facebook([
      'app_id' => '160143257832704',
      'app_secret' => 'b94eb966e3f4e6b20f7381842ffa0f41',
      'default_graph_version' => 'v2.8',
    ]);

    $fb->setDefaultAccessToken('EAACRpkHZCDQABAIAPCSlZA7N16qhKTMkjAKD96BCKNNiBOVjxMKYsJ0Jl6fxI3cMwBSontcHmBfvH471ZCsGzgXsT4jNUsJjhcUdVboEz8vKEK6zpSLZAMTbzK4sLeaOrVqZAOu3FxBeQNB61iwraQcnRZCcRLFVYZD');

    $search_Str = $keywords = $tab_str = $location = $distance = $user_id = "";
    $type = "user";
    $keywords="usc";

    $search_str = 'search?q='.$keywords.'&type='.$type.'&fields= id,name,picture.width(700).height(700)';

    try {
      $response = $fb->get($search_str);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    $res=$response->getBody();
    echo $res;
?>