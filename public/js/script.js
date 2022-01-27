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
                let response = fetch('/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify({message: textarea.message} )
                }).then((response) => {
                        return response.json();
                    }
                ).then((json) => {
                        console.log(json.message);
                    }
                );
            }
        }
    }
);