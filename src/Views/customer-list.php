<?php
    $page_title = 'Custumers List';
    include_once('templates/header.php');
?>

<link href="./public/css/customer-list.css" rel="stylesheet">

<script src="./public/js/customers-list.js"></script>

<div class="col-md-12" ng-app="app" ng-controller="ListCustomerController as ctrl">
    <h3>List</h3>
    <hr>

    <table class="table customer-list" ng-show="ctrl.customers_list.length">
        <thead class="thead-light">
            <tr>
                <th class="truncate">Name</th>
                <th class="truncate">Birth Date</th>
                <th class="truncate">CPF</th>
                <th class="truncate">RG</th>
                <th class="truncate">Phone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="customer in ctrl.customers_list">
                <td class="truncate" title="{{customer.name}}">{{customer.name}}</td>
                <td class="truncate" title="{{customer.birth_date}}">{{customer.birth_date}}</td>
                <td class="truncate" title="{{customer.cpf}}">{{customer.cpf}}</td>
                <td class="truncate" title="{{customer.rg}}">{{customer.rg}}</td>
                <td class="truncate" title="{{customer.phone}}">{{customer.phone}}</td>
                <td class="text-center">
                    <button title="Delete" class="btn" ng-click="ctrl.confirmDelete(customer)">
                        <i class="icon-trash"></i>
                    </button>

                    <button title="Edit" class="btn" ng-click="ctrl.edit(customer)">
                        <i class="icon-edit"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <confirmation-delete-app
        show="ctrl.confirmationDelete.show"
        message="Do you really want to delete the customer?"
        on-confirm="ctrl.confirmationDelete.onConfirm()">
    </confirmation-delete-app>

    <div ng-show="!ctrl.customers_list.length">
        <h4 class="text-center gray">No registered customers</h4>
    </div>

</div>

<?php include_once('templates/footer.php') ?>