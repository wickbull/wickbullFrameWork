 <div class="row">
         
    <div class="col-sm-12 top">
        <div class="row">

            <div class="col-sm-4 top right">
                <form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="ik_co_id" value="<?php echo $ik_co_id; ?>">
                    <input type="hidden" name="ik_pm_no" value="<?php echo $_SESSION['user']['id'] ?>">
                    <input type="hidden" name="ik_x_login" value="<?php echo $_SESSION['user']['login'] ?>">
                    <input type="hidden" name="ik_cur" value="UAH">
                    <input type="hidden" name="ik_desc" value="Event Description">
                    <input type="hidden" name="ik_sign" value="<?php echo $ik_sign; ?>">
                    
                    <div class="form-group">
                        <!-- <label for="email">Почта</label> -->
                            
                            <div class="row title">
                                <div class="col-md-12">
                                    <center><p><h4>Пополнить баланс</h4></p></center>
                                </div>
                            </div>
                        
                            <div class="col-sm-12">
                                <figure style="text-align: center;display: block;">
                                    <p><h4>Интеркасса:</h4></p>
                                </figure>
                            </div>
                            <div class="col-sm-12">
                                    <figure style="text-align: center; display: block;">
                                        <img src="/static/images/pay2.png" width="100%" alt="фото отсутсвует!">
                                    </figure>
                            </div>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" name="ik_am" value="3">
                            </div>
                            <div class="col-sm-4" style="padding-top: 15px;">
                                <input type="submit" class="button glow button-highlight" value="Пополнить">
                            </div>
                        
                        <!-- <small id="emailHelp" class="form-text text-muted">Ваша почта полностью конфиденциальна</small> -->
                    </div>
                </form>
            </div>

            <div class="col-sm-8 bot right">
                
                    <div class="form-group">
                        <!-- <label for="email">Почта</label> -->

                        <div class="row title">
                            <div class="col-md-12">
                                <center><p><h4>Транзакции:</h4></p></center>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-sm-12" style="padding-top: 15px;">
                                <table class="table">
                                    <thead class="table-active">
                                        <tr>
                                            <th>№</th>
                                            <th><center>Сумма</center></th>
                                            <th><center>Время</center></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-success">
                                        <?php $i=0; ?>
                                        <?php foreach ($transactions as $key => $transaction) : ?>
                                            <tr>
                                                <th><?php echo ++$i; ?></th>
                                                <th><center><?php echo $transaction->balance; ?> $</center></th>
                                                <th><center><?php echo $transaction->iso_date_time; ?></center></th>
                                            </tr>
                                        <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <small id="emailHelp" class="form-text text-muted">Ваша почта полностью конфиденциальна</small> -->
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>