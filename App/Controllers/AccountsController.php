<?php
namespace Bank\App\Controllers;
use Bank\App\App;
use Bank\App\Services\Accounts;
use Bank\App\Services\Message;

class AccountsController{
    public function getSorted($sort, $asc)
    {
        return App::view('AccountsView', [
            'sortBy' => $sort,
            'ascending' => $asc
        ]);
    }

    public function getEdited($action, $id)
    {
        $acc = Accounts::getAccount($id);
        if($acc){
            return App::view('EditAccountView', [
                'action' => $action,
                'id' => $id,
                'name'   => $acc->name,
                'surname'=> $acc->surname,
                'balance'=> $acc->balance
            ]);
        }
        return false;
    }

    public function getUpdated($action, $id, $ammount)
    {
        $possibleToUpdate = Accounts::updateAccount($action, $id, $ammount);
        if($possibleToUpdate){
            $actionR = $action == "plus" ? "added" : "taken away";
            $fromTo = $action == "plus" ? "to" : "from";
            Message::set("You have successfully $actionR $ammount EUR $fromTo #$id account." , 'success');
            App::redirect('acc');
        }
        else{
            App::redirect("acc/$action/$id");
        }
    }

    public function getDeleted($id)
    {
        $acc = Accounts::getAccount($id);
        if($acc){
            return App::view('DeleteAccountView', [
                'id' => $id,
                'name'   => $acc->name,
                'surname'=> $acc->surname,
                'balance'=> $acc->balance
            ]);
        }
        return false;
    }

    public function getDestroyed($id)
    {
        $possibleToDestroy = Accounts::destroyAccount($id);
        if($possibleToDestroy){
            Message::set("You have successfully deleted an account #$id!", 'success');
        }
        App::redirect('acc');
    }

    public function getCreated($request)
    {
        $canBeCrated = Accounts::createAccount($request);
        if($canBeCrated){
            // success for creation
            App::redirect('acc');
        }
        else{
            // error for creation
            App::redirect('create');
        }
    }

}