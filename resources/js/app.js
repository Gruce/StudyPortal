require('./bootstrap');

require('alpinejs');

require('vue');

Vue.component('chat-messages', require('../views/components/ChatMessages.vue'));
Vue.component('chat-form', require('../views/components/ChatForm.vue'));

const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();
        console.log("Created")
        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.messages.message,
                    user: e.user
                });
            });
    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
            console.log("Fetch messages")
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        }
    }
});