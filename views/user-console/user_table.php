<br><button type="button" class="btn btn-success left_2" data-ng-click="addUser()">Добавить пользователя</button>
<span><label>Фильтр:</label><input type="text" ng-model="name" id="name" name="name" class="ng-pristine ng-valid ng-touched"/></span>
<br><br>
<table class="table user-table" ng-show="usersFilter.length>0">
    <tr  class="bold">
        <td>№</td>
        <td>Имя</td>
        <td>Фамилия</td>
        <td>Возраст</td>
        <td></td>
    </tr>
    <tr ng-repeat="user in usersFilter = ( user_list | filter:name ) | orderBy:sortField:reverse">
        <td>{{user_list.indexOf(user)+1}}</td>
        <td>{{user.name}}</td>
        <td>{{user.surname}}</td>
        <td>{{user.age}}</td>
        <td class="right">
            <button class="btn btn-danger" data-ng-click="remove_user($index)">Удалить</button>
            <button class="btn btn-success" data-ng-click="edit_user($index)">Редактировать</button>
        </td>
    </tr>
    <tr><td colspan="8">Общее кол-во: {{usersFilter.length}}</td></tr>
</table>