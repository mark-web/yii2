<br><button type="button" class="btn btn-success left_2" data-ng-click="saveUser(mainForm)">Сохранить</button>
<button type="button" class="btn btn-success left_2" data-ng-click="cancelEdit()">Отмена</button><br><br>
<form  name="mainForm">

    <table class="table user-table">
        <tr>
            <td class="col-md-1">Имя</td>
            <td>
                <div class="form-group col-lg-4">
                    <input type="text" class="form-control" ng-model = "new_user.name" placeholder="Name" ng-minlength="5" required>
                    <span class="error" ng-show="mainForm.$error.minlength">Name too short!</span>
                </div>
            </td>
        </tr>
        <tr>
            <td class="col-md-1">Фамилия</td>
            <td>
                <div class="form-group col-lg-4">
                    <input type="text" class="form-control" ng-model = "new_user.surname" placeholder="Surname" >
                </div>
            </td>
        </tr>
        <tr>
            <td class="col-md-1">Возраст</td>
            <td>
                <div class="form-group col-lg-4">
                    <input type="text" class="form-control" ng-model = "new_user.age" placeholder="Age"  required ng-pattern="/^[0-9]*$/">
                    <span class='error' ng-show='mainForm.$error.pattern'>Age is required and only numbers</span>
                </div>
            </td>
        </tr>
    </table>
</form>