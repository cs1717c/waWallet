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


    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- AngularJS -->
	<script src="js/angular-1.2.0rc1.js"></script>
	
	<!-- Wallet Angular JavaScript -->
    <script src="js/wallet.js"></script>

</head>

<body  ng-app="walletApp" ng-controller="appController" ng-init="init()">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
                <a class="navbar-brand" href="#">WA Wallet</a>
            </div>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container" id="page-container">

        <div class="row">

            <div class="col-md-3">
                <h3>Wallets</h3>
					<div class="form-group">
						<button class="btn btn-default" ng-click="selectPage('create-wallet')">Add</button>
						<button class="btn btn-default" ng-click="selectPage('edit-wallet')">Edit</button>
						<button class="btn btn-default">Delete</button>
					</div>

			<div class="list-group">
                    <a href="#" class="list-group-item" ng-click="selectWallet(0)">Wallet 1</a>
                </div>
            </div>
			
			<div class="col-md-6" id="edit-wallet" ng-if="model.currentPage == 'create-wallet' || model.currentPage == 'edit-wallet'">
			<h2 ng-if="model.currentPage == 'edit-wallet'">Edit wallet</h2>
			<h2 ng-if="model.currentPage == 'create-wallet'">Create wallet</h2>
            <div class="form-group">
			<form id="edit-wallet" role="form">
			<div class="form-group">
			<label for="name">Name</label><input type="text" name="name" id="name" class="form-control">
			</div>
			<div class="form-group">
			<label for="currency">Currency</label><select name="currency" id="currency" class="form-control"></select>
			</div>
			<button type="submit" class="btn btn-default">Add</button>
			</div>
			</form>
			</div>

            <div class="col-md-9" id="view-wallet" ng-if="model.currentPage == 'view-wallet'">
			<h2>Your wallet</h2>
			<h3>Wallet Name</h3>
			<p>
			<strong>Balance: </strong>&pound; X.XX<br/>
			<strong>Currency: </strong>X
			</p>
			
			<h3>Transactions</h3>
			<table class="table table-striped table-bordered">
			<tr>
			<th>Transaction ID</th>
			<th>Amount</th>
			<th>Date</th>
			</tr>
			<tr>
			<td>1</td>
			<td>&pound;10.00</td>
			<td>Oct 09, 2014 07:01</td>
			</table>
            </div>

        </div>

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