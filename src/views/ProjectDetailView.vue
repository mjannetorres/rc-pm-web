<template>
  <div class="my-5 mx-5">
    <v-row justify="center" justify-md="start" wrap>
      <v-col cols="12" md="8"> 
        <ProjectDetail :id="id"/>
      </v-col>      
      <v-col cols="12" md="4">
        <WorkHistoryList />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import ProjectDetail from '@/components/ProjectDetail.vue'
import WorkHistoryList from '@/components/WorkHistoryList.vue'

export default {
    props: ['id'],
    components: {ProjectDetail, WorkHistoryList}
}
</script>

<style>

</style>