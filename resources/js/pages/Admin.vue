<template>
  <div>
    <div class="page-content">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div
            class="
              page-title-box
              d-flex
              align-items-center
              justify-content-between
            "
          >
            <h4 class="page-title mb-0 font-size-18">Administrators</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                  <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Administrators</li>
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
            <button
              class="btn btn-primary btn-block mb-3"
              @click="showNewModal"
            >
              Add New Administrator
            </button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table
                id="datatable-buttons"
                class="table table-bordered dt-responsive nowrap"
                style="
                  border-collapse: collapse;
                  border-spacing: 0;
                  width: 100%;
                "
              >
                <thead>
                  <tr>
                    <th>First Name</th>
                    <th>last Name</th>
                    <th>Telephone Number</th>

                    <th>Status</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="singleItem in tableData" :key="singleItem.id">
                    <td>{{ singleItem.first_name }}</td>
                    <td>{{ singleItem.last_name }}</td>
                    <td>{{ singleItem.telephone_number }}</td>

                    <td>{{ singleItem.status_name }}</td>
                    <td>{{ singleItem.email }}</td>
                    <td>
                      <button
                        class="btn"
                        type="button"
                        @click="launchEditModal(singleItem)"
                      >
                        <i class="bx bx-edit-alt"></i>
                      </button>
                    </td>
                    <td>
                      <button
                        class="btn"
                        type="button"
                        @click="showDeleteModal(singleItem)"
                      >
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

    <div
      id="newRecordModal"
      class="modal fade bs-example-modal-lg"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              v-show="!editmode"
              class="modal-title mt-0"
              id="myLargeModalLabel"
            >
              Add System Administrator's Details
            </h5>
            <h5
              v-show="editmode"
              class="modal-title mt-0"
              id="myLargeModalLabel"
            >
              Update System Administrator's Details
            </h5>
            <button
              @click="modalClose()"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editmode ? updateRecord() : saveRecord()">
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                    <label for="name">First Name</label>
                    <input
                      required
                      v-model="form.first_name"
                      type="text"
                      id="name"
                      name="group-a[0][untyped-input]"
                      class="form-control"
                    />
                  </div>
                  <div class="form-group">
                    <label for="name">Last Name</label>
                    <input
                      required
                      v-model="form.last_name"
                      type="text"
                      id="name"
                      name="group-a[0][untyped-input]"
                      class="form-control"
                    />
                  </div>

                  <div class="form-group">
                    <label for="subject">Tel. Phone</label>
                    <input
                      @keydown.space="(event) => event.preventDefault()"
                      required
                      v-model="form.telephone_number"
                      type="text"
                      id="subject"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input
                      @keydown.space="(event) => event.preventDefault()"
                      required
                      v-model="form.email"
                      type="text"
                      id="email"
                      class="form-control"
                    />
                  </div>
                  <div class="form-group">
                    <label for="email">Password</label>
                    <input
                      @keydown.space="(event) => event.preventDefault()"
                      v-model="form.password"
                      type="text"
                      :required="required"
                      id="email"
                      class="form-control"
                    />
                  </div>

                  <div class="form-group mt-5">
                    <div class="row">
                      <div class="col">
                        <h5 class="font-size-14">Status</h5>
                      </div>
                      <div class="col">
                        <div class="form-check">
                          <input
                            v-model="form.status"
                            class="form-check-input"
                            type="radio"
                            name="exampleRadios"
                            id="exampleRadios1"
                            value="1"
                          />
                          <label class="form-check-label" for="exampleRadios1">
                            Active
                          </label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-check">
                          <input
                            v-model="form.status"
                            class="form-check-input"
                            type="radio"
                            name="exampleRadios"
                            id="exampleRadios2"
                            value="0"
                          />
                          <label class="form-check-label" for="exampleRadios2">
                            Inactive
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <button class="btn btn-primary btn-block mb-3" type="submit">
                    <span v-show="!editmode">Add New Administrator</span>
                    <span v-show="editmode"
                      >Update Administrator's Details</span
                    >
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

    <div
      id="deleteRecordModal"
      class="modal fade bs-example-modal-sm"
      tabindex="-1"
      role="dialog"
      aria-labelledby="mySmallModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="mySmallModalLabel">
              Deleting a record
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
              Are you sure you want to remove
              <strong> {{ selectedItem.first_name }}</strong> ?
            </p>
          </div>

          


          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
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

import vSelect from "vue-select";
export default {
  components: {
    vSelect,
  },
  mixins: [mixin],
  data() {
    return {
      selectedItem: "",

      required: true,
      editmode: false,
      tableData: [],
      roles: [],
      form: new Form({
        first_name: "",
        last_name: "",
        password: "",
        status: "1",
        email: "",
        telephone_number: "",
        mask: "",
        role_id: "1",
      }),
    };
  },
  mounted() {
    this.getRecords();
    this.getRoles();
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

    getRoles() {
      axios
        .get("/api/v1/admin/usermanagement/roles")
        .then(({ data }) => {
          this.roles = data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getRecords() {
      axios
        .get("/api/v1/admin/usermanagement/admin")
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
      formData.append("first_name", this.form.first_name);
      formData.append("last_name", this.form.last_name);
      formData.append("telephone_number", this.form.telephone_number);
      formData.append("email", this.form.email);
      formData.append("status", this.form.status);
      formData.append("password", this.form.password);
      axios
        .post(
          "/api/v1/admin/usermanagement/admin/" + this.form.mask,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        )
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
      this.required = false;
      this.form.fill(record);
      $("#newRecordModal").modal("show");
    },
    saveRecord() {
      var vm = this;
      let formData = new FormData();
      formData.append("first_name", this.form.first_name);
      formData.append("last_name", this.form.last_name);
      formData.append("telephone_number", this.form.telephone_number);
      formData.append("email", this.form.email);
      formData.append("status", this.form.status);
      formData.append("password", this.form.password);
      axios
        .post("/api/v1/admin/usermanagement/admin", formData, {
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
        .delete(
          "/api/v1/admin/usermanagement/admin/" + this.selectedItem.mask,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        )
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

<style lang="scss" scoped>
</style>
