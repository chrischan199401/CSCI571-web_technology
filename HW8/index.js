
var app = angular.module("myFB",[]);

var typeArray =["user", "page","event", "place","group","favorite"];


function UsersController($scope, $http, $window){
	$scope.typeIndex = 0;
	$scope.detailType =0;
	$scope.prev =[], $scope.next = [];
	$scope.data =[];
	$scope.barFlag = false;

	$scope.searchHelper = function(index){
		$http({
			method : "GET",
			url : "http://chen147-csci571-env.us-west-2.elasticbeanstalk.com/index.php",
			params: {type: typeArray[index], keyword : $scope.keyword}
		}).then(function successCallback(response){
			$scope.data[index] = response.data.data;
			$scope.prev[index] = response.data.paging.previous;
			$scope.next[index] = response.data.paging.next;
			console.log("get "+typeArray[index]);
		},function myError(response){
			console.log("get fail "+typeArray[index]);	
		});
	}

	$scope.search = function(){
		if($scope.keyword == null || $scope.keyword.length ==0){
			alert("No Keyword Input");
			return;
		}
		
		$("#myCarousel").carousel(0);
		$scope.barFlag = true;
		$("#progressbar").show();
		$("#table").hide();

		for (var i = 0; i <5; i++) {
			$scope.searchHelper(i);
		}

		setTimeout(hideBar, 500);
	}
	function hideBar(){
		$("#progressbar").hide();
		$scope.barFlag = false;
		$("#table").show();
	}

	$scope.clear = function(){
		$scope.typeIndex = 0;
		$scope.prev =[], $scope.next = [];
		$scope.data =[];
		$scope.keyword ="";

		$("#progressbar").hide();
		$("#table").hide();
		$("#myCarousel").carousel(0);
	}


	$scope.PagingPrev = function(){
		$http({
			method : "GET",
			url : $scope.prev[$scope.typeIndex],
		}).then(function successCallback(response){
			$scope.data[$scope.typeIndex] = response.data.data;
			console.log("type. "+ typeArray[$scope.typeIndex]);
			$scope.prev[$scope.typeIndex] = response.data.paging.previous;
			$scope.next[$scope.typeIndex] = response.data.paging.next;
			console.log("get Users");	
		},function myError(response){
			alert("get users fail");
			console.log("No");	
		});
	}

	$scope.PagingNext = function(){
		$http({
			method : "GET",
			url : $scope.next[$scope.typeIndex],
		}).then(function successCallback(response){
			$scope.data[$scope.typeIndex] = response.data.data;
			console.log("next "+ response.data.paging.previous);

			$scope.prev[$scope.typeIndex] = response.data.paging.previous;
			$scope.next[$scope.typeIndex] = response.data.paging.next;
			console.log("get Users");	
		},function myError(response){
			alert("get users fail");
			console.log("No");	
		});
	}

	$scope.checkPaging1 = function(){
		return $scope.prev[$scope.typeIndex] != null;
	}

	$scope.checkPaging2 = function(){
		return $scope.next[$scope.typeIndex] != null;
	}

	$scope.changeTypeIndex = function(index){
		$scope.typeIndex = index;
		console.log("change type to"+ typeArray[index]);

	}

	$scope.getTypeName = function(index){
		return typeArray[parseInt(index)];
	}

	$scope.QueryDetail = function(ID, ty){
		$(".detailBar").show();
		$("#posts").hide();
		$("#albums").hide();
		$scope.detailType = parseInt(ty);
		$http({
			method : "GET",
			url : "http://chen147-csci571-env.us-west-2.elasticbeanstalk.com/index.php",
			params: {id: ID, type: typeArray[parseInt(ty)]}
		}).then(function successCallback(response){
			$scope.id = response.data.id;
			$scope.name = response.data.name;
			$scope.picture = response.data.picture.data.url;
			$scope.albums = response.data.albums;
			$scope.posts = response.data.posts;
			console.log("get details"+ $scope.name);
		},function myError(response){
			console.log("get fail "+ $scope.name);	
		});
		setTimeout(hideDetailBar, 1000);
	}

	$scope.QueryDetail_Event = function(ID, ty){
		$(".detailBar").show();
		$("#posts").hide();
		$("#albums").hide();
		console.log(ID);
		$scope.detailType = parseInt(ty);
		$http({
			method : "GET",
			url : "http://chen147-csci571-env.us-west-2.elasticbeanstalk.com/index.php",
			params: {id: ID, type: "event"}
		}).then(function successCallback(response){
			$scope.id = response.data.id;
			$scope.name = response.data.name;
			$scope.picture = response.data.picture == null? "": response.data.picture.data.url;
			$scope.albums = response.data.albums;
			$scope.posts = response.data.posts;
			console.log("get details"+ $scope.name);
		},function myError(response){
			console.log("get fail "+ $scope.name);	
		});
		setTimeout(hideDetailBar, 1000);
	}

	function hideDetailBar(){
		$(".detailBar").hide();
		$("#posts").show();
		$("#albums").show();
		$("#0").show();
	}

	$scope.clickAlbums = function(id){
		var bool = $("#"+id).is(":visible");

		for (var i = 0; i < 5; i++) {
			if($("#"+i) == null)
				break;
			$("#"+i).hide();
		}
		if(!bool)
			$("#"+id).show();
	}

	$scope.dateForm = function(date){
		res = date.replace("T"," ");
		res = res.replace("+0000","");
		return res;

	}

	$scope.clickFav1 = function(id){
		// $window.localStorage.clear();
		if($window.sessionStorage.getItem(id) == null){
			var json = {"id":id, "pic": $scope.picture, "name": $scope.name,
			 "type":$scope.detailType};

			$window.sessionStorage.setItem(id,JSON.stringify(json));
			// $("#detailFav").html("<span class='glyphicon glyphicon-star' aria-hidden='true' style='color:yellow;'></span>");
		}else{
			$window.sessionStorage.removeItem(id);
			// $("#detailFav").html("<span class='glyphicon glyphicon-star-empty' aria-hidden='true'></span>");
		}
	}

	$scope.clickFav2 = function(id, pic, na, buttonId ){

		if($window.sessionStorage.getItem(id) == null){

			var json = {"id":id, "pic": pic, "name": na, 
			"type":$scope.typeIndex, "buttonId":buttonId};

			$window.sessionStorage.setItem(id,  JSON.stringify(json));
			// $("#"+buttonId).html("<span class='glyphicon glyphicon-star' aria-hidden='true' style='color:yellow;'></span>");

		}else{
			$window.sessionStorage.removeItem(id);
			// $("#"+buttonId).html("<span class='glyphicon glyphicon-star-empty' aria-hidden='true'></span>");
		}
	}

	$scope.checkFav = function(id){
		return $window.sessionStorage.getItem(id) == null? false: true;
	}

	$scope.iterateFav = function(){
		$scope.favs = [];
		var i = 0;
		for (x in $window.sessionStorage){
			console.log($window.sessionStorage.getItem(x));
			var json = JSON.parse($window.sessionStorage.getItem(x));
			var object ={};
			object.id = json['id'];
			object.pic = json['pic'];
			object.name = json['name'];
			object.type = json['type'];
    		$scope.favs[i++] =object;
    	}
	}

	$scope.removeFav = function(id){
		$window.sessionStorage.removeItem(id);
	}


	$scope.postFB = function(){
		FB.ui({
			app_id: "210808026061279",
			method: 'feed',
			link: 'https://developers.facebook.com/docs/',
			picture: $scope.picture,
			name: $scope.name,
			caption: "FB SEARCH FROM USC CSCI571"
		}, function(response){
		if (response && !response.error_message)
			alert("Posted Successfully");
		else
			alert("No Posted");
		});
	}
}


app.controller('usersContr', UsersController);

