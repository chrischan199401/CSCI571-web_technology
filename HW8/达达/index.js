src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"

var tempData;
var app = angular.module('myApp', []);
var text;
//change the input text
app.controller('textCtrl', function($scope) {
    text=scope.text;
    console.log(text);
});

//call the PHP script and get the JSON data
app.controller('usersCtrl', function($scope, $http) {
  $http({
    method : "GET",
    url : "http://localhost:8888/index.php",
    params:{keyword:text}
  }).then(function mySucces(response) {
      $scope.users = response.data.data;
      tempData=response.data.data;
      console.log(response.data.data);
    }, function myError(response) {
      $scope.data = response.statusText;
  });
});

// paginate to previous page 
app.controller('previousCtrl', function($scope) {
    tempData=
});

    
//paginate to next page
app.controller('previousCtrl', function($scope) {
    tempData=
});

