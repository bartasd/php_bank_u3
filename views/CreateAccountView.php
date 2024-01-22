<?php
use Bank\App\App;
use Bank\App\Services\Accounts;
use Bank\App\Services\AccountInfo;
use Bank\App\Services\Message;

$accounts = Accounts::getAllAccounts('surname');
$len = count($accounts);
$newIBAN = AccountInfo::getIBAN();

$msgOBJ = Message::get();
$msg = null;
$type = null;
if($msgOBJ){
  $msg = $msgOBJ[0];
  $type = $msgOBJ[1];
  Message::reset();
}
?>

        <div class="workArea">
            <div class="editCont deleteCont createCont">
                <div class="msgCont" data-remove-after="3" data-removable>
                    <p class="<?=$type?> msg msg-create"><?=$msg?></p>
                </div>
                <div>
                    <p class="edit_title">You're goint to create a new account: #<?= $len + 1 ?></p>
                    <p class="edit_title">Please fill out the form carefully!</p>
                </div>
                <div class="buttons">
                    <form class="delete_form" action="<?= URL ?>create" method="post">
                        <input type="hidden" name="id" value="<?= $len + 1?>" style="display: none;">
                        <label for="uname">First Name:</label>
                        <input type="text" placeholder="Enter First Name" name="name" required>
                        <label for="psw">Last Name:</label>
                        <input type="text" placeholder="Enter Last Name" name="surname" required>
                        <label for="psw">Identification Code:</label>
                        <input type="text" placeholder="Enter Your Identification Code" name="id_code" required>
                        <label for="psw">Account Number:</label>
                        <input type="text" name="iban" value="<?= $newIBAN ?>"required readonly>
                        <button class="submitBtn" type="submit">SUBMIT</button>
                    </form>
                </div>        
            </div>
        </div>
    </body>
</html>