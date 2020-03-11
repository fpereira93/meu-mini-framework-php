app.controller('CustomerRegisterController', ['$scope', '$http', '$timeout', 'validators', 'helpers', function($scope, $http, $timeout, validators, helpers) {

    var self = this;

    self.state_list = [
        'AC', 'AL',
        'AP', 'AM',
        'BA', 'CE',
        'DF', 'ES',
        'GO', 'MA',
        'MT', 'MS',
        'MG', 'PA',
        'PB', 'PR',
        'PE', 'PI',
        'RJ', 'RN',
        'RS', 'RO',
        'RR', 'SC',
        'SP', 'SE',
        'TO',
    ];

    self.data_register = {
        id: null,
        name: null,
        birth_date: null,
        cpf: null,
        rg: null,
        phone: null,
    }

    self.errors = {}
    self.adresses_list = [];

    self.modal = {
        display: false,
        data: {
            number: null,
            street: null,
            state: null,
            postal_code: null,
            country: null,
        },
        isEdit: false,
        errors: {},
        validate: function(){
            var field_name = {
                number: 'Number',
                street: 'Street',
                state: 'State',
                postal_code: 'Postal Code',
                country: 'Country',
            };

            var keys = Object.keys(field_name);

            keys.forEach(function(key){
                self.modal.errors[key] = (self.modal.data[key] || '').toString().trim() == "" ? field_name[key] + ' is required' : null;
            });
    
            return !keys.some(function(key){
                return self.modal.errors[key] != null;
            });
        },
        open: function(){
            this.display = true;
        },
        close: function(){
            this.display = false;
            this.isEdit = false;

            Object.keys(self.modal.data).forEach(function(key){
                self.modal.data[key] = null;
                self.modal.errors[key] = null;
            });
        },
        add: function(){
            if (self.modal.validate()){
                if (self.modal.isEdit){
                    self.adresses_list[self.modal.indexEdited] = angular.copy(self.modal.data);
                } else {
                    self.adresses_list.push(angular.copy(self.modal.data));
                }

                self.modal.close();
            }
        }
    }

    self.confirmationDelete = {
        show: false,
        address: null,
        onConfirm: function(){
            var index = self.adresses_list.indexOf(this.address);
            self.adresses_list.splice(index, 1);
            this.address = null;
        }
    }

    self.removeAdresse = function(address){
        self.confirmationDelete.address = address;
        self.confirmationDelete.show = true;
    }

    self.editAddress = function(address){
        self.modal.data = angular.copy(address);
        self.modal.indexEdited = self.adresses_list.indexOf(address);
        self.modal.display = true;
        self.modal.isEdit = true;
        self.applyMasks();
    }

    self.validate = function(){
        var field_name = {
            name: 'Name',
            birth_date: 'Birth Date',
            cpf: 'CPF',
            rg: 'RG',
            phone: 'Phone',
        };

        var keys = Object.keys(field_name);

        keys.forEach(function(key){
            var value = (self.data_register[key] || '').toString().trim();

            if (!value){
                self.errors[key] = field_name[key] + ' is required';
            } else if (key == 'cpf' && !validators.isCPFValid(value)){
                self.errors[key] = field_name[key] + ' invalid';
            } else {
                self.errors[key] = null;
            }
        });

        return !keys.some(function(key){
            return self.errors[key] != null;
        });
    }

    self.formatDate = function(date){
        date.setMinutes(date.getMinutes() - date.getTimezoneOffset());
        return date.toJSON().slice(0, 10);
    }

    self.createPayload = function(){
        var payload = angular.copy(self.data_register);

        payload.cpf = payload.cpf.replace(/\D/g,'');
        payload.rg = payload.rg.replace(/\D/g,'');

        payload.birth_date = self.formatDate(payload.birth_date);

        payload.adresses_list = self.adresses_list.map(function(data){
            data.postal_code = data.postal_code.replace(/\D/g,'');
            return data;
        });

        return payload;
    }

    self.save = function(){
        if (!self.validate()){
            return;
        }

        var payload = self.createPayload();

        $http({
            url: '/customers-post',
            data : payload,
            method : 'POST',
        }).then(function (response) {
            var data = response.data;

            if (data.is_valid){
                self.data_register.id = data.customer_id;
                toastr["success"]("Customer successfully registered");
            } else {
                toastr["error"]("Error registering the Customer");
            }

        }, function (response) {
            toastr["error"]("An unexpected error has occurred");
        });
    }

    self.applyMasks = function(){
        $timeout(function(){
            $("#cpf").unmask().mask("000.000.000-00");
            $('#rg').unmask().mask('00.000.000-0');
            $('#postal-code').unmask().mask('00000-000');
        })
    }

    self.formatPostalCode = helpers.formatPostalCode;

    var data_url = helpers.getUrlVars();

    if (data_url.id){
        $http({
            url: '/customer-info',
            data : {
                customer_id: data_url.id
            },
            method : 'POST',
        }).then(function (response) {
            var data = response.data;

            if (data.customer_db){
                data.customer_db.birth_date = new Date(data.customer_db.birth_date);
                self.data_register = angular.copy(data.customer_db);

                if (data.adresses_db.length){
                    self.adresses_list = angular.copy(data.adresses_db);
                }
            }

            self.applyMasks()
        }, function (response) {
            toastr["error"]("An unexpected error has occurred");
        });
    } else {
        self.applyMasks()
    }
}]);