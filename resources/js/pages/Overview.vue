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
            <h4 class="page-title mb-0 font-size-18">Dashboard</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">
                  Welcome to TAS Dashboard
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- end page title -->


      <!-- end row -->

      <div class="row">
        <!-- <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title mb-4">Latest Registration</h4>

              <div class="table-responsive">
                <table class="table table-centered">
                  <thead>
                    <tr>
                      <th scope="col">Registered On</th>
                      <th scope="col">Name</th>
                      <th scope="col">Tel Number</th>
                      <th scope="col">Gender</th>
                      <th scope="col">location</th>
                      <th scope="col">Membership Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="singleItem in tableData" :key="singleItem.id">
                      <td>{{ singleItem.registered_on }}</td>
                      <td>
                        {{ singleItem.first_name }} {{ singleItem.last_name }}
                      </td>
                      <td>{{ singleItem.telephone_number }}</td>
                      <td>{{ singleItem.gender }}</td>
                      <td>{{ singleItem.location }}</td>
                      <td>{{ singleItem.type }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="mt-3">
                <ul
                  class="
                    pagination pagination-rounded
                    justify-content-center
                    mb-0
                  "
                >
                  <li class="page-item">
                    <a class="page-link" href="#">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active">
                    <a class="page-link" href="#">2</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getCount();
  },
  data() {
    return {
      ooptions: {
        chart: {
          id: "vuechart-example",
        },
        xaxis: {
          categories: [],
        },
        colors: ["#E46651", "#E46651"],
        // markers: {
        //   colors: ["#F44336", "#E91E63", "#9C27B0"],
        // },
        // dataLabels: {
        //   style: {
        //     colors: ["#F44336", "#E91E63", "#9C27B0"],
        //   },
        // },
      },
      sseries: [
        {
          name: "Attendance",
          data: [],
        },
      ],

      news: 0,
      executives: 0,
      complains: 0,
      offering: 0,
      tableData: [],
      offeringsdata: [],
    };
  },
  methods: {

    getCount() {
      var vm = this;
      axios
        .get("/api/v1/admin/stats")
        .then(({ data }) => {
          this.members = data.data.members;
          this.executives = data.data.executives;
          this.news = data.data.news;
        })
        .catch(function (error) {
          console.log(error);
        });
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
    getMembers() {
      axios
        .get("/api/v1/admin/usermanagement/members/latest")
        .then(({ data }) => {
          this.tableData = data.data;
          this.initDatatable();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getOffering() {
      axios
        .get("/api/v1/admin/stats/sample-offerings")
        .then(({ data }) => {
          this.offeringsdata = data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
</style>
