<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Add Blog</h3></div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th><center>Nama</center></th>
                                <th style="width:40%"><center>Aksi</center></th>
                            </tr>
                            <tr>
                                <td>
                                Canda
                                </td>

                                <td>
                                <center>
                                <a href="#">
                                    <i class="fas fa-eye pink"> Read </i>
                                </a>
                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                <a href="#">
                                    <i class="fas fa-edit cyan"> Edit </i>
                                </a>
                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                <a href="#">
                                    <i class="fas fa-trash indigo"> Delete</i>
                                </a>
                                </center>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
