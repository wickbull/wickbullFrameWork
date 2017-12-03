<div class="row">
    <div class="col-sm-12 top">
		
		<div class="row title">
	        <div class="col-md-12">
	            <p><h4>Авторизация</h4></p>
	        </div>
	    </div>

		<div class="row cont">
			<div class="col-sm-4">
				<form method="POST"">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label for="email">Логин</label>
						<input name="login" type="text" class="form-control" id="email" placeholder="Введите логин">
					</div>
					<hr>
					<div class="form-group">
						<label for="email">Пароль</label>
						<input name="password" type="password" class="form-control" id="email" placeholder="Введите пароль">
					</div>
					<hr>
					<div class="form-group">
						<label for="email">Я не робот</label>
						<div class="g-recaptcha" data-sitekey="<?php echo $sitekey; ?>"></div>
					</div>
					<hr>
					<button name="_login" value="_login" type="submit" class="button glow">Авторизация</button>
				</form>
			</div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4">Реклама:</div>
		</div>
		
		

    </div>
</div>