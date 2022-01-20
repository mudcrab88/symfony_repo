Vue.options.delimiters = [ '[[', ']]'];

let app = new Vue({
    el: '#send-text',
        data: {
            message: 'Введите сообщение'
        },
    }
);