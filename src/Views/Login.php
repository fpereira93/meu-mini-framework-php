<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="./public/bootstrap4.0/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/login.css" rel="stylesheet">

    <script src="./public/AngularJS/angular.min.js"></script>
    <script src="./public/js/login.js"></script>
</head>
<body ng-app="app" ng-controller="LoginController as ctrl">

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="./public/img/user-icon.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form action="javascript: void(0)">
                <input type="text" ng-model="ctrl.data.email" class="fadeIn second" name="email" placeholder="Email">

                <input type="password" ng-model="ctrl.data.password" class="fadeIn third" name="password" placeholder="password">

                <input type="button" ng-click="ctrl.tryLogin()" class="fadeIn fourth" value="Log In">
            </form>

            <label ng-show="ctrl.message" class="error">{{ctrl.message}}</label>

        </div>
    </div>

</body>
</html>