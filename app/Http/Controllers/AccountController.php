<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\DisclosedAccountList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index (Request $request) {
        $accounts = $request->user()->client->accounts;
        $lists = $request->user()->client->disclosed_account_lists;
        $categories = $request->user()->client->categories;
        return view('pages.master.accounts', [
            'accounts' => $accounts,
            'lists' => $lists,
            'categories' => $categories
        ]);
    }

    public function store (Request $request) {
        $account = new Account();
        $account->title = $request->title;
        $account->title_en = $request->title_en;
        $account->detail_summary = $request->detail_summary;
        $account->statement = $request->statement;
        $account->category_id = $request->category_id;
        $account->dr_cr = $request->dr_cr;
        $account->conversion = $request->conversion;
        $account->fctr = $request->fctr;
        $account->enabled = $request->enabled;
        $account->save();

        return back()->with('toast', ['success', '勘定科目を新規作成しました']);
    }

    public function update (Request $request, Account $account) {
        $account->title = $request->title;
        $account->title_en = $request->title_en;
        $account->detail_summary = $request->detail_summary;
        $account->statement = $request->statement;
        $account->category_id = $request->category_id;
        $account->dr_cr = $request->dr_cr;
        $account->conversion = $request->conversion;
        $account->fctr = $request->fctr;
        $account->enabled = $request->enabled;
        $account->save();

        return back()->with('toast', ['success', '勘定科目を更新しました']);
    }

    public function destroy (Request $request, Account $account) {
        $account->delete();

        return back()->with('toast', ['success', '勘定科目を削除しました']);
    }
}