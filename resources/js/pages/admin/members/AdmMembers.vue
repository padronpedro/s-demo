<template>
  <div>
    <Menu />
    <div class="box-main-content">
        <div class="box-main-content-container">
            <div class="top-module">
                <div>Manage Members</div>
                <s-button :buttonText="'Add a new member'" @clickAction="clickAddMember" style="float:right"></s-button>
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
                            <td>{{dataTable.email}}</td>
                            <td>{{dataTable.position}}</td>
                            <td>{{dataTable.phone}}</td>
                            <td class="colActions">
                                <s-icon :name="'Edit'" :iconName="'edit'" @actionCalled="editMember(dataTable.id)"></s-icon>
                                <s-icon :name="'Delete'" :iconName="'delete'" @actionCalled="deleteMember(dataTable.id)"></s-icon>
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
              { name: 'Email' },
              { name: 'Position' },
              { name: 'Phone' }
          ],
          snackText: ''
      }
    },
    mounted() {
        this.getDataTable()
    },
    methods: {
      clickAddMember () {
        this.$goRouter('admin.members.add')
      },
      getDataTable () {
          axios.get('/api/v1/members', {})
            .then(response => {
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.dataTable = info.data
                } else {
                    this.$refs.snackbar.showSnack(info.message)
                }
            })
            .catch(error => {
                this.$refs.snackbar.showSnack(('Error getting members data') + ': ' + error)
            })
      },
      editMember (id) {
        this.$goRouter('', null, '/admin/members/edit/' + id)
      },
      deleteMember (id) {
          axios.delete('/api/v1/members/' + id, {})
            .then(response => {
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.$refs.snackbar.showSnack('Member deleted successfully')
                    this.getDataTable()
                } else {
                    this.$refs.snackbar.showSnack(info.message)
                }
            })
            .catch(error => {
                this.$refs.snackbar.showSnack(('Error getting members data') + ': ' + error)
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
