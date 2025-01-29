const { createApp } = Vue;

createApp({
    data() {
        return {
            message: 'This is a dynamic feature powered by Vue.js!'
        };
    },
    methods: {
        changeMessage() {
            this.message = 'You clicked the button! Vue.js is awesome!';
        }
    }
}).mount('#app');
