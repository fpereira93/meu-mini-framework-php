app.controller('ListCustomerController', ['$scope', '$http', 'helpers', function($scope, $http, helpers) {

    var self = this;

    self.customers_list = [];

    self.confirmationDelete = {
        show: false,
        customer: null,
        onConfirm: function(){
            $http({
                url: '/customers-delete',
                data: {
                    customer_id: this.customer.id,
                },
                method : 'POST',
            }).then(function (response) {
                var data = response.data;

                if (data.deleted){
                    toastr["success"]("Customer successfully deleted");
                    self.customers_list.splice(self.customers_list.indexOf(this.customer), 1);
                } else {
                    toastr["error"]("Error on delete Customer");
                }
    
            }, function (response) {
                toastr["error"]("An unexpected error has occurred");
            });

            this.customer = null;
        }
    }

    self.confirmDelete = function(customer){
        self.confirmationDelete.customer = customer;
        self.confirmationDelete.show = true;
    }

    self.edit = function(customer){
        window.location.replace("/customers-register?id=" + customer.id);
    }

    $http({
        url: '/customers-all',
        method : 'GET',
    }).then(function (response) {

        self.customers_list = response.data.map(function(data){

            data.cpf = helpers.formatCPF(data.cpf);
            data.rg = helpers.formatRG(data.rg);

            return data;
        });

    }, function (response) {
        toastr["error"]("An unexpected error has occurred");
    });
}]);