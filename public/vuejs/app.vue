var app = new Vue({
    el: "#root",
    data: {
        errorMessage: "",
        successMessage: "",
        users: [],
        newUser: {user_name: "", email: "", mobile: ""},
        clickedUser: {},
        image: '',
        form: ''
    },
    mounted: function () {
        this.getAllUsers();
    },
    methods: {
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
            return;
            this.createImage(files[0]);
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
            this.image = '';
        },
        getAllUsers: function () {
            axios.get('get-users').then(
                function (response) {
                    app.users = response.data;
                }
            );
        },
        saveUser: function () {
            var form = document.querySelector("#add-form");
            var request = new XMLHttpRequest();
            var formData = new FormData(form);
            axios.post('add-new-user', formData).then(
                function (response) {
                    app.resetForm(form);
                    app.newUser = {user_name: "", email: "", mobile: ""};
                    app.getAllUsers();
                    app.displayMessage(response);
                    app.modalCLose('addUserModal');
                })
            },

            selectUser: function (user) {
                app.clickedUser = user;
            },

            updateUser: function () {
                var form = document.querySelector("#edit-form");
                var request = new XMLHttpRequest();
                var formData = new FormData(form);
                axios.post('update-user', formData).then(
                    function (response) {
                        app.newUser = {user_name: "", email: "", mobile: ""};
                        app.resetForm(form);
                        app.getAllUsers();
                        app.displayMessage(response);
                        app.modalCLose('editUserModal');
                    })
                },

                deleteUser: function () {
                    var form = document.querySelector("#delete-form");
                    var request = new XMLHttpRequest();
                    var formData = new FormData(form);
                    axios.post('delete-user', formData).then(
                        function (response) {
                            app.clickedUser = {};
                            app.newUser = {user_name: "", email: "", mobile: ""};
                            app.getAllUsers();
                            app.displayMessage(response);
                            app.modalCLose('deleteUserModal');
                        });
                    },

                    clearMessage: function () {
                        app.errorMessage = "";
                        app.successMessage = "";
                    },

                    modalCLose: function (modal) {
                        $('#'+modal).modal('hide');
                        app.image = '';
                        $('.image').val('');
                    },

                    resetForm : function(form){
                        var self = this;
                        Object.keys(this.form).forEach(function(key,index) {
                            self.form[key] = '';
                        });
                    },

                    displayMessage : function(response){
                        response.data.status===1 ? app.successMessage = response.data.message : app.errorMessage = response.data.message;
                    }
                }
            });
