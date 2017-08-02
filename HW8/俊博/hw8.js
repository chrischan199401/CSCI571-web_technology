// Code goes here

/*function changeColor(ele){
	if(ele.childNodes[0].getAttribute("class") == "glyphicon glyphicon-star-empty"){
		ele.childNodes[0].setAttribute("class", "glyphicon glyphicon-star");
	}
	else{
		ele.childNodes[0].setAttribute("class", "glyphicon glyphicon-star-empty");
	}
	
}*/


//var myApp = angular.module('myApp', ['angularUtils.directives.dirPagination']);
var myApp = angular.module('myApp', []);


function MyController($scope, $http, $window) {
	//$scope.sideBarDisplay = true;
	//$scope.toggleSideBar=function(){
	//	$scope.sideBarDisplay = $scope.sideBarDisplay == true ? false : true;
	//}
	//$scope.legStars = new Object();
	//$scope.billStars = new Object();
	//$scope.comStars = new Object();
	//Get all required data
	$scope.kwFunc = function() {
		var kw = $scope.keyword;
		//--------------------users--------------------------
		$http({
			url: 'http://localhost:8888/hw8.php',
			method: "GET",
			params: {users : 1, keywords : kw}
		}).then(function successCallback(response) {

			$scope.userJson = response.data.data;
			//$scope.userJson = $scope.userJson;
			//$scope.legStars = new Object()s;
			alert(response.data);
			console.log(response.data.data);
			//$scope.userJson = [1,2,3];
			//alert(response.data.data.data);
			//alert("hehe");
		}, function errorCallback(response) {
			//$scope.userJson = "users data access fail";
			alert("users data access fail");
		});

		//--------------------pages---------------------------
		$http({
			url: 'http://localhost:8888/hw8.php',
			method: "GET",
			params: {pages : 1, keywords : kw}
		}).then(function successCallback(response) {

			$scope.pageJson = response.data.data;
			//$scope.userJson = $scope.userJson;
			//$scope.legStars = new Object()s;
			alert(response.data);
			console.log(response.data.data);
			//$scope.userJson = [1,2,3];
			//alert(response.data.data.data);
			//alert("hehe");
		}, function errorCallback(response) {
			//$scope.userJson = "users data access fail";
			alert("users data access fail");
		});
	}




}

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
    console.log('going to page ' + num);
  };
}

myApp.controller('MyController', ['$scope', '$http', '$window', MyController]);
myApp.controller('OtherController', OtherController);