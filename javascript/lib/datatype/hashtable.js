'use strict';

module.exports = {
    /**
     * A quick and dirty Hashtable implementation that partially mimics Java's API
     *
     * @constructor
     *
     * @see https://docs.oracle.com/javase/7/docs/api/java/util/Hashtable.html
     */
    hashtable: function() {
        var keys = [];
        var map = {};

        this.put = function(key, value) {
            if (!this.containsKey(key)) {
                keys.push(key);
            }
            map[key] = value;
        };

        this.get = function(key) {
            if (map.hasOwnProperty(key)) {
                return map[key];
            }
            return null;
        };

        this.containsKey = function(key) {
            return map.hasOwnProperty(key);
        };

        this.size = function() {
            return keys.length;
        };

        this.forEach = function(callback) {
            keys.forEach(function(key){
                callback(map[key], key);
            });
        };

        this.toArray = function() {
            var values = [];
            this.forEach(function(value){
                values.push(value);
            });
            return values;
        };
    }
}