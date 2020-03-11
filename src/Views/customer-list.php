<?php
    $page_title = 'Custumers List';
    include_once('templates/header.php');
?>

<script src="./public/js/customers-list.js"></script>

<div class="col-md-12" ng-app="app" ng-controller="ListCustomerController as ctrl">
    <h3>List</h3>
    <hr>

    <table class="table" ng-show="ctrl.customers_list.length">
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Birth Date</th>
                <th>CPF</th>
                <th>RG</th>
                <th colspan="2">Phone</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="customer in ctrl.customers_list">
                <td>{{customer.name}}</td>
                <td>{{customer.birth_date}}</td>
                <td>{{customer.cpf}}</td>
                <td>{{customer.rg}}</td>
                <td>{{customer.phone}}</td>
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