<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>User</h3></div>

                    <div class="card-body">
                        <!-- <button type="button" class="btn btn-success float-right" @click="modalBaru">
                            <i class="fas fa-folder-plus"></i> &nbsp; Tambah User</button> -->

                        <br>
                        <br>
                        <br>

                        <table class="table table-bordered">
                            <tr>
                                <th><center>Nama User</center></th>
                                <th><center>Email</center></th>
                                <th style="width:15%"><center>Aksi</center></th>
                            </tr>
                            
                            <tr v-for="items in users" :key="items.id">
                                <td>
                                    <center> {{items.name}} </center>
                                </td>


                                <td>
                                    <center> {{items.email}} </center>
                                </td>

                                <td>
                                <center>
                                
                                <a href="#" @click="editData(items)" title="Edit Data">
                                    <i class="fas fa-edit cyan"> </i>
                                </a>
                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                <a href="#" @click="deleteData(items.id)" title="Hapus Data">
                                    <i class="fas fa-trash red"> </i>
                                </a>
                                </center>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
                        <div class="modal fade"
                        id="tambah"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="tambahLabel"
                        aria-hidden="true"
                        >
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahLabel" v-show="!editmode">Tambah Data Baru</h5>
                                <h5 class="modal-title" id="tambahLabel" v-show="editmode">Rubah Data Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form @submit.prevent="editmode ? updateData() : createData()">
                                <div class="modal-body">
                                <div class="form-group">
                                    <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    placeholder="Nama User"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }"
                                    />
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input
                                    v-model="form.email"
                                    type="text"
                                    name="email"
                                    placeholder="Email"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('email') }"
                                    />
                                    <has-error :form="form" field="email"></has-error>
                                </div>

                                <div class="form-group">
                                    <input
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('password') }"
                                    />
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                </div>

                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Tambah</button>
                                <button v-show="editmode" type="submit" class="btn btn-primary">Rubah</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                        <!--/Modal-->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                users: {},
                form: new Form({            //menyimpan data yang diinputkan
                    id: "",
                    name: "",
                    email: "",
                    
                })
            };
        },

        methods: {                          //method untuk 
            modalBaru() {
                this.editmode = false;
                this.form.reset();
                $("#tambah").modal("show");
            },
            editData(items) {
                this.editmode = true;
                this.form.reset();
                $("#tambah").modal("show");
                this.form.fill(items);
            },
            loadData() {
                axios.get("api/user").then(({data}) => (this.users = data));
            },
            createData() {
            this.form
                .post("api/user")
                .then(() => {
                this.$Progress.start();
                Fire.$emit("refreshData");      //refresh database kedalam tabel
                $("#tambah").modal("hide");
                Toast.fire({                    //notifikasi 
                    type: "success",
                    title: "Data Berhasi Tersimpan"
                });
                this.$Progress.finish();
                })
                .catch();
            },
            updateData() {
                this.form
                .put("api/user/" + this.form.id)
                .then(() => {
                    this.$Progress.start();
                    $("#tambah").modal("hide");
                    Toast.fire({
                        type: "success",
                        title: "Data Berhasil Diubah"
                    });
                    this.$Progress.finish();
                    Fire.$emit("refreshData");
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            deleteData(id) {
                Swal.fire({
                    title: "Anda Yakin Ingin Menghapus Data Ini?",
                    text: "Kilit Batal Untuk Membatalkan Penghapusan",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus"
                }).then(result => {
                    if (result.value) {
                        this.form
                        .delete("api/user/" + id)
                        .then(() => {
                            Swal.fire("Terhapus", "Data Anda Sudah Terhapus", "success");
                            Fire.$emit("refreshData");
                        })

                        .catch(() => {
                            Swal.fire("Gagal", "Data Gagal Terhapus", "warning");
                        });
                    }
                });
            }
        },
            created() {                     //untuk menampilkan / memanggil data di method atas
                this.loadData();
                Fire.$on("refreshData", () => {
                    this.loadData();
                });
            }
    };
</script>
