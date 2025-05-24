<template>
  <div>
    <div class="vertical-menu">
      <div class="h-100">
        <!-- <div class="user-wid text-center py-4">


          <div class="mt-3">
            <a href="#" class="text-dark font-weight-medium font-size-16"
              >Patrick Becker</a
            >

          </div>
        </div> -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
          <!-- Left Menu Start -->
          <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>

            <li>
              <a href="javascript: void(0);" class="waves-effect">
                <i class="mdi mdi-airplay"></i>
                <span>Dashboard</span>
              </a>
              <ul class="sub-menu" aria-expanded="false">
                <li><a href="/dashboard">Overview</a></li>
              </ul>
            </li>

            <li>
                <a  class="waves-effect" href="/dashboard/administrators">   <i class="mdi mdi-flip-horizontal"></i>administrators</a>
              </li>
            <li>
                <a  class="waves-effect" href="/dashboard/category">   <i class="mdi mdi-flip-horizontal"></i>Categories</a>
              </li>

                <li>
                  <a  class="waves-effect"  href="/dashboard/gallery">   <i class="mdi mdi-flip-horizontal"></i>Gallery</a>
                </li>
                <li>
                  <a  class="waves-effect"  href="/dashboard/events">   <i class="mdi mdi-flip-horizontal"></i>events</a>
                  <a  class="waves-effect"  href="/dashboard/blogs">   <i class="mdi mdi-flip-horizontal"></i>Blogs</a>
                  <a  class="waves-effect"  href="/dashboard/new-blog">   <i class="mdi mdi-flip-horizontal"></i>New Blog</a>
                </li>
          </ul>
        </div>
        <!-- Sidebar -->
      </div>
    </div>
  </div>
</template>

<script>
import { mixin } from "./../mixin";
export default {
  mixins: [mixin],
};
</script>

<style lang="scss" scoped>
</style>
