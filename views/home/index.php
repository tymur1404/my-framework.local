<div class="container">
<form  action="/task/create" method="POST" >
    <input type="hidden" id="_csrf" name="_csrf" value="<?=getToken()?>"/>
    <input type='submit'  class='btn btn-round btn-success' value='Создать'/>
</form>
<div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Таблица задач </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php include_once ('includes/messages.php')?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="name-col"><span>Имя </span>
                        <a class="filter" href="?order=asc"><i class="fa fa-angle-up fa-2x"></i></a>
                        <a class="filter" href="?order=desc"><i class="fa fa-angle-down fa-2x"></i></a>
                    </th>
                    <th>Почта</th>
                    <th  class="desc-col"">Описание</th>
                    <th>Статус</th>
                    <th>Изменено</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($params['tasks'] as $key=>$task){?>
                    <tr>
                        <td>
                            <?= $task['name'];?>
                        </td>
                        <td><?= $task['email'];?></td>
                        <td><?= $task['description'];?></td>
                        <td class="center">
                                <?php
                                if($task['completed']){?>
                                    <p>Выполнено</p>
                                <?php } ?>
                        </td>
                        <td>
                            <p><?=$task['edited']?></p>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <?=$params['pagination']?>
        </div>
    </div>
</div>
</div>