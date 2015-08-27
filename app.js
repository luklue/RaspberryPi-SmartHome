'use strict';

angular.module('PiApp', [])
  .controller('ArticlesCtrl', function($scope, $http, $interval){
    

var fun = function(){
$http.get('articles.php').then(function(articlesResponse) {
	$scope.articles = articlesResponse.data;
    });
 };
fun();
$interval(fun, 3000);


$scope.aus = function(LED) {
$http.get('/led/' + LED + '/aus').then(function() {
fun();
});
};


$scope.an = function(LED) {
$http.get('/led/' + LED + '/an').then(function() {
fun();
});
};


});
