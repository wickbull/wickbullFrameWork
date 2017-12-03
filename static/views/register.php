<div class="row">
    <div class="col-sm-12 top">
		
		<div class="row title">
	        <div class="col-md-12">
	            <p><h4>Регистрация</h4></p>
	        </div>
	    </div>

		<div class="row cont">
			<div class="col-sm-4">
				<form method="POST">
					<div class="form-group">
						<!-- <label for="email">Почта</label> -->
						<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введите почту">
						<!-- <small id="emailHelp" class="form-text text-muted">Ваша почта полностью конфиденциальна</small> -->
					</div>
					<hr>
					<div class="form-group">
						<!-- <label for="email">Логин</label> -->
						<input name="login" type="text" class="form-control" placeholder="Введите логин">
					</div>
					<hr>
					<div class="form-group">
						<!-- <label for="email">Пароль</label> -->
						<input name="password" type="password" class="form-control" placeholder="Введите пароль">
					</div>
					<hr>
					<div class="form-group">
						<!-- <label for="email">Я не робот</label> -->
						<div class="g-recaptcha" data-sitekey="<?php echo $sitekey; ?>"></div>
					</div>
					<hr>
					<button name="_register" value="_register" type="submit" class="button glow">Регистрация</button>
				</form>
			</div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4">Реклама:</div>
		</div>
	
    </div>
    
</div>