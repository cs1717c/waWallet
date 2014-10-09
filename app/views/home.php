<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Demo project">
    <meta name="author" content="John Dodds">

    <title>WaWallet</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Wallet Custom CSS -->
    <link href="css/wallet.css" rel="stylesheet">
	
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- AngularJS -->
	<script src="js/angular-1.2.0rc1.js"></script>
		<!-- AngularJS ngResources -->
	<script src="js/angular-resource-1.2.0rc1.js"></script>
	<!-- Wallet Angular JavaScript -->
    <script src="js/wallet.js"></script>

</head>

<body ng-app="walletApp" ng-controller="walletApp.appController" ng-init="init()">
<div class="spinner-container" ng-if="app.loading"><div class="loading"></div></div>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">	
        <div class="container">
                <a class="navbar-brand" href="#">WA Wallet</a>
				 <button type="button" class="navbar-toggle" ng-click="toggleMenu()">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container" id="page-container">
	
		<!-- phone menu -->
		<div class="row" id="phone-menu" ng-class="{hidden : app.menuHidden}">
			<div class="col-xs-12">
			<h4>Wallets</h4>
				<div class="btn-group">
								<button class="btn btn-small" ng-click="selectPage('create-wallet'); toggleMenu();">Add</button>
								<button class="btn btn-small" ng-click="selectPage('edit-wallet'); toggleMenu();">Edit</button>
								<button class="btn btn-small" ng-click="deleteWallet(app.selectedWallet)">Delete</button>
				</div> <! -- end wallet toolbar -->
				<div class="list-group">
					 <a href="#" class="list-group-item" class="active" ng-class="{active: app.selectedWallet.id == wallet.id}" ng-repeat="wallet in app.wallets" ng-click="selectWallet(wallet); toggleMenu();">{{wallet.name}}</a>
				</div> <!-- end wallet list -->
			</div>		
		</div> <!-- end phone menu -->
	
        <div class="row">

            <div class="col-sm-4 col-md-3 hidden-xs" id="wallet-bar">
                <h3>Wallets</h3>
				<div class="btn-group">
					<button class="btn btn-default" ng-click="selectPage('create-wallet')">Add</button>
					<button class="btn btn-default" ng-click="selectPage('edit-wallet')">Edit</button>
					<button class="btn btn-default" ng-click="deleteWallet(app.selectedWallet)">Delete</button>
				</div> <! -- end wallet toolbar -->
				<br/><br/>	
				<ul class="list-group">
                    <li class="list-group-item clickable" class="active" ng-class="{active: app.selectedWallet.id == wallet.id}" ng-repeat="wallet in app.wallets" ng-click="selectWallet(wallet)">{{wallet.name}}</li>
                </ul> <!-- end wallet list -->
            </div> <! -- end sidebar -->
			
			<div class="col-sm-8 col-md-6" id="edit-wallet" ng-if="app.currentPage == 'create-wallet' || app.currentPage == 'edit-wallet'">
				<h2 ng-if="app.currentPage == 'edit-wallet'">Edit wallet</h2>
				<h2 ng-if="app.currentPage == 'create-wallet'">Create wallet</h2>
				<form id="edit-wallet" role="form" >
					<div class="form-group">
						<label for="name">Name</label><input type="text" name="name" id="name" ng-model="app.selectedWallet.name" class="form-control">
					</div>
					<div class="form-group">
						<label for="currency">Currency</label>
						<select name="currency" id="currency" ng-model="app.selectedWallet.currency" class="form-control" ng-options="currency.id as currency.name for currency in app.currencies">
						</select>
					</div>
					<button type="submit" class="btn btn-default"  ng-if="app.currentPage == 'create-wallet'" ng-click="createWallet(app.selectedWallet)">Add</button>
					<button type="submit" class="btn btn-default"  ng-if="app.currentPage == 'edit-wallet'" ng-click="updateWallet(app.selectedWallet)">Save</button>
				</form>
			</div> <!-- end edit wallet -->

            <div class="col-sm-8 col-md-9" id="view-wallet" ng-if="app.currentPage == 'view-wallet'">
				<div class="row"><div class="col-md-6 col-sm-6">
					<h2>{{app.selectedWallet.name}}</h2>
					<p>
					<strong>Balance: </strong><i class="fa fa-{{app.selectedWallet.currencyCode}}"></i>{{app.selectedWallet.balance}}<br/>
					<strong>Currency: </strong><i class="fa fa-{{app.selectedWallet.currencyCode}}"></i> ({{app.selectedWallet.currencyCodeCaps}})
					</p>
				</div></div> <!-- end wallet info row/col" -->
				
				<div class="row"><div class="col-md-4 col-sm-6 col-xs-9">
					<div class="panel">
						<h3>Add Transaction</h3>
						<form id="transaction-form">
						<div class="form-group">
							<label for="amount">Amount</label>
							<input class="form-control"  ng-model="app.amountToAdd" name="amount">
							<button type=-"submit" class="btn btn-default" ng-click="addTransaction(app.amountToAdd, 'credit')">Credit</button>
							<button type=-"submit" class="btn btn-default" ng-click="addTransaction(app.amountToAdd, 'debit')">Debit</button>
						</div> <!-- end form group -->
					</div> <!--end add transaction panel -->
				</div></div> <!-- close add transaction row/col -->
			
				<div class="row"><div class="col-md-9">

					<h3>Transactions</h3>
					<table class="table table-striped table-bordered">
						<tr>
							<th>Transaction ID</th>
							<th>Amount</th>
							<th>Date</th>
						</tr>
						<tr ng-repeat="transaction in app.selectedWallet.transactions">
							<td>{{transaction.id}}</td>
							<td><i class="fa fa-{{app.selectedWallet.currencyCode}}"></i>{{transaction.amount | number : 2}}</td>
							<td>{{transaction.created_at}}</td>
						</tr>
					</table>
				</div></div> <!-- close transactions row/col -->
			
            </div> <!-- close view wallet -->

        </div> <!--- close main container -->

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright (c) John Dodds 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
</body>

</html>