<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Tambah Berita</h3></div>

                    <div class="card-body">

                        <button type="button" class="btn btn-success float-right" @click="modalBaru">
                            <i class="fas fa-folder-plus"></i> &nbsp; Tambah Berita</button>

                        <br>
                        <br>
                        <br>
        
                        <table class="table table-bordered">
                            
                            <tr>
                                <th><center>Judul Berita</center></th>
                                <th style="width:25%"><center>Isi Berita</center></th>
                                <th style="width:15%"><center>Gambar</center></th>
                                <th style="width:15%"><center>Aksi</center></th>
                            </tr>

                            <tr v-for="items in tambahs" :key="items.id">
                                <td> 
                                    {{items.judul}}
                                </td>

                                <td>
                                
                                </td>

                                <td>

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
                                <h5 class="modal-title" id="tambahLabel" v-show="!editmode">Tambah Berita Baru</h5>
                                <h5 class="modal-title" id="tambahLabel" v-show="editmode">Ubah Data Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form @submit.prevent="editmode ? updateData() : createData()">
                                <div class="modal-body">
                                <div class="form-group">
                                    <input
                                    v-model="form.judul"
                                    type="text"
                                    name="judul"
                                    placeholder="Judul Berita"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('judul') }"
                                    />
                                    <has-error :form="form" field="judul"></has-error>
                                </div>
                                </div>

                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Tambah</button>
                                <button v-show="editmode" type="submit" class="btn btn-primary">Ubah</button>
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
                tambahs: {},
                form: new Form({            //menyimpan data yang diinputkan
                    id: "",
                    judul: "",
                    isi: ""
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
                axios.get("api/tambah/").then(({data}) => (this.tambahs = data));
            },
            createData() {
            this.form
                .post("api/tambah/")
                .then(() => {
                this.$Progress.start();
                Fire.$emit("refreshData");      //refresh database kedalam tabel
                $("#tambah").modal("hide");
                Toast.fire({                    //notifikasi 
                    type: "success",
                    title: "Data Berhasil Tersimpan"
                });
                this.$Progress.finish();
                })
                .catch();
            },
            updateData() {
                this.form
                .put("api/tambah/" + this.form.id)
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
                        .delete("api/tambah/" + id)
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
