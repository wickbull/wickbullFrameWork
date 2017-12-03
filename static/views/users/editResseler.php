<div class="row">
    <div class="col-sm-12 top">
        
        <div class="row title">
            <div class="col-md-12">
                <p><h4>Пользователь: <b style="color: #DF4A26"><?php echo $client->login; ?></b></h4></p>
                <?php if( !empty( $resseler ) ) : ?><p><h4>Пользователь ресселера: <b style="color: #DF4A26"><?php echo $resseler; ?></b></h4></p> <?php endif; ?>
            </div>
        </div>

    </div>
    <div class="col-sm-12 top">
        
        <div class="row">
        	<div class="col-sm-6">

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
	        				<label for="">ID:</label>
	        			</div>
	    				<div class="col-sm-8">
	    					<input class="form-control" readonly="readonly" onclick="this.select();" value="<?php echo $client->id; ?>">
	    				</div>
        			</div>
        		</div>

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
	        				<label for="">Email:</label>
	        			</div>
	    				<div class="col-sm-8">
	    					<input class="form-control" readonly="readonly" onclick="this.select();" value="<?php echo $client->email; ?>">
	    				</div>
        			</div>
        		</div>

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
	        				<label for="">Login:</label>
	        			</div>
	    				<div class="col-sm-8">
	    					<input class="form-control" readonly="readonly" onclick="this.select();" value="<?php echo $client->login; ?>">
	    				</div>
        			</div>
        		</div>

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
	        				<label for="">Pass:</label>
	        			</div>
	    				<div class="col-sm-8">
	    					<input class="form-control" readonly="readonly" onclick="this.select();" value="<?php echo $client_password; ?>">
	    				</div>
        			</div>
        		</div>

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
	        				<label for="">Ballance-$:</label>
	        			</div>
	    				<div class="col-sm-8">
	    					<input class="form-control" readonly="readonly" onclick="this.select();" value="<?php echo $userbalance; ?>">
	    				</div>
        			</div>
        		</div>

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
	        				<label for="">Date:</label>
	        			</div>
	    				<div class="col-sm-8">
	    					<input class="form-control" readonly="readonly" onclick="this.select();" value="<?php echo $client->iso_date_time; ?>">
	    				</div>
        			</div>
        			
					
        		</div>

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
	        				<label for="">Ip:</label>
	        			</div>
	    				<div class="col-sm-8">
	    					<input class="form-control" readonly="readonly" onclick="this.select();" value="<?php echo $client->ip; ?>">
	    				</div>
        			</div>
        		</div>

        	</div>




        	<div class="col-sm-6">

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
	        				<label for="">Бан:</label>
	        			</div>
	    				<div class="col-sm-8">
	    					<input class="form-control" readonly="readonly" onclick="this.select();" value="<?php echo $status; ?>">
	    				</div>
        			</div>
        		</div>

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
	        				<label for="">Время:</label>
	        			</div>
	    				<div class="col-sm-8">
	    					<input class="form-control" readonly="readonly" onclick="this.select();" value="<?php echo $time; ?>">
	    				</div>
        			</div>
        		</div>
				<form method="POST">

					<div class="form-group">
	        			<div class="row">
	        				<div class="col-sm-2">
		        				<label for="">Пополнить:</label>
		        			</div>
		    				<div class="col-sm-8">
		    					<input type="text" name="addBalance" onclick="this.select();" class="form-control" value="3">
		    				</div>
	        			</div>
	        		</div>
				
	        		<div class="form-group">
	        			<div class="row">
	        				<div class="col-sm-2"></div>
		    				<div class="col-sm-8">
		    					<div class="form-check">
								    <label class="form-check-label">
								      	<input type="checkbox" name="ban" class="form-check-input" <?php echo $bannedCheck; ?>>
								      	Забанить/Разбанить
								    </label>
							  	</div>
		    				</div>
	        			</div>
	        		</div>

	        		<?php if( !empty( $admin ) and $admin == 2 ) : ?>
						
		        		<div class="form-group">
		        			<div class="row">
		        				<div class="col-sm-2"></div>
			    				<div class="col-sm-8">
			    					<div class="form-check">
									    <label class="form-check-label">
									      	<input type="checkbox" name="resseler" class="form-check-input" <?php echo $resselerCheck; ?>>
									      	Ресселер
									    </label>
								  	</div>
			    				</div>
		        			</div>
		        		</div>

		        		

		        		<div class="form-group">
		        			<div class="row">
		        				<div class="col-sm-2">
			        				<label for="">скидка%:</label>
			        			</div>
			    				<div class="col-sm-8">
			    					<input type="text" name="persent" onclick="this.select();" class="form-control" value="<?php echo $persent; ?>">
			    				</div>
		        			</div>
		        		</div>

						<?php if( $resselerCheck == 'checked' ) : ?>
			        		<div class="form-group">
			        			<div class="row">
			        				<div class="col-sm-2">
				        				<label for="">Минус$:</label>
				        			</div>
				    				<div class="col-sm-8"> 
				    					<input type="text" name="resselerMinus" onclick="this.select();" class="form-control" value="<?php echo $user_minus; ?>">
				    				</div>
			        			</div>
			        		</div>
		        		<?php endif; ?>
					
					<?php endif; ?>

	        		<div class="form-group">
	        			<div class="row">
	        				<div class="col-sm-2"></div>
		    				<div class="col-sm-8">
		    					<button name="_check" value="_check" type="submit" class="button glow button-highlight">Изменить</button>
		    				</div>
	        			</div>
	        		</div>
				</form>
        	</div>
        </div>
        
    </div>

    <div class="col-sm-12 top">
        
        <div class="row title">
            <div class="col-md-12">
                <p><h4>Купить пакет пользователю:</h4></p>
            </div>
        </div>

    </div>

    <div class="col-sm-12 top">
        
        <div class="row">
        	<div class="col-sm-6">

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
        					<label for="exampleFormControlSelect1">Сервер:</label>
        				</div>
        				<div class="col-sm-8">
						 	<select class="form-control" id="exampleFormControlSelect1">
					      		<option>server 1</option>
						      	<option>server 2</option>
						      	<option>server 3</option>
						      	<option>server 4</option>
						      	<option>server 5</option>
						    </select>
        				</div>
        			</div>
			  	</div>

			  	<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2">
        					<label for="exampleFormControlSelect1">Пакеты:</label>
        				</div>
        				<div class="col-sm-8">
						 	<select class="form-control" id="exampleFormControlSelect1">
					      		<option>НТВ+ VIP = 3$/месяц</option>
						      	<option>CYFRA+</option>
						    </select>
        				</div>
        			</div>
			  	</div>

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2"></div>
	    				<div class="col-sm-8">
	    					<div class="form-check">
							    <label class="form-check-label">
							      	<input type="checkbox" name="ban" class="form-check-input" <?php echo $bannedCheck; ?>>
							      	За счет клиента/За свой счет
							    </label>
						  	</div>
	    				</div>
        			</div>
        		</div>       		

        		<div class="form-group">
        			<div class="row">
        				<div class="col-sm-2"></div>
	    				<div class="col-sm-8">
	    					<button name="_check" value="_check" type="submit" class="button glow button-highlight">Изменить</button>
	    				</div>
        			</div>
        		</div>
        	
        	</div>
        </div>

    </div>

</div>