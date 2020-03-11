app.component('confirmationDeleteApp', {
    templateUrl: './public/js/components/confirmation-delete/template.html',
    transclude: true,
    bindings: {
        show: '=',
        message: '@',
        onConfirm: '&',
        onCancel: '&'
    },
    controller: function($scope, $element, $attrs) {
        var self = this;

        self.cancel = function(){
            self.onCancel && self.onCancel();
            self.show = false;
        }

        self.confirm = function(){
            self.onConfirm && self.onConfirm();
            self.show = false;
        }
    }
});