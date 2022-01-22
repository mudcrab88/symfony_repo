Vue.options.delimiters = [ '[[', ']]'];

let textarea = new Vue({
    el: '#send-text',
        data: {
            message: null
        },
    }
);

let sendbtn = new Vue({
        el: '#send-button',
        methods: {
            send: function(event) {
                alert(textarea.message);
            }
        }
    }
);