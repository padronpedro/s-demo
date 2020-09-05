<template>
  <div>
    <Menu />
    <div class="box-main-content">
        <div class="box-main-content-container">
            <div class="top-module">
                <div>Manage Clients</div>
                <s-button :buttonText="'Add a new client'" @clickAction="clickAddClient" style="float:right"></s-button>
            </div>

            <p v-if="dataTable.length===0">No clients found</p>

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
                            <td>{{dataTable.contact}}</td>
                            <td>{{dataTable.phone}}</td>
                            <td>{{dataTable.email}}</td>
                            <td class="colActions">
                                <s-icon :name="'Edit'" :iconName="'edit'" @actionCalled="editClient(dataTable.id)"></s-icon>
                                <s-icon :name="'Delete'" :iconName="'delete'" @actionCalled="deleteClient(dataTable.id)"></s-icon>
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
              { name: 'Contact' },
              { name: 'Phone' },
              { name: 'Email' }
          ],
          snackText: ''
      }
    },
    mounted() {
        this.getDataTable()
    },
    methods: {
      clickAddClient () {
        this.$goRouter('admin.clients.add')
      },
      getDataTable () {
          axios.get('/api/v1/clients', {})
            .then(response => {
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.dataTable = info.data
                } else {
                    this.$refs.snackbar.showSnack(info.message)
                }
            })
            .catch(error => {
                this.$refs.snackbar.showSnack(('Error getting clients data') + ': ' + error)
            })
      },
      editClient (id) {
        this.$goRouter('', null, '/admin/clients/edit/' + id)
      },
      deleteClient (id) {
          axios.delete('/api/v1/clients/' + id, {})
            .then(response => {
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.$refs.snackbar.showSnack('Client deleted successfully')
                    this.getDataTable()
                } else {
                    this.$refs.snackbar.showSnack(info.message)
                }
            })
            .catch(error => {
                this.$refs.snackbar.showSnack(('Error getting clients data') + ': ' + error)
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
