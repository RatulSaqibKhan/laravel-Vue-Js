<!DOCTYPE html>
<html>
<head>
    <title>Vue.js + Laravel Pagination + Sort</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.min.js"></script> --}}
    {{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
</head>
<body>
    <div id="root" class="container">
        <h1>Stories</h1>
        <input v-model="search" name="search" class="form-control" placeholder="Filter users by name or email">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th v-for="column in columns">
                        <a  @click="sortBy(column)" v-bind:class="{ active: sortKey == column }">
                            @{{ column | capitalize }}
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="story in orderedStories" >
                    <td> @{{story.user_name}} </td>
                    <td> @{{story.email}} </td>
                    <td> @{{story.mobile}} </td>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button class="btn btn-default" @click="fetchStories(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"> Previous </button>
            <span>Page @{{pagination.current_page}} of @{{pagination.last_page}}</span>
            <button class="btn btn-default" @click="fetchStories(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next </button>
        </div>
    </div>

    <script>
    Vue.filter('capitalize', function (value) {
        if (!value) return ''
        value = value.toString()
        return value.charAt(0).toUpperCase() + value.slice(1)
    })
    var app = new Vue({
        el: '#root',
        data: {
            sortKey: 'user_name',
            sortOrder: 'asc',
            reverse: false,
            search: '',
            columns: ['user_name', 'email', 'mobile'],
            stories: [],
            pagination: {},
        },
        mounted: function () {
            this.fetchStories();
        },
        computed: {
            orderedStories: function () {
                console.log(this.sortKey,this.sortOrder);
                // return this.stories;
                return _.orderBy(this.stories,this.sortKey,this.sortOrder)
              }
        },
        methods: {
            sortBy: function(key) {
                if (key == this.sortKey) {
                    this.sortOrder = (this.sortOrder == 'asc') ? 'desc' : 'asc';
                } else {
                    this.sortKey = key;
                    this.sortOrder = 'asc';
                }
                // console.log(this.sortKey, this.sortOrder);
            },
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
                // console.log(data.current_page);
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
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
