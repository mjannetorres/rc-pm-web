<template>
  <nav>
    <v-app-bar class="primary" flat app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>
        <span class="secondary--text pe-1 display-1">RC</span>
        <span class="font-weight-light">Prints & Garments</span>
      </v-toolbar-title>
    </v-app-bar>

    <v-navigation-drawer      
      v-model="drawer"
      left
      app      
    >
      <template v-slot:prepend>
        <v-list flat>
          <v-list-item two-line>
            <v-list-item-avatar>
              <img src="https://randomuser.me/api/portraits/women/81.jpg" />
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title
                >Administrator</v-list-item-title
              >
              <v-list-item-subtitle>Logged In</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </template>

      <v-list class="mt-8" rounded>
        <v-list-item
          v-for="link in links"
          :key="link.text"
          router
          :to="link.router"
          active-class="primary--text"
        >
          <v-list-item-icon>
            <font-awesome-icon :icon="link.icon" />
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title v-text="link.text"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <template v-slot:append>
        <v-divider></v-divider>
        <v-list subheader dense>
          <v-subheader>Members</v-subheader>

          <v-list-item v-for="chat in recent" :key="chat.avatar">
            <v-list-item-avatar>
              <v-img :alt="`${chat.title} avatar`" :src="chat.avatar"></v-img>
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title v-text="chat.title"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <div class="pa-2">
          <v-btn block depressed color="accent">
            <font-awesome-icon icon="fa-solid fa-power-off" />
            <span style="margin: 5px">Logout</span>
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>
  </nav>
</template>

<script>
export default {
  data() {
    return {      
      selectedItem: 2,
      links: [
        {
          icon: "fa-solid fa-table-cells-large",
          text: "Dashboard",
          router: "/",
        },
        {
          icon: "fa-solid fa-list-check",
          text: "Projects",
          router: "/projects",
        },
        // {
        //   icon: "fa-solid fa-chart-simple",
        //   text: "Reports",
        //   router: "/reports",
        // },
        {
          icon: "fa-solid fa-chart-simple",
          text: "Layout",
          router: "/layout/1",
        },
      ],
      drawer: true,
      recent: [
        {
          active: true,
          avatar: "https://cdn.vuetifyjs.com/images/lists/1.jpg",
          title: "Mary Janne",
        },
        {
          active: true,
          avatar: "https://cdn.vuetifyjs.com/images/lists/2.jpg",
          title: "Mary Janne",
        },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
          title: "Mary Janne",
        },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
          title: "Mary Janne",
        },
      ],      
    };
  },
};
</script>

<style>
</style>