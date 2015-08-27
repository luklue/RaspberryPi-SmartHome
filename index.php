<html ng-app="PiApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Lukas" >
    <title>Raspberry Pi</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="autoRefreshApp" class="container">
        <table id="myTable" class="table" ng-controller="ArticlesCtrl">
            <tr ng-repeat="article in articles">
                <td>
		            <center>		
		            <a href="" role="button" class="btn btn-success" ng-show="{{article.active}}" ng-click="aus(article.value)">
		            {{article.name}} ist an
		            </a>
		            <a href="" role="button" class="btn btn-danger" ng-hide="{{article.active}}" ng-click="an(article.value)">
		            {{article.name}} ist aus
		            </a>
		            </center>
                </td>
            </tr>
        </table>
    </div>
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="angular-1.4.3/angular.js"></script>
    <script src="app.js"></script>
</body>
</html>
