var Randomize = {
    id: 1,
    get: function (io, parent, name, type) {
        var variableName = io + '.' + parent + '.' + name;
        var link = Variables.getLink(variableName);
        //console.log(io + '.' + parent + '.' + name, link);
        var ret = Variables.get(link);
        //console.log(ret);
        if(ret){
            return ret;
        }

        var ret = Variables.get(variableName);
        //console.log(ret);
        if(ret){
            return ret;
        }

        if (this[parent + '.' + type]) {
            return this[parent + '.' + type]();
        }
        if (this[type]) {
            return this[type]();
        }
        return null;
    },

    'string': function () {
        this.id++;
        return 'kuku' + this.id;
    },
    'UUID': function () {
        var text = '';
        var possible = 'abcdef0123456789';
        for (var i = 0; i < 32; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    },
    'Mail': function(){
        var mail = '';
        mail += LoremIpsum.getWord();
        if(Rand(0, 100)>75){
            mail += '.'+LoremIpsum.getWord();
        }
        mail += '@megazin.pl';
        return mail;
    },
    'Password': function(){
        var getChars = function(table, count){
            var result = '';
            for(i=0;i<count;i++){
                var index = Rand(0, table.length-1);
                var char = table.charAt(index);
                result += char;
            }
            return result;
        };
        var password = '';
        var lettersSmall = 'qwertyuiopasdfghjklzxcvbnm';
        var lettersSmallCount = 2;
        var lettersUpper = 'QWERTYUIOPASDFGHJKLZXCVBNM';
        var lettersUpperCount = 2;
        var numbers = '1234567890';
        var numbersCount = 2;
        var specialChars = '!@#$%^&*()_+-=[]\\{}|;\':",./<>?`~';
        var specialCharsCount = 2;
        var password ='';
        password += getChars(lettersSmall, lettersSmallCount);
        password += getChars(lettersUpper, lettersUpperCount);
        password += getChars(numbers, numbersCount);
        password += getChars(specialChars, specialCharsCount);
        return password.shuffle();
    },
}