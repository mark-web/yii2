var app = angular.module('App', []);

app.directive("compareTo", function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=compareTo"
        },
        link: function (scope, element, attributes, ngModel) {

            ngModel.$validators.compareTo = function (modelValue) {
                return modelValue == scope.otherModelValue;
            };

            scope.$watch("otherModelValue", function () {
                ngModel.$validate();
            });
        }
    }
});

app.filter('with', function () {
    return function (items, field) {
        var result = {};
        angular.forEach(items, function (value, key) {
            if (!value.hasOwnProperty(field)) {
                result[key] = value;
            }
        });
        return result;
    };
});

app.controller('appCtrl', function ($scope, $sce, $http) {

    $scope.isAuthorised = false;
    $scope.requestData = {};
    $scope.lastRequestId = '';
    $scope.currentView = 'auth';
    /*$http({
        method: 'GET',
        url: '/site/get-user-data'
    }).then(function successCallback(response) {
        $scope.userInfo = response.data.data;
        $scope.isAuthorised = true;
        $scope.toSearch();
    }, function errorCallback(response) {
        $scope.toLogin();
        $scope.isAuthorised = false;
    });*/
/*
    $scope.loginUser = function (userDetails, isvalid, buttonId) {
        if (isvalid) {
            $scope.lockButton(buttonId);
            $http.post('/site/login', userDetails).success(function (data, status, headers, config) {
                alertify.success(data.description);
                $scope.userInfo = data.data;
                $scope.isAuthorised = true;
                $scope.toSearch();
                $scope.unlockButton(buttonId);
            }).error(function (data, status, headers, config) {
                $scope.isAuthorised = false;
                if (status == 404 || status == 500) {
                    alertify.error("Ошибка запроса на сервер!");
                } else {
                    alertify.error(data);
                }
                $scope.unlockButton(buttonId);
            })
        }
        else {
            alertify.error("Ошибка валидации формы. Заполните корректно поля!");
        }
    };

    $scope.registerUser = function (userDetails, isvalid, buttonId) {
        if (isvalid) {
            $scope.lockButton(buttonId);
            $http.post('site/registration', userDetails).then(
                function (data) {
                    alertify.success(data.data);
                    $scope.toLogin();
                    $scope.unlockButton(buttonId);
                }, function (data) {
                    errorCallback(data);
                    $scope.unlockButton(buttonId);
                }
            )
        } else {
            alertify.error("Ошибка валидации формы. Заполните корректно поля!");
        }
    };

    $scope.toRegistration = function () {
        this.setCurrentView('registration');
    };

    $scope.toLogin = function () {
        this.setCurrentView('auth');
    };

    $scope.setCurrentView = function (view) {
        $scope.currentView = view;
    };

    $scope.logout = function () {
        $http.post('/site/logout').success(function (data, status, headers, config) {
            $scope.toLogin();
            $scope.isAuthorised = false;
            $scope.userInfo = {};
        })
    };

    $scope.getError = function (error) {
        if (angular.isDefined(error)) {
            if (error.compareTo) {
                return "Введенные пароли не совпадают!";
            } else if (error.minlength) {
                return "Минимальная длина пароля 5 символов!";
            } else if (error.email) {
                return "Введите корректный e-mail!";
            }
        }
    };

    $scope.lockButton = function (buttonId) {
        angular.element('#' + buttonId).attr('disabled', 'disabled');
    };

    $scope.unlockButton = function (buttonId) {
        angular.element('#' + buttonId).removeAttr('disabled');
    };
    $scope.reverse = true;

    $scope.sort = function (fieldName) {
        if ($scope.sortFieldOnClick == fieldName) {
            $scope.reverse = !$scope.reverse;
        } else {
            $scope.sortFieldOnClick = fieldName;
            $scope.reverse = false;
        }
    };

    function errorCallback(info) {
        console.log(info);
        if (info.status == 404) {
            alertify.error("Ошибка запроса на сервер!");
        } else if (info.status == 401) {
           // $scope.toLogin();
            alertify.error(info.data);
        } else {
            alertify.error("Ошибка запроса на сервер! " + info.data);
        }
    }*/

});

