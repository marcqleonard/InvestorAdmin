<?php

namespace App\Http\Controllers;

//use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use \GuzzleHttp\Promise;
use Illuminate\Http\Response;
use App\InvestorAPI\Facade\InvestorFacade;

class UsersController extends Controller
{
    // show all users
    public function index(Request $request)
    {
        if($request->has('page') && $request->has('size')) {
            $pageSize = $request->input('size');
            $pageNumber = $request->input('page');
        }
        else {
            $pageSize = 10;
            $pageNumber = 1;
        }

        $facade = new InvestorFacade();
        $json = $facade->getUsers($pageSize, $pageNumber);

        $users = $json->items;
        $pageNumber = $json->pageNumber;
        $pageSize = $json->pageSize;
        $totalPageCount = $json->totalPageCount;

        return view('users.index')->with(compact('users'))->with('pageNumber', $pageNumber)->with('pageSize', $pageSize)->with('totalPageCount', $totalPageCount);
    }

    // delete user by Id
    public function destroy(Request $request, $id)
    {
        $facade = new InvestorFacade();
        $response_bool = $facade->deleteUser($id);

        if($response_bool) {
            $status_message = "User deleted!";
        }
        else {
            $status_message = "User could not be deleted";
        }

        return redirect()->route('users.index')->with('status', $status_message);
    }

    // show edit form
    public function edit(Request $request, $id)
    {
        $facade = new InvestorFacade();
        $response_json = $facade->getUser($id);
        $user = $response_json;

        return view('users.edit')->with(compact('user'));
    }

    // show user overview
    public function show(Request $request, $id)
    {
        $facade = new InvestorFacade();
        $user = $facade->getUser($id);

        return view('users.show')->with(compact('user'));
    }

    // show portfolio
    public function portfolio(Request $request, $id)
    {
        $facade = new InvestorFacade();
        $user = $facade->getUser($id);

        $account = $facade->getAccount($user->id, $user->accounts[0]->id);

        return view('users.portfolio')->with(compact('user'))->with(compact('account'));
    }

    // show transaction history
    public function history(Request $request, $id)
    {
        $facade = new InvestorFacade();
        $user = $facade->getUser($id);

        $transactions = $facade->getTransactions($user->id, $user->accounts[0]->id)->items;

        return view('users.history')->with(compact('user'))->with(compact('transactions'));
    }

    // show danger zone
    public function dangerzone(Request $request, $id)
    {
        $facade = new InvestorFacade();
        $user = $facade->getUser($id);

        $account = $facade->getAccount($id, $user->accounts[0]->id);

        return view('users.dangerzone')->with(compact('user'))->with(compact('account'));
    }

    // update user
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'name' => 'required|regex:/^[^~`^$#@%!\'*\(\)<>=.;:]+$/u|min:5|max:30',
            'level' => 'required|in:Investor,Administrator'
        ]); // back to form if validation fails

        $displayName = $request->input('name');
        $email = $request->input('email');
        $level = $request->input('level');

        $userId = $id;

        $facade = new InvestorFacade();
        $response_bool = $facade->updateUser($userId, $displayName, $email, $level);

        if($response_bool) {
            $status_message = "User updated!";
        }
        else {
            $status_message = "User could not be updated";
        }

        return redirect()->back()->with('status', $status_message);
    }

    // delete user by Id
    public function resetAccount(Request $request, $userId, $accountId)
    {
        $facade = new InvestorFacade();
        $response_bool = $facade->resetAccount($userId, $accountId);

        if($response_bool) {
            $status_message = "Account reset!";
        }
        else {
            $status_message = "Account could not be reset";
        }

        return redirect()->back()->with('status', $status_message);
    }

}
