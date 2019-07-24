
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        mgs: 'messgae successfully',
        pvtmsg: [],
        singlemessge: [],
        messFrom: '',
        conid: '',
        user_id:''

    },

    mounted: function () {
    },

    created() {
        axios.get('http://localhost/socilsite/getallmessgess')
                .then(response => {
                    app.pvtmsg = response.data;

                })
                .catch(function (error) {
                    console.log(error)
                });


    },

    methods: {
        messegesid: function (id) {
            axios.get('http://localhost/socilsite/getallmessgess/' + id)
                    .then(response => {
                        app.singlemessge = response.data;
                        app.user_id = id;
                        app.conid= "";
                        app.conid = response.data[0].conversions_id;

                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
        },
        inputhandeler(e) {

            if (e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                this.sendmessge();
            }
        },
        sendmessge() {
            if (this.messFrom) {
                axios.post('http://localhost/socilsite/sendmessge', {
                    conid: this.conid,
                    messFrom: this.messFrom,
                    user_id: this.user_id,
                })
                        .then(function (response ,) {
                          console.log(response.data);
                          app.singlemessge = response.data;
                        })
                        .catch(function (error) {
                            console.log(error)
                        });

            }
        }

    }

});
