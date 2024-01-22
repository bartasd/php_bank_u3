<?php
namespace Bank\App\Services;
use Bank\App\DB\FileBase;
use Bank\App\App;

class Accounts{

    private function __construct(){
        // never gets constructed
    }

    public static function getAllAccounts($sort = 'surname', $asc = true){
        $accs = (new FileBase('acc'))->showAll();
        if($asc){
            usort($accs, fn($a,$b) => $a->$sort <=> $b->$sort );
        }
        else{
            usort($accs, fn($a,$b) => $b->$sort <=> $a->$sort );
        }
        
        $notDeletedAccs = array_filter($accs, fn($el) => !isset($el->deleted));
        $notDeletedAccs = array_values($notDeletedAccs);
        return $notDeletedAccs;
    }

    public static function getAccount($id){
        $count = count((new FileBase('acc'))->showAll());
        if($id > $count || $id <= 0){
            return false;
        }
        $acc = (new FileBase('acc'))->show($id);
        if(isset($acc->deleted)){
            return false;
        }
        return $acc;
    }

    public static function updateAccount($action, $id, $ammount){
        $writer = (new FileBase('acc'));
        $acc = $writer->show($id);
        $balance = $acc->balance;
        
        if($ammount <= 0){
            Message::set("You cannot add or take away negative ammounts." , 'error');
            return false;
        }
        if($action == 'minus' && $ammount > $balance){
            Message::set("You cannot take more than there is. Please check your numbers!" , 'error');
            return false;
        }       
        if($action == 'plus'){
            $acc->balance += $ammount;
        }
        else{
            $acc->balance -= $ammount;
        }
        $writer->update($id, $acc);
        return true;
    }

    public static function destroyAccount($id){
        $writer = (new FileBase('acc'));
        $acc = $writer->show($id);
        if($acc->balance > 0){
            return false;
        }
        else{
            $acc->deleted = true;
            $writer->update($id, $acc);
            return true;
        }
    }

    public static function createAccount($request){
        $id = $request['id'];
        $writer = (new FileBase('acc'));
        $idValidation = AccountInfo::validateID($request['id_code']);
        if($idValidation && strlen($request['name']) > 3 && strlen($request['surname']) > 3){
            $newAcc = (object)[
                'id'     => $id,
                'name'   => $request['name'],
                'surname'=> $request['surname'],
                'id_code'=> $request['id_code'],
                'iban'   => $request['iban'],
                'balance'=> 0
            ];
            $writer->create($newAcc);
            Message::set("Account #$id was successfully created. ", 'success');
            return true;
        }
        if(strlen($request['name']) <= 3 && strlen($request['surname']) <= 3){
            Message::set("Your account name and surname can't be of 3 or less characters length.", 'error');
        }
        else if(strlen($request['name']) <= 3 ){
            Message::set("Your account name can't be of 3 or less characters length.", 'error');
        }
        else if(strlen($request['surname']) <= 3){
            Message::set("Your account surname can't be of 3 or less characters length.", 'error');
        }
        return false;
    }


}