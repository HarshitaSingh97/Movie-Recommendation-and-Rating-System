Array.prototype.group = function (groups) {
    var array = this;
    var ret = [];
    var groupLength = Math.round(array.length / groups, 0);
    for (var i = 0; i < groups; i++) {
        var start = i * groupLength;
        var end = i == groups - 1 ? undefined : start + groupLength;
        ret.push(array.slice(start, end));
    }

    return ret;
}

Array.prototype.remove = function (val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] === val) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
}