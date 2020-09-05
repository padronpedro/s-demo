<template>
  <div>
    <Menu />
    <div class="box-main-content">
        <div class="box-main-content-container">
            <div class="top-module">
                <div>Manage Projects</div>
                <s-button :buttonText="'Add a new project'" @clickAction="clickAddProject" style="float:right"></s-button>
            </div>

            <p v-if="dataTable.length===0">No projects found</p>

            <div class="tabBox" v-if="dataTable.length>0">
                <table>
                    <thead>
                        <tr>
                            <th v-for="(oneItem,index) in dataTableHeader" :key="index">
                                {{oneItem.name}}
                            </th>
                            <th width="7%">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(dataTable,index) in dataTable" :key="index">
                            <td>{{dataTable.name}}</td>
                            <td>{{dataTable.start_date}}</td>
                            <td>{{dataTable.end_date}}</td>
                            <td>{{dataTable.client ? dataTable.client.name : ''}}</td>
                            <td class="colActions">
                                <s-icon :name="'Edit'" :iconName="'edit'" @actionCalled="editProject(dataTable.id)"></s-icon>
                                <s-icon :name="'Delete'" :iconName="'delete'" @actionCalled="deleteProject(dataTable.id)"></s-icon>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <snack-bar ref="snackbar" :textToShow="snackText"/>
  </div>
</template>

<script>
  export default {
    data () {
      return {
          dataTable: [],
          dataTableHeader: [
              { name: 'Name' },
              { name: 'Start Date' },
              { name: 'End Date' },
              { name: 'Client' }
          ],
          snackText: ''
      }
    },
    mounted() {
        this.getDataTable()
    },
    methods: {
      clickAddProject () {
        this.$goRouter('admin.projects.add')
      },
      getDataTable () {
          axios.get('/api/v1/projects', {})
            .then(response => {
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.dataTable = info.data
                } else {
                    this.$refs.snackbar.showSnack(info.message)
                }
            })
            .catch(error => {
                this.$refs.snackbar.showSnack(('Error getting projects data') + ': ' + error)
            })
      },
      editProject (id) {
        this.$goRouter('', null, '/admin/projects/edit/' + id)
      },
      deleteProject (id) {
          axios.delete('/api/v1/projects/' + id, {})
            .then(response => {
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.$refs.snackbar.showSnack('Project deleted successfully')
                    this.getDataTable()
                } else {
                    this.$refs.snackbar.showSnack(info.message)
                }
            })
            .catch(error => {
                this.$refs.snackbar.showSnack(('Error getting projects data') + ': ' + error)
            })
      }
    }
  }
</script>

<style scoped>
.top-module {
    padding: 10px;
    margin-bottom: 40px;
}
.top-module div {
    display: inline-block;
}



</style>
