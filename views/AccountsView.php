<?php
use Bank\App\App;
use Bank\App\Services\Accounts;
use Bank\App\Services\Message;

$accounts = Accounts::getAllAccounts($sortBy ?? 'surname', $ascending ?? true);
$len = count($accounts);
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
            <div class="msgCont" data-remove-after="3" data-removable>
                <p class="<?=$type?> msg"><?=$msg?></p>
            </div>
            <div class="cont">
                <table class="table table-hover table-no-bg">
                    <thead>
                        <tr>
                            <th scope="col">ID 
                                <a href="http://bank.meh:8080/acc/sort/id">&#9661</a> 
                                <a href="http://bank.meh:8080/acc/sort/Id">&#9651</a> 
                            </th>
                            <th scope="col">Name
                                <a href="http://bank.meh:8080/acc/sort/name">&#9661</a> 
                                <a href="http://bank.meh:8080/acc/sort/Name">&#9651</a> 
                            </th>
                            <th scope="col">Surname
                                <a href="http://bank.meh:8080/acc/sort/surname">&#9661</a> 
                                <a href="http://bank.meh:8080/acc/sort/Surname">&#9651</a>     
                            </th>
                            <th scope="col">ID Code
                                <a href="http://bank.meh:8080/acc/sort/id_code">&#9661</a> 
                                <a href="http://bank.meh:8080/acc/sort/Id_code">&#9651</a> 
                            </th>
                            <th scope="col">Iban
                                <a href="http://bank.meh:8080/acc/sort/iban">&#9661</a> 
                                <a href="http://bank.meh:8080/acc/sort/Iban">&#9651</a> 
                            </th>
                            <th scope="col">Balance
                                <a href="http://bank.meh:8080/acc/sort/balance">&#9661</a> 
                                <a href="http://bank.meh:8080/acc/sort/Balance">&#9651</a> 
                            </th>
                            <th colspan="3" scope="col">Controls</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < $len; $i++): ?>
                        <tr class="listing">
                            <td><?= $accounts[$i] -> id      ?></td>
                            <td><?= $accounts[$i] -> name    ?></td>
                            <td><?= $accounts[$i] -> surname ?></td>
                            <td><?= $accounts[$i] -> id_code ?></td>
                            <td><?= $accounts[$i] -> iban    ?></td>
                            <td><?= $accounts[$i] -> balance ?> EUR</td>
                            <td class="controls"><a href="http://bank.meh:8080/acc/plus/<?=$accounts[$i] -> id?>">+</a></td>
                            <td class="controls"><a href="http://bank.meh:8080/acc/minus/<?=$accounts[$i] -> id?>">-</a></td>
                            <td class="controls"><a href="http://bank.meh:8080/acc/delete/<?=$accounts[$i] -> id?>">x</a></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>