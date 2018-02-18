<!DOCTYPE html>
<html>
<head>
    <title>Vue.js + Laravel Pagination</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script>
    {{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.js"></script>
</head>
<body>
    <div id="root" class="container">
        <h1>Stories</h1>
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Plot</th>
                <th>Writer</th>
            </tr>
            <tr v-for="story in stories">
                <td> @{{story.user_name}} </td>
                <td> @{{story.email}} </td>
                <td> @{{story.mobile}} </td>
            </tr>
        </table>
        <div class="pagination">
            <button class="btn btn-default" @click="fetchStories(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"> Previous </button>
            <span>Page @{{pagination.current_page}} of @{{pagination.last_page}}</span>
            <button class="btn btn-default" @click="fetchStories(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next </button>
        </div>
    </div>

    <script>
    var app = new Vue({
        el: '#root',
        data: {
            stories: [],
            pagination: {},
        },
        mounted: function () {
            this.fetchStories();
        },

        methods: {
            fetchStories: function (page_url) {
                let vm = this;
                page_url = page_url || 'get-users-paginate'
                this.$http.get(page_url)
                .then(function (response) {
                    vm.makePagination(response.data)
                    vm.$set(this,'stories', response.data.data)
                });
            },
            makePagination: function(data){
                console.log(data.current_page);
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.current_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url
                }
                this.$set(this,'pagination', pagination)
            }
        }
    });
</script>
</body>
</html>
