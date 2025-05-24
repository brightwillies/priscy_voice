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
              <h4 class="page-title mb-0 font-size-18">Blog</h4>

              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Blog</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        <div data-repeater-list="group-a">
          <div data-repeater-item="" class="row pull-right">
            <div class="col-lg-9"></div>

            <div class="col-lg-3 align-self-center">
                <router-link
                :to="{
                  name: 'newBlog',
                }"
              >
              <button class="btn btn-primary btn-block mb-3">
                Add Blog
              </button>

            </router-link>
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
                      <th>Title</th>
                      <th>Category</th>
                      <th>Date</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="singleItem in tableData" :key="singleItem.id">
                      <td>{{ singleItem.title }}</td>
                      <td>{{ singleItem.category }}</td>
                      <td>{{ singleItem.day }}  {{singleItem.mon}}   {{singleItem.year}}</td>


                      <td>
                        <router-link
                          :to="{
                            name: 'viewBlog',
                            params: { id: singleItem.id },
                          }"
                        >
                          <button class="btn" type="button">
                            <i class="bx bx-edit-alt"></i>
                          </button>
                        </router-link>
                      </td>
                      <!-- <td>
                        <button class="btn" type="button" @click="launchEditModal(singleItem)">
                          <i class="bx bx-edit-alt"></i>
                        </button>
                      </td> -->
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

      <div id="newRecordModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 v-show="!editmode" class="modal-title mt-0" id="myLargeModalLabel">
                Add Blog Details
              </h5>
              <h5 v-show="editmode" class="modal-title mt-0" id="myLargeModalLabel">
                Update Blog Details
              </h5>
              <button @click="modalClose()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form @submit.prevent="editmode ? updateRecord() : saveRecord()">
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6 col-md-4">
                    <div class="form-group">
                      <label for="name">Title</label>
                      <input required v-model="form.title" type="text" id="name" name="group-a[0][untyped-input]"
                        class="form-control" />
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-4">
                    <div class="form-group">
                      <label for="name">Date</label>
                      <input required v-model="form.date" type="date" id="name" name="group-a[0][untyped-input]"
                        class="form-control" />
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="name">Introduction</label> <br />
                      <textarea v-model="form.introduction" name="" id="" style="width: 100%" cols="10"
                        rows="5"></textarea>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="name">News</label> <br />
                      <vue-editor useCustomImageHandler @image-added="handleImageAdded" v-model="form.summary"
                        :editorToolbar="customToolbar"></vue-editor>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="example-text-input" class="col-md-3 col-form-label form-control-label">Preview</label>
                      <div class="col-md-12">
                        <img :src="imageAvatar" id="profile-img-tag" height="250px" width="100%" />

                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFileLang" lang="en"
                            @change="getFeaturedImage" ref="webfile" />
                          <label class="custom-file-label" for="customFileLang">Select Image</label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <button class="btn btn-primary btn-block mb-3" type="submit">
                      <span v-show="!editmode">Add News </span>
                      <span v-show="editmode">Update News</span>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div id="deleteRecordModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="mySmallModalLabel">
                Deleting a record
              </h5>
              <button @click="DeleteModalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>
                Are you sure you want to remove
                <strong> {{ selectedItem.title }}</strong> ?
              </p>
            </div>
            <div class="modal-footer">
              <button type="button"  @click="DeleteModalClose" class="btn btn-secondary" data-dismiss="modal">
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
        roles: [],
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
      this.getRecords();
      //    alert('Bright');
    },

    methods: {
      modalClose() {
        $("#newRecordModal").modal("hide");
      },
      DeleteModalClose() {
        $("#deleteRecordModal").modal("hide");
      },
      async getFeaturedImage(e) {
        this.form.featured_image = this.$refs.webfile.files[0];
        let image = e.target.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(image);
        reader.onload = (e) => {
          this.imageAvatar = e.target.result;
        };
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

      updateRecord() {
        var vm = this;
        let formData = new FormData();
        formData.append("title", this.form.title);
        formData.append("summary", this.form.summary);
        formData.append("introduction", this.form.introduction);
        formData.append("date", this.form.date);
        formData.append("featured_image", this.form.featured_image);

        axios
          .post("/api/v1/admin/blog/" + this.form.mask, formData, {
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

      launchEditModal(record) {
        this.form.reset();
        this.editmode = true;
        this.imageAvatar = record.image;
        this.form.fill(record);
        $("#newRecordModal").modal("show");
      },
      saveRecord() {
        var vm = this;
        let formData = new FormData();
        formData.append("introduction", this.form.introduction);
        formData.append("title", this.form.title);
        formData.append("summary", this.form.summary);
        formData.append("date", this.form.date);
        formData.append("featured_image", this.form.featured_image);

        axios
          .post("/api/v1/admin/blog", formData, {
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

      deleteRecord() {
        var vm = this;
        let formData = new FormData();

        axios
          .delete("/api/v1/admin/blog/" + this.selectedItem.mask, formData, {
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

      handleImageAdded: function (file, Editor, cursorLocation, resetUploader) {
        // An example of using FormData
        // NOTE: Your key could be different such as:
        // formData.append('file', file)

        var formData = new FormData();
        formData.append("image", file);

        axios
          .post("/api/v1/admin/uploadimage", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((result) => {
            console.log(result.data.data.url);
            let url = result.data.data.url; // Get url from response
            Editor.insertEmbed(cursorLocation, "image", url);
            resetUploader();
          })
          .catch((err) => {
            console.log(err);
          });
      },
    },
  };
  </script>

  <style lang="scss" scoped>

  </style>
