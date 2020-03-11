<?php
    $page_title = 'Custumers Register';
    include_once('templates/header.php');
?>

<script src="./public/js/customers-register.js"></script>

<div class="col-md-12" ng-app="app" ng-controller="CustomerRegisterController as ctrl">
    <h3>Register</h3>

    <hr>

    <modal-app show="ctrl.modal.display">
        <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Address Data</h5>
            <button type="button" class="close" aria-label="Close" ng-click="ctrl.modal.close()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="row">
                    <div class="col-sm-6 pb-3">
                        <label for="street-address">Street</label>
                        <input ng-model="ctrl.modal.data.street" type="text" class="form-control" id="street-address" maxlength="100" placeholder="Street" ng-class="{'error': ctrl.modal.errors['street']}">

                        <div ng-if="ctrl.modal.errors['street']" class="message error">{{ctrl.modal.errors['street']}}</div>
                    </div>

                    <div class="col-sm-6 pb-3">
                        <label for="number-address">Number</label>
                        <input ng-model="ctrl.modal.data.number" min="0" type="number" id="number-address" class="form-control" placeholder="Number" ng-class="{'error': ctrl.modal.errors['number']}">

                        <div ng-if="ctrl.modal.errors['number']" class="message error">{{ctrl.modal.errors['number']}}</div>
                    </div>

                    <div class="col-sm-6 pb-3">
                        <label for="state-address">State</label>

                        <select ng-model="ctrl.modal.data.state" class="form-control" id="state-address" ng-class="{'error': ctrl.modal.errors['state']}">
                            <option value="">Select</option>

                            <option ng-repeat="state in ctrl.state_list" value="{{state}}">{{state}}</option>
                        </select>

                        <div ng-if="ctrl.modal.errors['state']" class="message error">{{ctrl.modal.errors['state']}}</div>
                    </div>

                    <div class="col-sm-6 pb-3">
                        <label for="postal-code">Postal Code</label>
                        <input ng-model="ctrl.modal.data.postal_code" type="text" class="form-control" id="postal-code" maxlength="100" placeholder="Postal Code" ng-class="{'error': ctrl.modal.errors['postal_code']}">

                        <div ng-if="ctrl.modal.errors['postal_code']" class="message error">{{ctrl.modal.errors['postal_code']}}</div>
                    </div>

                    <div class="col-sm-6 pb-3">
                        <label for="country-address">Country</label>
                        <input ng-model="ctrl.modal.data.country" type="text" class="form-control" id="country-address" maxlength="50" placeholder="Country" ng-class="{'error': ctrl.modal.errors['country']}">

                        <div ng-if="ctrl.modal.errors['country']" class="message error">{{ctrl.modal.errors['country']}}</div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" ng-click="ctrl.modal.close()">Close</button>
            <button type="button" class="btn btn-primary" ng-click="ctrl.modal.add()">
                {{ (ctrl.modal.isEdit ? 'Save' : 'Add') + ' address'}}
            </button>
        </div>
    </modal-app>

    <confirmation-delete-app
        show="ctrl.confirmationDelete.show"
        message="Do you really want to delete the address?"
        on-confirm="ctrl.confirmationDelete.onConfirm()">
    </confirmation-delete-app>

    <!-- form complex example -->
    <div class="form-row mt-4 mb-4">
        <div class="col-sm-9 pb-3">
            <label for="name">Name</label>
            <input ng-model="ctrl.data_register.name" type="text" class="form-control" id="name" maxlength="200" placeholder="Name" ng-class="{'error' : ctrl.errors['name']}">

            <div ng-if="ctrl.errors['name']" class="message error">{{ctrl.errors['name']}}</div>
        </div>

        <div class="col-sm-3 pb-3">
            <label for="birth-bate">Birth Date</label>
            <input ng-model="ctrl.data_register.birth_date" type="date" id="birth-bate" class="form-control" ng-class="{'error' : ctrl.errors['birth_date']}">

            <div ng-if="ctrl.errors['birth_date']" class="message error">{{ctrl.errors['birth_date']}}</div>
        </div>

        <div class="col-sm-4 pb-3">
            <label for="cpf">CPF</label>
            <input ng-model="ctrl.data_register.cpf" type="text" class="form-control" id="cpf" maxlength="15" placeholder="CPF" ng-class="{'error' : ctrl.errors['cpf']}">

            <div ng-if="ctrl.errors['cpf']" class="message error">{{ctrl.errors['cpf']}}</div>
        </div>

        <div class="col-sm-4 pb-3">
            <label for="rg">RG</label>
            <input ng-model="ctrl.data_register.rg" type="text" class="form-control" id="rg" maxlength="15" placeholder="RG" ng-class="{'error' : ctrl.errors['rg']}">

            <div ng-if="ctrl.errors['rg']" class="message error">{{ctrl.errors['rg']}}</div>
        </div>

        <div class="col-sm-4 pb-3">
            <label for="phone">Phone</label>
            <input ng-model="ctrl.data_register.phone" type="text" class="form-control" id="phone" maxlength="15" placeholder="Phone" ng-class="{'error' : ctrl.errors['phone']}">

            <div ng-if="ctrl.errors['phone']" class="message error">{{ctrl.errors['phone']}}</div>
        </div>
    </div>

    <button type="button" class="btn btn-primary float-right" ng-click="ctrl.modal.open()" data-toggle="modal">
        <i class="icon-plus"></i>
    </button>

    <h3>Addresses</h3>
    <hr>

    <table class="table" ng-show="ctrl.adresses_list.length">
        <thead class="thead-light">
            <tr>
                <th>Street name</th>
                <th>Number</th>
                <th>State</th>
                <th>Postal Code</th>
                <th colspan="2">Country</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="adresse in ctrl.adresses_list">
                <td>{{adresse.street}}</td>
                <td>{{adresse.number}}</td>
                <td>{{adresse.state}}</td>
                <td>{{ctrl.formatPostalCode(adresse.postal_code)}}</td>
                <td>{{adresse.country}}</td>
                <td class="text-center">
                    <button title="Delete" class="btn" ng-click="ctrl.removeAdresse(adresse)">
                        <i class="icon-trash"></i></i>
                    </button>

                    <button title="Edit" class="btn" ng-click="ctrl.editAddress(adresse)">
                        <i class="icon-edit"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <div ng-show="!ctrl.adresses_list.length">
        <h4 class="text-center gray">No registered address</h4>
    </div>

    <div class="row mt-5">
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary float-right" ng-click="ctrl.save()">
                <i class="icon-save"></i> Save
            </button>
        </div>
    </div>

</div>

<?php include_once('templates/footer.php') ?>