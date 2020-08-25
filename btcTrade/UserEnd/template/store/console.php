<?php require_once "../../core/temp_security.php"; ?>
     <div class="subheader"></div><!-- sub-header -->
    <!-- Currency Rate -->
    <div class="section-padding-5">
        <div class="container">
            <div class="row">
                <div class="col">
<div class="currency-rate currency-rate-v2">
                        <div class="currency-convert">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Trade
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="section('trade')">Trade</a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="section('withdraw')">Withdrwal</a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="section('deposit')">Deposit</a>
                                </div>
                            </div>
                        </div>
                        <div class="update-rate">
                            <div class="currency-info last-price">
                                <span>Last Deposit</span>
                                <h6><span class="color-sell" id="lDeposit"><img id='loading-image' class='ajaxpic' src='core/images/loading.svg' width='16px' height=''></span></h6>
                            </div>
                            <div class="currency-info change">
                                <span>USD Balance</span>
                                <h6 class="color-buy" id="CBalance"><img id='loading-image' class='ajaxpic' src='core/images/loading.svg' width='16px' height=''></sub></h6>
                            </div>
                            <div class="currency-info low">
                                <span>Last Trade Amount</span>
                                <h6 class="currency-info-base" id="lTrAmt"><img id='loading-image' class='ajaxpic' src='core/images/loading.svg' width='16px' height=''></h6>
                            </div>
							<div class="currency-info high">
                                <span>Last Trade Profit</span>
                                <h6 class="color-buy" id="lTrProfit"><img id='loading-image' class='ajaxpic' src='core/images/loading.svg' width='16px' height=''></h6>
                            </div>
                            <div class="currency-info volume-value">
                                <span>Last Trade Duration</span>
                                <h6 class="currency-info-base" id="lTrDuration"><img id='loading-image' class='ajaxpic' src='core/images/loading.svg' width='16px' height=''></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-block dashboard-white dashboard-fullwidth" id="trade">
        <div class="container-fluid">
            <div class="dashboard-body">
                <div class="row">
                    <div class="col-lg-3">
				<div class="form-group">
		   <label for="fundAmt">Amount(USD)</label>
           <div class="input-group">
             <input class="form-control" id="tradeAmtUSD" required placeholder="500" autocomplete="off" onkeyup="getProfitUSD(this.value);">
            </div>
            </div>
           <div class="form-group">
		   <label for="fundAmt">Profit (USD)</label>
           <div class="input-group">
              <input class="form-control" id="profitUSD" value="0" readonly="">
            </div>
            </div>
		<div class="form-group row">
		<div class="col-12 form-input-block">
		<label for="">Duration (Days)</label>
		</div>
                 <div class="col-3 form-input-block">
                 <input type="radio" value="4" name="trDate" onclick="setNewProfit('4')" checked="" /> 4
            </div>
            <div class="col-3 form-input-block">
                <input type="radio" value="7" onclick="setNewProfit('7')" name="trDate" /> 7
            </div>
            <div class="col-3 form-input-block">
                <input type="radio" value="14" onclick="setNewProfit('14')" name="trDate" /> 14
            </div>
            <div class="col-3 form-input-block">
                <input type="radio" value="30" onclick="setNewProfit('30')" name="trDate" /> 30
            </div>
            <div class="col-12 form-input-block" id="tradeAlert"></div>
             </div>
					<div class="form-group row">
                 <div class="col-6 form-input-block">
                 <button type="button" class="btn buy-btn" onclick="stTrade('buy')"><i class="fa fa-arrow-up"></i></button>
            </div>
            <div class="col-6 form-input-block">
                <button type="button" class="btn sell-btn" onclick="stTrade('sell')"><i class="fa fa-arrow-down"></i></button>
            </div>
            <div class="col-12 form-input-block" id="tradeAlert"></div>
             </div>
                        <div class="dahboard-order-block">
                            <ul class="nav das-oreder-nav">
                                <li class="nav-item nav-item-first">
                                    <a class="nav-link" href="#">
                                        Trade History
                                    </a>
                                </li>
                                
                            </ul><!-- das-oreder-nav -->
                            <div class="das-oreder-table-block">
                                <table class="table das-oreder-table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">Price(USD)</th>
                                            <th class="text-center" scope="col">Profit(USD)</th>
                                            <th class="text-right" scope="col">Trade Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="TradeHistory">
                                    </tbody>
                                </table>
                               
                            </div>
                        </div><!-- dahboard-order-block -->
                    </div><!-- col-lg-3 -->
                    <div class="col-lg-9">
					<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div id="tradingview_24737"></div>
  <div class="tradingview-widget-copyright"></div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  "width": "100%",
  "height": 610,
  "symbol": "BITBAY:BTCUSD",
  "interval": "1",
  "timezone": "Etc/UTC",
  "theme": "light",
  "style": "1",
  "locale": "en",
  "toolbar_bg": "#f1f3f6",
  "enable_publishing": false,
  "allow_symbol_change": true,
  "watchlist": [
    "COINBASE:BTCUSD",
    "COINBASE:BTCGBP",
    "COINBASE:BTCEUR"
  ],
  "details": true,
  "studies": [
    "PriceVolumeTrend@tv-basicstudies"
  ],
  "container_id": "tradingview_24737"
}
  );
  </script>
</div>
<!-- TradingView Widget END -->
                    </div><!-- col-lg-6 -->
                       
                    </div><!-- col-lg-3 -->
                </div>
            </div><!-- dashboard-body -->
        </div>
<div class="dashboard-block dashboard-white dashboard-fullwidth" id="deposit" style="display:none;">
 <div class="container-fluid">
            <div class="dashboard-body">
                <div class="row">
                    <div class="col-lg-3">
					<div class="form-group row">
                 <div class="col-12 form-input-block">
                 <button type="button" class="btn buy-btn" data-toggle="modal" data-target="#MKdeposit">Make Deposit</button>
            </div>
             </div>
                    </div><!-- col-lg-3 -->
                    <div class="col-lg-8">
				 <div class="dahboard-order-block">
                            <ul class="nav das-oreder-nav">
                                <li class="nav-item nav-item-first">
                                    <a class="nav-link" href="#">
                                        Deposit History
                                    </a>
                                </li>
                                
                            </ul><!-- das-oreder-nav -->
                            <div class="das-oreder-table-block">
                                <table class="table das-oreder-table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">Date</th>
                                            <th class="text-center" scope="col">Amount(USD)</th>
                                            <th class="text-center" scope="col">Amount(BTC)</th>
                                            <th class="text-right" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="DepositHistory">
                                    </tbody>
                                </table>
                               
                            </div>
                        </div><!-- dahboard-order-block -->
                    </div><!-- col-lg-6 -->
                       
                    </div><!-- col-lg-3 -->
                </div>
            </div><!-- dashboard-body -->
</div>



<div class="dashboard-block dashboard-white dashboard-fullwidth" id="withdraw" style="display:none;">
 <div class="container-fluid">
            <div class="dashboard-body">
                <div class="row">
                    <div class="col-lg-3">
					<div class="form-group row">
                 <div class="col-12 form-input-block">
                 <button type="button" class="btn buy-btn" data-toggle="modal" data-target="#WithdrawUSD">Request Withdrawal</button>
            </div>
             </div>
                    </div><!-- col-lg-3 -->
                    <div class="col-lg-8">
				 <div class="dahboard-order-block">
                            <ul class="nav das-oreder-nav">
                                <li class="nav-item nav-item-first">
                                    <a class="nav-link" href="#">
                                        Withdrwal History
                                    </a>
                                </li>
                               
                            </ul><!-- das-oreder-nav -->
                            <div class="das-oreder-table-block">
                                <table class="table das-oreder-table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">Amount(USD)</th>
                                            <th class="text-center" scope="col">Amount(BTC)</th>
                                            <th class="text-right" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                               
                            </div>
                        </div><!-- dahboard-order-block -->
                    </div><!-- col-lg-6 -->
                       
                    </div><!-- col-lg-3 -->
                </div>
            </div><!-- dashboard-body -->
</div>


<div class="modal fade" id="WithdrawUSD" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Request Withdrwal</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>Your account does not support withdrwal yet.</p>
        </div>
      </div>
      
    </div>
  </div>
    

<div class="modal fade" id="MKdeposit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Add Funds to Account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="formBody">
           <div class="form-group">
		   <label for="fundAmt">Amount in USD</label>
           <div class="input-group">
              <input type="hidden" id="transId" value="<?php echo $app->get_rand_numbers(6); ?>">
             <input class="form-control" id="fundAmtUSD" required placeholder="500" autocomplete="off" onkeyup="getBTCamt(this.value);">
            </div>
            </div>
           <div class="form-group">
		   <label for="fundAmt">Amount in BTC</label>
           <div class="input-group">
              <input class="form-control" id="fundAmtBTC" value="0" readonly="">
            </div>
            </div>
           <div class="form-group">
		   <div id="LoadingBody"></div>
            </div>
           
           <div class="input-group">
              <button id="addFButton" class="btn buy-btn" onclick="addFunds()" style="display:none;" type="button">Add funds</button>
            </div>
			<br/><center><img src="<?php echo APP_TROUTE.APP_THEME; ?>/images/btc.png" width="" height="50px" /></center>
        </div>
      </div>
      
    </div>
  </div>
  
   