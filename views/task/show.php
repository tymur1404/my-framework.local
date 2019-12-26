<div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Задача </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-sm-12">
                <div class="col-xs-12">
                    <h2><strong>Имя: </strong> <?=$params['name']?></h2>
                    <h2><strong>Почта: </strong> <?=$params['email']?></h2>
                    <h2><strong>Статус: </strong> <?php
                        if($params['completed']){
                            echo 'Выполнено';
                        }else{
                            echo 'Не выполнено';
                        }
                            ?></h2>
                        <?php

                        if($params['edited']){
                            echo '<h2><strong>Отредактировано: </strong>Отредактировано администратором</h2>';
                        }

                        ?>
                    <p><strong>Описание: </strong>
                        <?=$params['description']?> </p>
                </div>
            </div>
        </div>
    </div>
</div>
