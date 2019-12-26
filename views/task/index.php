<?php
?>
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
            <?php include_once ('includes/messages_ajax.php')?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ИД</th>
                    <th class="name-col"><span>Имя </span>
                        <a class="filter" href="?order=asc"><i class="fa fa-angle-up fa-2x"></i></a>
                        <a class="filter" href="?order=desc"><i class="fa fa-angle-down fa-2x"></i></a>
                    </th>
                    <th>Почта</th>
                    <th  class="desc-col"">Описание</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($params['tasks'] as $key=>$task){?>
                    <tr>
                        <td><?= $task['id'];?></td>
                        <td>
                            <?= $task['name'];?>
                        </td>
                        <td><?= $task['email'];?></td>
                        <td><?= $task['description'];?></td>
                        <td class="center">
                                <input <?php
                                if($task['completed'])
                                {
                                    echo 'checked value="1"';
                                }
                                else
                                {
                                    echo 'value="0"';
                                }?>
                                        type="checkbox"
                                        class="form-check-input"
                                        name="completed"
                                        id="materialUnchecked-<?= $task['id'];?>">
                                <label
                                        data-id='<?=$task['id']?>'
                                        class="form-check-label"
                                        for="materialUnchecked-<?= $task['id'];?>"></label>
                            <?php
                            /**
                             * todo add changed admin
                             */

                            ?>
                        </td>
                        <td>
                            <a href="/task/show/<?=$task['id']?>">
                                <button class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </button></a>
                            <a href="/task/edit/<?=$task['id']?>">
                                <button class="btn btn-success">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </a>
                            <form method="POST" action="/task/delete/<?=$task['id']?>">
                                <input type="hidden"  name="_csrf" value="<?=getToken()?>"/>
                                <input type="hidden"  name="page" value="<?=getUrlParam(2)?: 1?>"/>
                                <button type="submit" class="btn btn-danger">
                                    <i  data-id="" class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <?=$params['pagination']?>
        </div>
    </div>
</div>
