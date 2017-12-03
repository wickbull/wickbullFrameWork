<div class="row">
     <div class="col-sm-12 top">
        
        <div class="row title">
            <div class="col-md-12">
                <div class="row">
                    <p><h4>Клиенты</h4></p>
                    <p style="margin-left: 15px;"><a href="/users/add" class="button glow button-primary">Добавить пользователя</a></p>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-12 top">
        
        <div class="row">
            <div class="col-sm-3"></div> 
            <div class="col-sm-6"> 
                <div class="row">
                    <div class="col-sm-8">
                        <form action="">
                        <div class="form-group">
                            <input type="search" class="form-control" placeholder="Поиск:..." name="" id="">
                        </div>
                    </div>
                    <div class="col-sm-4"><button class="button glow button-highlight">Поиск</button></div>
                    </form>
                </div>
            </div>
        </div>
        
        <table class="table">
            <thead class="table" style="font-size: 0.7em;">
                <tr class="orange">
                    <th><center>пользователь</center></th>
                    <th><center>email</center></th>
                    <th><center>ip</center></th>
                    <th><center>дата рег.</center></th>
                    <th><center>баланс</center></th>
                    <th><center>посл.покупка</center></th>
                    <th><center>бан</center></th>
                    <th><center>когда бан</center></th>
                    <th><center>пакеты</center></th>
                    <th><center>редактировать</center></th>
                </tr>
            </thead>
            <?php foreach ($client as $key => $cli) : ?>
                <tbody class="table-<?php if( $cli['banned'] == 1 ) : ?>danger<?php else : ?>secondary<?php endif; ?>" style="font-size: 0.8em;">
                    <?php if ( $cli['login'] != $_SESSION['user']['login'] ) : ?>
                        <tr>
                            <th><center><?php echo $cli['login']; ?></center></th>
                            <th><center><?php echo $cli['email']; ?></center></th>
                            <th><center><?php echo $cli['ip']; ?></center></th>
                            <th><center><?php echo $cli['date_time']; ?></center></th>
                            <th><center><?php echo $cli['balance']; ?>$</center></th>
                            <th><center><?php echo $cli['last_time_bye']; ?></center></th>
                            <th><center><?php echo $cli['ban']; ?></center></th>
                            <th><center><?php echo $cli['how_ban']; ?></center></th>
                            <th><center><?php if( $cli['id'] != NULL ) echo '<a href="" class="button glow button-highlight">' . $cli['packages'] . '</a>'; ?></center></th>
                            <th><center><?php if( $cli['id'] != NULL ) echo '<a href="/users/edit/' . $cli['id'] . '"  class="button glow button-highlight"><i class="fa fa-pencil" aria-hidden="true"></i></a>'; ?></center></th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</div>