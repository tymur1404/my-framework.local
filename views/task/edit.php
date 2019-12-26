<div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Задача </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

        <?php include_once ('includes/messages.php')?>
        <?php include_once ('includes/messages_ajax.php')?>

        <?php if(!empty($params['id'])){?>
            <form class="form-horizontal form-label-left" novalidate="" method="POST" action="/task/update/<?=$params['id']?>">
        <?php }else{?>
            <form class="form-horizontal form-label-left" novalidate="" method="POST" action="/task/store/">
                <input type="hidden"  name="completed" value="0">
        <?php } ?>
                <input type="hidden" id="_csrf" name="_csrf" value="<?=getToken()?>">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Имя
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name"
                               class="form-control col-md-7 col-xs-12"
                               name="name"
                               required="required"
                               type="text"
                               value="<?=$params['name']?>">
                        <?php $name_error = session('name_error');
                        if ( $name_error) { ?>
                            <div class="invalid-feedback has-error-email" style="display: inline-block;"><?=$name_error?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Почта
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="email"
                               class="form-control col-md-7 col-xs-12"
                               name="email"
                               required="required"
                               type="email"
                               value="<?=$params['email']?>">
                        <?php $email_error = session('email_error');
                        if ( $email_error) { ?>
                            <div class="invalid-feedback has-error-email" style="display: inline-block;"><?=$email_error?></div>
                        <?php } ?>
                    </div>
                </div>
                <?php if(!is_null($params['completed'])) {?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Статус
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <input <?php
                        if($params['completed'])
                        {
                            echo 'checked value="1"';
                        }
                        else
                        {
                            echo 'value="0"';
                        }?>
                                type="checkbox"
                                class="form-check-input col-md-7 col-xs-12"
                                id="materialUnchecked-<?= $params['id'];?>">
                        <label
                                data-id='<?=$params['id']?>'
                                class="form-check-label"
                                for="materialUnchecked-<?= $params['id'];?>"></label>
                    </div>
                </div>
                <?php } ?>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Описание
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="textarea"
                                  required="required"
                                  name="description"
                                  rows="15"
                                  class="form-control col-md-12 col-xs-12"><?=$params['description']?></textarea>
                        <?php $description_error = session('description_error');
                        if ( $description_error) { ?>
                            <div class="invalid-feedback has-error-email" style="display: inline-block;"><?=$description_error?></div>
                        <?php } ?>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button class="btn btn-primary">Сохранить
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
