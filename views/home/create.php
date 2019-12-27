<div class="container">
<div class="col-md-6">
    <?php include_once ('includes/messages.php')?>
<form  class="form-horizontal form-label-left" novalidate="" method="POST" action="/home/store/">
    <input type="hidden" id="_csrf" name="_csrf" value="<?=getToken()?>">
    <div class="form-group">
        <label for="name">Имя</label>
        <input type="text"
               class="form-control"
               name="name"
               id="name"
               value="<?=$task['name']?>" >
    </div>
    <div class="form-group">
        <label for="email">Почта</label>
        <input type="email"
               class="form-control"
               name="email"
               id="email"
               value="<?=$task['email']?>"
               placeholder="name@example.com">
    </div>


    <div class="form-group">
        <label for="description">Описание</label>
        <textarea class="form-control"
                  id="description"
                  name="description"
                  rows="3"><?=$task['description']?></textarea>
    </div>

    <div class="form-group">
        <button type="submit">Создать</button>
    </div>
</form>

</div>
</div>