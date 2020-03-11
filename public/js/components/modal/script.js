app.component('modalApp', {
    templateUrl: './public/js/components/modal/template.html',
    transclude: true,
    bindings: {
        show: '='
    },
    controller: function($scope, $element, $attrs) {
        var self = this;

        self.randomId = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

        self.openModal = function(){
            $('#' + self.randomId).modal('show');
        }

        self.closeModal = function(){
            $('#' + self.randomId).modal('hide');
        }

        self.initialize = function(){
            $scope.$watch('$ctrl.show', function(value){
                value ? self.openModal() : self.closeModal();
            })
        }

        self.$onInit = self.initialize;
    }
});