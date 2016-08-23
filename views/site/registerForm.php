<form class="form" name="registerForm" style="width: 300px" novalidate ng-submit="registerUser(registration,registerForm.$valid,'registerFormButton')">
    <fieldset>
        <legend>Регистрация</legend>
		<div class="control-group">
            <input type="email" class="input-block-level" value="" name="login"
                   required="required" placeholder="E-mail" title="" data-ng-model="registration.login">
            <div class="error" ng-show="registerForm.login.$invalid
                                     && registerForm.login.$error.email">
                {{getError(registerForm.login.$error)}}
            </div>
        </div>

        <div class="control-group">
            <input type="password" required="required" autocomplete="off" value="" class="input-block-level" name="password1"
				   placeholder="Пароль (минимум 5 символов)" data-ng-model="registration.password1" minlength="5">
            <div class="error" ng-show="registerForm.password1.$invalid">
                {{getError(registerForm.password1.$error)}}
            </div>
        </div>

		 <div class="control-group">
            <input type="password" required="required" autocomplete="off" value="" class="input-block-level" name="password2"
				   placeholder="Подтвердите пароль" data-ng-model="registration.password2"
                   compare-to="registration.password1">
        </div>
        <div class="error" ng-show="registerForm.password2.$invalid && registerForm.password2.$error.compareTo && !registerForm.password2.$error.required">
            {{getError(registerForm.password2.$error)}}
        </div>
		<div class="form-actions button-group">
            <button data-ng-click="toLogin()" class="btn btn-success"  type="button"><span class="icon-arrow-left icon-white"></span>Назад</button>
            <button id="registerFormButton" class="btn btn-success"  ng-disabled="registerForm.$invalid"  type="submit">Сохранить <span class="icon-chevron-right icon-white"></span></button>
        </div>
    </fieldset>
</form>
