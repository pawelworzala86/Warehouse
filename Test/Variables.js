var Variables = {
    vars: {},
    link: {},
    sort: [],
    getSort: function () {
        return this.sort;
    },
    setSort: function (value) {
        this.sort = value;
    },
    getAllByString: function(searchStr){
        var result = {};
        $.each(this.vars, function(key, value){
            if(key.indexOf(searchStr)>=0){
                if(value instanceof Object) {
                    result[key] = value;
                }
            }
        });
        return result;
    },
    getLink: function (name) {
        return this.link[name];
    },
    setLink: function (name, value) {
        this.link[name] = value;
    },
    get: function (name) {
        return this.vars[name];
    },
    set: function (name, value) {
        if(value instanceof Object){
            var setFlat = function(name, value){
                $.each(value, function(key2, value2){
                    if(value2 instanceof Object){
                        setFlat(name+'.'+key2,value2);
                    }else{
                        Variables.vars[name+'.'+key2] = value2;
                    }
                });
            }
            setFlat(name, value);
        }
        this.vars[name] = value;
    },
    load: function () {
        $.ajax({
            method: 'get',
            url: HOST+'/Test/getVariables.php',
        }).done(function (result) {
            result = jQuery.parseJSON(result);
            $.each(result.vars, function (key, value) {
                Variables.vars[key] = value;
            });
            $.each(result.link, function (key, value) {
                Variables.link[key] = value;
            });
            Variables.sort = result.sort;
        });
    },
    save: function () {
        var data = {
            link: this.link,
            vars: this.vars,
            sort: this.sort,
        }
        $.ajax({
            method: 'post',
            url: HOST+'/Test/setVariables.php',
            data: data,
        }).done(function (result) {
        });
    }
}