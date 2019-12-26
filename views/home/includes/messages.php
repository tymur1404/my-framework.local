<?php
$error = session('error');
$success = session('success');
if ( $success) { ?>
    <div id="success-message" class=" row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <p id="success-message-text"><?=$success?></p>
            </div>
        </div>
    </div>

<?php } else if ($error) { ?>
    <div id="error-message" class=" row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <p id="error-message-text"><?=$error?></p>
            </div>
        </div>
    </div>
<?php } ?>