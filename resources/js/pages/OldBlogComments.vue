<template>
    <div>
        <div class="page-content">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="
                page-title-box
                d-flex
                align-items-center
                justify-content-between
              ">
                        <h4 class="page-title mb-0 font-size-18">Blog & Comments</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">Dashboard</a>
                                </li>
                                <!-- <li class="breadcrumb-item active">Blog</li> -->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div data-repeater-list="group-a">

                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input readonly v-model="form.title" type="text" id="name"
                                    name="group-a[0][untyped-input]" class="form-control" />
                            </div>
                        </div>
                        <!-- <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input required v-model="form.introduction" type="text" id="name"
                                    name="group-a[0][untyped-input]" class="form-control" />
                            </div>
                        </div> -->

                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    width: 100%;
                  ">
                                <thead>
                                    <tr>
                                        <th>Comments</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="singleItem in comments" :key="singleItem.id">
                                        <td>{{ singleItem.content }}</td>

                                        <td>
                                            <button class="btn" type="button" @click="showDeleteModal(singleItem)">
                                                <i class="bx bx-trash-alt"></i>
                                            </button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </div>



        <div id="deleteRecordModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="mySmallModalLabel">
                            Deleting a comment
                        </h5>
                        <button @click="DeleteModalClose" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Are you sure you want to remove
                            <strong> {{ selectedItem.content }}</strong> ?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="DeleteModalClose" class="btn btn-secondary" data-dismiss="modal">
                            No
                        </button>
                        <button type="button" @click="deleteRecord" class="btn btn-primary">
                            Yes
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Form from "vform";
import { mixin } from "../mixin";

import "vue-select/dist/vue-select.css";
import { VueEditor } from "vue2-editor";
import vSelect from "vue-select";
export default {
    components: {
        vSelect,
        VueEditor,
    },
    mixins: [mixin],
    data() {
        return {
            customToolbar: [
                ["bold", "italic", "underline", "strike"], // toggled buttons
                ["blockquote", "code-block"],

                [{ header: 1 }, { header: 2 }], // custom button values
                [{ list: "ordered" }, { list: "bullet" }],
                [{ script: "sub" }, { script: "super" }], // superscript/subscript
                [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
                [{ direction: "rtl" }], // text direction
                ["image", "code-block"],
                [{ size: ["small", false, "large", "huge"] }], // custom dropdown
                [{ header: [1, 2, 3, 4, 5, 6, false] }],

                [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                // [{ color: [] }, { background: ["#FEEECE", "#FEF8D3", "#FEFCEF"] }], // dropdown with defaults from theme
                [{ font: [] }],
                [{ align: [] }],

                ["clean"], // remove formatting button
            ],

            selectedItem: "",
            imageAvatar: null,
            required: true,
            editmode: false,
            tableData: [],
            comments: [],
            form: new Form({
                title: "",
                date: "",
                introduction: "",
                summary: "",
                featured_image: "",
                mask: "",
                status: "",
            }),
        };
    },
    mounted() {
        if (this.$route.params.id) {
            this.getRecord();
        }
        // this.getRecords();
        //    alert('Bright');
    },

    methods: {
        modalClose() {
            $("#newRecordModal").modal("hide");
        },
        DeleteModalClose() {
            $("#deleteRecordModal").modal("hide");
        },

        initDatatable() {
            setTimeout(() => {
                $("#datatable-buttons").DataTable({
                    pagingType: "full_numbers",
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 100, "All"],
                    ],
                    order: [
                        [0, "asc"],
                        [3, "desc"],
                    ],
                    responsive: true,
                    destroy: true,
                    retrieve: true,
                    autoFill: true,
                    colReorder: true,
                });
            }, 300);
        },

        getRecord() {
            this.editmode = true;
            this.form.reset();
            let project_mask = this.$route.params.id;
            axios
                .get("/api/v1/admin/blog-comment/" + project_mask)
                .then(({ data }) => {
                    this.form.fill(data);
                    this.comments = data.comments;
                })
                .catch((error) => {
                    console.error("Error fetching record:", error);
                });
        },

        getRecords() {
            axios
                .get("/api/v1/admin/blog")
                .then(({ data }) => {
                    this.tableData = data.data;
                    this.initDatatable();
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        showNewModal() {
            this.form.reset();
            this.editmode = false;
            this.imageAvatar = null;
            $("#newRecordModal").modal("show");
        },
        showDeleteModal(record) {
            this.selectedItem = record;
            $("#deleteRecordModal").modal("show");
        },




        deleteRecord() {
            var vm = this;
            let formData = new FormData();

            axios
                .delete("/api/v1/admin/blog-comment/" + this.selectedItem.id, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(
                    (response) => {
                        if (response) {
                            const res = response.data;

                            if (res.code === 200) {
                                this.successToastReloadPage(res.message);
                            } else {
                            }
                        }
                    },
                    function (error) {
                        if (error.response) {
                            console.log(error.response.data.errors);
                            error.response.data.errors.forEach((element) => {
                                vm.$toasted.show(element);
                            });
                            // alert(error.response.status);
                        }
                    }
                );
        },


    },
};
</script>

<style lang="scss" scoped></style>
