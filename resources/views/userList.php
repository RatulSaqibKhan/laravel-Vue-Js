<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User List</title>
    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>
    <!-- VUE JS -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script>


    <!-- Styles -->
    <style>
    html, body {
        background-color: #fff;
        color: #271f6f;
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    </style>
</head>
<body>
    <div class="container">
        <div class="row col-md-12">
            <div id="root" class="" style="margin-top: 18px;">
                <p class="alert alert-danger" v-if="errorMessage">{{errorMessage}}</p>
                <p class="alert alert-success" v-if="successMessage">{{successMessage}}</p>
                <div class="col-md-2">
                    <h4 class="pull-left" style="color: #2a2a2a;"> User List </h4>
                </div>
                <div class="col-md-offset-2">
                    <button class="btn btn-lg btn-primary pull-right" data-toggle="modal" data-target="#addUserModal"> Add New</button>
                </div>
                <div class="col-md-12">
                    <hr>
                    <table class="table table-bordered" style="color: #2a2a2a;">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users">
                                <td>{{user.id}}</td>
                                <td>{{user.user_name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.mobile}}</td>
                                <td><img :src="'image/' + user.file_name" alt="image" style="height: 100px; width: 200px;"></td>
                                <td>
                                    <button class="edit-button btn btn-xs btn-success" data-toggle="modal" data-target="#editUserModal" @click="selectUser(user)" >Edit</button>&nbsp;
                                    <button class="delete-button btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteUserModal" @click="selectUser(user)" >Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- addUserModal -->
                <div id="addUserModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add New User</h4>
                            </div>
                            <div class="modal-body">
                                <form id="add-form" class="form form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
                                    <div class="">
                                        <label for="user_name" class="label label-primary">User Name:</label>
                                        <input type="text" v-model="newUser.user_name" name="user_name" class="user-name form-control" id="user-name" value="" required="required">
                                    </div>
                                    <br>
                                    <div class="">
                                        <label for="email" class="label label-primary">Email:</label>
                                        <input type="email" v-model="newUser.email" name="email" class="email form-control" id="email" value="" required="required" >
                                    </div>
                                    <br>
                                    <div class="">
                                        <label for="mobile" class="label label-primary">Mobile:</label>
                                        <input type="text" v-model="newUser.mobile" name="mobile" class="mobile form-control" id="mobile" value="" required="required">
                                    </div>
                                    <br>
                                    <div class="">
                                        <label for="file" class="label label-primary">File:</label>
                                        <input type="file" class="image" name="image" @change="onFileChange">
                                        <div v-if="image">
                                            <img style="width: 200px;height: auto;" :src="image" />
                                            <!-- <button @click="removeImage">Remove image</button> -->
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button type="button" @click="saveUser();" class="add-user-data btn btn-sm btn-primary" style="font-style: italic;">Add</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- editUserModal -->
                <div id="editUserModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit User</h4>
                            </div>
                            <div class="modal-body">
                                <form id="edit-form" class="form form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
                                    <input type="hidden" name="id" v-model="clickedUser.id" class="user-name form-control" id="user-name" value="">
                                    <div class="">
                                        <label for="user_name" class="label label-primary">User Name:</label>
                                        <input type="text" name="user_name" v-model="clickedUser.user_name" class="user-name form-control" id="user-name" value="" required="required">
                                    </div>
                                    <br>
                                    <div class="">
                                        <label for="email" class="label label-primary">Email:</label>
                                        <input type="email" name="email" v-model="clickedUser.email" class="email form-control" id="email" value="" required="required">
                                    </div>
                                    <br>
                                    <div class="">
                                        <label for="mobile" class="label label-primary">Mobile:</label>
                                        <input type="text" name="mobile" v-model="clickedUser.mobile" class="mobile form-control" id="mobile" value="" required="required">
                                    </div>
                                    <br>
                                    <div class="">
                                        <label for="file" class="label label-primary">File:</label>
                                        <input type="file" name="image" @change="onFileChange">
                                        <div v-if="image">
                                            <img style="width: 200px;height: auto;" :src="image" />
                                            <!-- <button @click="removeImage">Remove image</button> -->
                                        </div>
                                    </div><br>
                                    <div>
                                        <button @click="updateUser();" type="button" class="btn btn-sm btn-primary" style="font-style: italic;">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- deleteUserModal -->
                <div id="deleteUserModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Are you sure?</h4>
                            </div>
                            <div class="modal-body">
                                <form id="delete-form" class="form form-horizontal" enctype="">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
                                    <input type="hidden" name="id" v-model="clickedUser.id" class="id form-control" value="">
                                    <p style="color: #e70b1a; font-weight: bold;">You are going to delete '{{clickedUser.user_name}}'.</p>
                                    <button type="button" class="btn btn-sm btn-danger" @click="deleteUser();">Yes</button>&nbsp;&nbsp;&nbsp;
                                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">No</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="<?php echo asset('vuejs/app.vue') ?>"></script>
</body>
</html>
