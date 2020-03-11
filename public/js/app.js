var app = angular.module('app', [])

app.factory('validators', function() {
    return {
        isCPFValid: function(cpf){
            cpf = cpf.replace(/\D/g, '');
            if(cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) return false;
            var result = true;
            [9,10].forEach(function(j){
                var soma = 0, r;
                cpf.split(/(?=)/).splice(0,j).forEach(function(e, i){
                    soma += parseInt(e) * ((j+2)-(i+1));
                });
                r = soma % 11;
                r = (r <2)?0:11-r;
                if(r != cpf.substring(j, j+1)) result = false;
            });
            return result;
        }
    }
})

app.factory('helpers', function() {
    return {
        getUrlVars: function(){
            var vars = {};
            window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            return vars;
        },
        formatCPF: function(cpf){
            return cpf
                .replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})/, '$1-$2')
                .replace(/(-\d{2})\d+?$/, '$1');
        },
        formatRG: function(rg){
            rg = rg.replace(/\D/g,"");
            rg = rg.replace(/(\d{2})(\d{3})(\d{3})(\d{1})$/,"$1.$2.$3-$4");
            return rg ; 
        },
        formatPostalCode: function(code){
            var re = /^([\d]{2})\.*([\d]{3})-*([\d]{3})/;
            return code.replace(re,"$1.$2-$3")
        }
    }
})