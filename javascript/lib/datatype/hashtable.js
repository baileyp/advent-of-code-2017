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
        var map = {};

        this.put = function(key, value) {
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
            var size = 0;
            for (var key in map) {
                if (map.hasOwnProperty(key)) {
                    size++;
                }
            }

            return size;
        };
    }
}