<?php
use Bank\App\App;
use Bank\App\Services\Accounts;
?>

        <div class="workArea">
            <div class="editCont deleteCont">
                <div>
                    <p class="edit_title">Are you sure to delete an account: #<?= $id ?></p>
                    <p class="edit_title">Account holder:  <?= $name." ".$surname ?></p>
                    <p class="edit_title">Balance:  <?= $balance ?></p>
                </div>
                <div class="buttons">
                        <form class="delete_form" action="<?=URL."acc/delete/$id"?>" method="post">
                            <input type="hidden" name="id" value="<?= $id ?>" style="display: none;">
                            <button type="submit" class="submitBtn btn btn-secondary btn-lg">YES</button>
                        </form>
                    <button type="button" class="submitBtn btn btn-secondary btn-lg"><a href="http://bank.meh:8080/acc/">NO</a></button>
                </div>        
            </div>
        </div>
    </body>
</html>