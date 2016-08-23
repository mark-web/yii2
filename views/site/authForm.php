<form class="form" name="authForm" style="width: 300px" novalidate ng-submit="loginUser(auth,authForm.$valid,'authFormButton')">
    <fieldset>
        <legend>Авторизация</legend>
        <div class="control-group">
            <input type="email" class="input-block-level" value="" placeholder="E-mail"  title=""
                   required="required"
                   data-ng-model="auth.login" name="login">
            <div class="error" ng-show="authForm.login.$invalid
                                     && authForm.login.$error.email">
                {{getError(authForm.login.$error)}}
            </div>
        </div>

        <div class="control-group">
            <input type="password" required="required" autocomplete="off" value="" class="input-block-level"
                   placeholder="Пароль" title="" data-ng-model="auth.password" name="password"  minlength="5">
            <div class="error" ng-show="authForm.password.$invalid">
                {{getError(authForm.password.$error)}}
            </div>
        </div>

        <div class="form-actions button-group">
            <button id="authFormButton" class="btn btn-success" ng-disabled="authForm.$invalid" type="submit">Вход <span class="icon-ok icon-white"></button>
            <button data-ng-click="toRegistration()" class="btn btn-success" type="button">Регистрация <span
                    class="icon-pencil icon-white"></button>
        </div>
    </fieldset>
</form>