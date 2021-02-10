export let topApp = new Vue({
    el: '#app',

    data: {
        api: 'https://v2.api.aftaa.ru/',

        listSeen: true,
        linksSeen: false,

        reports: [],
        links: [],
    },

    methods: {
        loadReports() {
            let url = this.api + 'report/list'
            $.get(url)
                .done(function (reports) {
                    topApp.reports = reports;
                    $.get(url)
                        .done(function (reports) {
                            topApp.reports = reports;
                            topApp.linksSeen = false;
                            topApp.listSeen = true;
                        })
                })
        },

        loadLinks(date) {
            let url = this.api + 'report/links/' + date.split('.').reverse().join('-')
            $.get(url)
                .done(function (links) {
                    topApp.links = links;
                    topApp.linksSeen = true;
                    topApp.listSeen = false;
                })
        },
    },
});
