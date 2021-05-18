/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Sweet Alert 2
 */
 import Swal from 'sweetalert2';
 window.Swal = Swal.mixin({
     customClass: {
         confirmButton: 'btn btn-primary',
         cancelButton: 'btn btn-secondary'
     },
     buttonsStyling: false
 });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('Workspace', require('./components/Workspace.vue').default);
Vue.component('Sectors', require('./components/Sectors.vue').default);
Vue.component('Steps', require('./components/Steps.vue').default);
Vue.component('StepColumn', require('./components/StepColumn.vue').default);
Vue.component('OcurrenceCard', require('./components/OcurrenceCard.vue').default);
Vue.component('SectorList', require('./components/SectorList.vue').default);
Vue.component('SectorListItem', require('./components/SectorListItem.vue').default);
Vue.component('StepList', require('./components/StepList.vue').default);
Vue.component('StepListItem', require('./components/StepListItem.vue').default);
Vue.component('ModalOcurrenceInvoice', require('./components/ModalOcurrenceInvoice.vue').default);
Vue.component('Avatar', require('vue-avatar').default);
Vue.component('TimelineOcurrence', require('./components/TimelineOcurrence.vue').default);
Vue.component('TimelineItemDefault', require('./components/TimelineItemDefault.vue').default);
Vue.component('TimelineItemTask', require('./components/TimelineItemTask.vue').default);
Vue.component('ModalSectorNewEdit', require('./components/ModalSectorNewEdit.vue').default);
Vue.component('ModalStepNewEdit', require('./components/ModalStepNewEdit.vue').default);
Vue.component('ModalTaskNewEdit', require('./components/ModalTaskNewEdit.vue').default);
Vue.component('ModalActivityNewEdit', require('./components/ModalActivityNewEdit.vue').default);
Vue.component('ModalActivities', require('./components/ModalActivities.vue').default);
Vue.component('ActivityList', require('./components/ActivityList.vue').default);
Vue.component('ActivityListItem', require('./components/ActivityListItem.vue').default);
Vue.component('Users', require('./components/Users.vue').default);
Vue.component('UserList', require('./components/UserList.vue').default);
Vue.component('UserListItem', require('./components/UserListItem.vue').default);
Vue.component('ModalUserNewEdit', require('./components/ModalUserNewEdit.vue').default);
Vue.component('StepUsersList', require('./components/StepUsersList.vue').default);
Vue.component('StepUsersListItem', require('./components/StepUsersListItem.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
