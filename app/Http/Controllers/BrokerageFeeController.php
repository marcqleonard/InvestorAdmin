<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvestorAPI\Facade\InvestorFacade;
use Illuminate\Http\Response;

class BrokerageFeeBracket
{
    public $min;
    public $max;
    public $value;

    public function __construct($min, $max, $value)
    {
        $this->min = $min;
        $this->max = $max;
        $this->value = $value;
    }
}

class BrokerageFeeController extends Controller
{
    public function edit(Request $request)
    {
        $facade = new InvestorFacade();
        $buyFee = $facade->getBuyBrokerageFee();
        $sellFee = $facade->getSellBrokerageFee();

        return view('brokerage.edit')->with(compact('buyFee'))->with(compact('sellFee'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'buyFixed.*.*' => 'required|numeric',
            'buyPercentage.*.*' => 'required|numeric',
            'sellFixed.*.*' => 'required|numeric',
            'sellPercentage.*.*' => 'required|numeric'
        ]); // back to form if validation fails

        $buyFixedBrackets = $request->input("buyFixed");
        $buyPercentageBrackets = $request->input('buyPercentage');
        $sellFixedBrackets = $request->input('sellFixed');
        $sellPercentageBrackets = $request->input('sellPercentage');


        $facade = new InvestorFacade();
        $buy_response = $facade->updateBuyFee($buyFixedBrackets, $buyPercentageBrackets);
        $sell_response = $facade->updateSellFee($sellFixedBrackets, $sellPercentageBrackets);

        if($buy_response && $sell_response) {
            $status_message = "Brokerage fees updated!";
        }
        else {
            $status_message = "Brokerage fees could not be updated";
        }

        return redirect()->back()->with('status', $status_message);
    }
}
