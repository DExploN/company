/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*
const app = new Vue({
    el: '#app',
});
*/
$(document).ready(function () {
    // Отображение меню на маленьких разрешениях
    $(".menu-toggler").click(function () {
        $(".menu").toggleClass('menu-active');
        $(".overlay").toggleClass('overlay-active');
    });
    //Анимация круга при клике на меню
    $(".menu__link").click(function (event) {
        $(".menu__point").remove();
        let x = event.pageX - $(this).position().left;
        let y = event.pageY - $(this).position().top;
        let point = $('<span class="menu__point"></span>');
        $(this).append(point);
        point.css({top: y, left: x, height: 0, width: 0});
        point.animate({top: y - 300, left: x - 300, height: 600, width: 600}, 500);
    });
});


